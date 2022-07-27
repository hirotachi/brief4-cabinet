<?php
@require_once dirname(__DIR__)."/router/Router.php";
@require_once dirname(__DIR__)."/models/index.php";

@require_once __DIR__."/patient.controller.php";
@require_once __DIR__."/doctor.controller.php";


var_dump("hello world");

$router = new Router(baseRoute: "/api");
$database = new Database();


patientController($router, $database);
doctorController($router, $database);


$router->get("/:tester", function ($req) {
    $name = $req->params["tester"];
    return "hello $name, nice how are you! ".getQueryParams("search");
});

$router->post("/contact", function ($req) {
//    send message to inbox
    return json_encode(["message" => "success"]);
});


$router->get("/", function ($req) {
    return "hello world!!!!";
});

