<?php
include_once "../../src/router/Router.php";
include_once "../../src/router/Request.php";
include_once "../../src/models/Database.php";
include_once "../../utils/helpers.php";


$router = new Router(new Request);
$database = new Database("mysql:host=localhost:6033;dbname=app_db", "root", "root");

$router->get("/api", function ($req) {
    return json_encode($req->getHeader());
});


$router->get("/api/patients/", function () use ($database) {
//    $search = getParams("search");
//    $query = $database->query("select * from Patient where email like :txt or lastName like :txt or firstname like :txt",
//        "%$search%");
//    return json_encode($query->fetchAll());
    print_r($_SERVER);
});


$router->put("/api/patients", function ($req) {
    return json_encode($req->getBody());
});

$router->delete("/api/patients", function ($req) {
    http_response_code(404);
    return "patient has been deleted successfully";
});

