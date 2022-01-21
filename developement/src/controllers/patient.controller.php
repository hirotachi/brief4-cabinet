<?php

function patientController(Router $router, Database $db)
{
    $patient = new Patient($db, "Patient");

    $router->get("/patients", function ($req) use ($patient) {
        return json_encode($patient->fetchAll());
    });


    $router->get("/patients/:id", function ($req) use ($patient) {
        $id = $req->params["id"];
        $patientData = $patient->fetch($id);
        if (!$patientData) {
            http_response_code(404);
            return "patient $id not found";
        }
        return json_encode($patientData);
    });

    $router->get("/patients/1", function () {
        return "hello from the first one ".getQueryParams("nice");
    });

    $router->post("/patients", function ($req) use ($patient) {
        return json_encode($req->getBody());
    });
}