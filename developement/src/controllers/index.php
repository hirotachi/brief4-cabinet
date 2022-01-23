<?php
@include_once "../router/Router.php";
@include_once "../models/index.php";

@include_once "patient.controller.php";
@include_once "doctor.controller.php";


$router = new Router(baseRoute: "/api");
$database = new Database("mysql:host=localhost:6033;dbname=app_db", "root", "root");


patientController($router, $database);
doctorController($router, $database);


$router->get("/:tester", function ($req) {
    $name = $req->params["tester"];
    return "hello $name, nice how are you! ".getQueryParams("search");
});


$router->get("/", function ($req) {
    return "hello world!!!!";
});

