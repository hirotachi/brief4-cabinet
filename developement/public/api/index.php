<?php
include_once "../../src/router/Router.php";
include_once "../../src/router/Request.php";

$router = new Router(new Request);

$router->get("/api", function ($req) {
    return json_encode($req->getHeader());
});


$router->get("/api/patients", function () {
    $tester = ["id" => "nice", "hey" => "dude", "calm" => "hey"];
    http_response_code(500);
    return json_encode($tester);
});


$router->put("/api/patients", function ($req) {
    return json_encode($req->getBody());
});
