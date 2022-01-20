<?php
include_once "../../src/router/Router.php";
include_once "../../src/models/Database.php";
include_once "../../src/models/Database.php";
include_once "../../utils/helpers.php";


$router = new Router();
$database = new Database("mysql:host=localhost:6033;dbname=app_db", "root", "root");

$router->get("/api", function ($req) {
    return json_encode($req->getHeader());
});

$router->get("/api/patients/1", function () {
    return "hello from the first one ".getQueryParams("nice");
});

$router->get("/api/patients/:id", function ($req) use ($database) {
//    $search = getParams("search");
//    $query = $database->query("select * from Patient where email like :txt or lastName like :txt or firstname like :txt",
//        "%$search%");
//    return json_encode($query->fetchAll());
    $id = $req->params["id"];
    return "hello $id ".getQueryParams("nice");
});


$router->get("/api/patients", function ($req) {
    return getQueryParams("nice");
});

$router->delete("/api/patients", function ($req) {
    http_response_code(404);
    return "patient has been deleted successfully";
});

