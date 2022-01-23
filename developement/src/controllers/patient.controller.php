<?php

function patientController(Router $router, Database $db)
{
    $patient = new Patient($db, "Patient");
    $patientRouter = $router->create("/patients");

    $patientRouter->get("/", function ($req) use ($patient) {
        $page = getQueryParams("page", "int") ?? 1;
        $search = getQueryParams("search");
        return json_encode($patient->searchPatients(page: $page, search: "%$search%"));
    });

    $patientRouter->get("/:id", function ($req) use ($patient) {
        $id = $req->params["id"];
        if (!is_numeric($id)) {
            http_response_code(404);
            return "patient with id: '$id' doesnt exist";
        }
        try {
            $patientData = $patient->fetchById($id);
            if (!$patientData) {
                http_response_code(404);
                return "patient $id not found";
            }
            return json_encode($patientData);
        } catch (PDOException $ex) {
            echo "working here";
        }
    });

    $patientRouter->post("/", function ($req) use ($patient) {
        $createdPatient = $patient->create($req->getBody());
        return json_encode($createdPatient);
    });

    $patientRouter->patch("/:id", function ($req) {
        $id = $req->params["id"];
        return "updated patient id => $id";
    });
}