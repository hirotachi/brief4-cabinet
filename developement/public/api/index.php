<?php
include_once "../../src/router/Router.php";
include_once "../../src/models/index.php";
include_once "../../utils/index.php";


$router = new Router();
$database = new Database("mysql:host=localhost:6033;dbname=app_db", "root", "root");


$patient = new Patient($database, "Patient");


$router->get("/api", function ($req) {
    return "hello world!!!!";
});


$router->get("/api/:tester", function ($req) {
    $name = $req->params["tester"];
    return "hello $name, how are you!";
});


$router->get("/api/patients", function ($req) use ($patient) {
    return json_encode($patient->fetchAll());
});


$router->get("/api/patients/:id", function ($req) use ($patient) {
    $id = $req->params["id"];
    $patientData = $patient->fetch($id);
    if (!$patientData) {
        http_response_code(404);
        return "patient $id not found";
    }
    return json_encode($patientData);
});

$router->get("/api/patients/1", function () {
    return "hello from the first one ".getQueryParams("nice");
});

$router->post("/api/patients", function ($req) use ($patient) {
    return json_encode($req->getBody());
});

//$router->delete("/api/patients", function ($req) {
//    http_response_code(404);
//    return "patient has been deleted successfully";
//});




