<?php


function patientController(Router $router, Database $db)
{
    $patient = new Patient($db, "Patient");
    $patientRouter = $router->create("/patients");

    $adminGuard = function ($req) {
        $id = getAdminIdFromSession();
        http_response_code(403);
        return !!$id;
    };
    $patientRouter->get("/", function ($req) use ($patient) {
        $page = getQueryParams("page", "int") ?? 1;
        $search = getQueryParams("search");
        $result = array();
        $searchQuery = "%$search%";
        $patientsCount = $patient->getCount($searchQuery);

        $result["count"] = $patientsCount;
        $result["total_pages"] = ceil($patientsCount / 10);
        $result["patients"] = $patient->search(page: $page, search: $searchQuery);

        return json_encode($result);
    });


    $patientRouter->get("/:id", function ($req) use ($patient) {
        $id = $req->params["id"];
        if (!is_numeric($id)) {
            http_response_code(404);
            return "patient with id: '$id' doesnt exist";
        }
        $patientData = $patient->fetchById($id);
        if (!$patientData) {
            http_response_code(404);
            return "patient $id not found";
        }
        return json_encode($patientData);
    });

    $patientRouter->post("/", function ($req) use ($patient) {
        return handleDuplicateException(function () use ($req, $patient) {
            $createdPatient = $patient->create($req->getBody());
            return json_encode($createdPatient);
        });
    });

    $patientRouter->patch("/:id", function ($req) use ($patient) {
        return handleDuplicateException(function () use ($patient, $req) {
            $id = $req->params["id"];
            if (!is_numeric($id)) {
                http_response_code(404);
                return "patient with id: '$id' doesnt exist";
            }
            $updatedPatient = $patient->update($id, $req->getBody());
            if (!$updatedPatient) {
                http_response_code(404);
                return "patient $id doesnt exist";
            }
            return json_encode($updatedPatient);
        });
    });

    $patientRouter->delete("/:id", function ($req) use ($patient) {
        $id = $req->params["id"];
        if (!is_numeric($id)) {
            http_response_code(404);
            return "patient with id: '$id' doesnt exist";
        }
        if (!$patient->removeById($id)) {
            http_response_code(404);
            return "patient with id: '$id' doesnt exist";
        }
        return "success";
    });
}

