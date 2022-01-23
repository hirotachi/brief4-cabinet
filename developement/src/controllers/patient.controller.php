<?php

function patientController(Router $router, Database $db)
{
    $patient = new Patient($db, "Patient");
    $patientRouter = $router->create("/patients");

    $patientRouter->get("/", function ($req) use ($patient) {
        $page = getQueryParams("page", "int") ?? 1;
        $search = getQueryParams("search");
        $result = array();
        $searchQuery = "%$search%";
        $result["count"] = $patient->countPatients($searchQuery);
        $result["patients"] = $patient->searchPatients(page: $page, search: $searchQuery);

        return json_encode($result);
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
        try {
            $createdPatient = $patient->create($req->getBody());
        } catch (PDOException $e) {
            preg_match_all("/key '\w+.(?P<key>\w+)'$/", $e->getMessage(), $matches);
            http_response_code(409);
            return json_encode(["message" => "duplicate entries", "keys" => $matches["key"]]);
        }
        return json_encode($createdPatient);
    });

    $patientRouter->patch("/:id", function ($req) {
        $id = $req->params["id"];
        return "updated patient id => $id";
    });
}