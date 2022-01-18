<?php
include_once "../../src/router/Router.php";
include_once "../../src/router/Request.php";

$router = new Router(new Request);

$router->get("/api", function ($req) {
    return json_encode($req->getHeader());
});
$router->get("/api/patients", function () {
    $tester = ["id" => "nice", "hey" => "dude", "calm" => "hey"];
    return json_encode($tester);
});
