<?php

function patientController(Router $router, Database $db)
{
    $patient = new Patient($db, "Patient");
    $patientRouter = $router->create("/patients");

    $patientRouter->get("/", function ($req) use ($patient) {
        return json_encode($patient->fetchAll());
    });


    $patientRouter->get("/:id", function ($req) use ($patient) {
        $id = $req->params["id"];
        $patientData = $patient->fetch($id);
        if (!$patientData) {
            http_response_code(404);
            return "patient $id not found";
        }
        return json_encode($patientData);
    });

    $patientRouter->get("/1", function () {
        return "hello from the first one ".getQueryParams("nice");
    });

    $patientRouter->post("/", function ($req) use ($patient) {
        return json_encode($req->getBody());
    });
}