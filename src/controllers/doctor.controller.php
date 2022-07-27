<?php

function doctorController(Router $router, Database $db)
{
    $doctor = new Doctor($db);
    var_dump("hello world");

    $router->post("/login", function ($req) use ($doctor) {
        $body = $req->getBody();
        $username = $body["username"];
        $password = $body["password"];
        if (!isset($username) || !isset($password)) {
            http_response_code(403);
            return "missing password or username";
        }
        $user = $doctor->findOne(["username" => $username]);
        if (!$user || !password_verify($password, $user["password"])) {
            http_response_code(403);
            return json_encode(["message" => "wrong username or password"]);
        }
        startAdminSession($user["id"]);
        return json_encode(["message" => "success"]);
    });

    $router->post("/register", function ($req) use ($doctor) {
        return handleDuplicateException(function () use ($req, $doctor) {
            $body = $req->getBody();
            $username = $body["username"];
            $password = $body["password"];
            if (!isset($username) || !isset($password)) {
                http_response_code(403);
                return "missing password or username";
            }
            $password_hash = password_hash($password, PASSWORD_ARGON2I);
            $user = $doctor->create(["username" => $username, "password" => $password_hash]);
            startAdminSession($user["id"]);
            return "success";
        });
    });

    $router->get("/logout", function () {
        stopAdminSession();
        return json_encode([
            "message" => "logged out successfully",
        ]);
    });
}