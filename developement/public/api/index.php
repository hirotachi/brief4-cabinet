<?php
include_once "../../src/router/Router.php";
include_once "../../src/models/index.php";
include_once "../../utils/index.php";

include_once "../../src/controllers/index.php";

$router = new Router(baseRoute: "/api");
$database = new Database("mysql:host=localhost:6033;dbname=app_db", "root", "root");

//$router->get("/:tester", function ($req) {
//    $name = $req->params["tester"];
//    return "hello $name, nice how are you!";
//});
patientController($router, $database);


$router->get("/", function ($req) {
    return "hello world!!!!";
});







