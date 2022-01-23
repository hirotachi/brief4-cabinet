<?php

function getQueryParams($name, $valType = "")
{
    return filter_input(INPUT_GET, $name, match ($valType) {
        "int" => FILTER_SANITIZE_NUMBER_INT,
        default => FILTER_DEFAULT,
    });
}

/**
 * handle duplicate entries exception
 * @param $cb
 * @return false|string|void
 */
function handleDuplicateException($cb)
{
    try {
        return $cb();
    } catch (PDOException $e) {
        preg_match_all("/key '\w+.(?P<key>\w+)'$/", $e->getMessage(), $matches);
        http_response_code(409);
        return json_encode(["message" => "duplicate entries", "keys" => $matches["key"]]);
    }
}


function startAdminSession($userId)
{
    session_start();
    $_SESSION["userId"] = $userId;
}

function getAdminIdFromSession()
{
    session_start();
    return $_SESSION["userId"] ?? null;
}