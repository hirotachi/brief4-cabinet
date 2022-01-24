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

        $message = $e->getMessage();
        if (!str_contains($message, "duplicate")) {
            return json_encode(["message" => $message]);
        }
        preg_match_all("/key '\w+.(?P<key>\w+)'$/", $message, $matches);
        http_response_code(409);
        return json_encode(["message" => "duplicate entries", "keys" => $matches["key"]]);
    }
}


function startAdminSession($userId)
{
    session_start();
    $_SESSION["userId"] = $userId;
}

function stopAdminSession()
{
    session_start();
    session_destroy();
}

function getAdminIdFromSession()
{
    session_start();
    return $_SESSION["userId"] ?? null;
}

function adminPageGuard()
{
    $adminId = getAdminIdFromSession();
    if ($adminId) {
        return;
    }
    header("Location: login.php");
}


function getCurrentUrl(): string
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $link = "https";
    } else {
        $link = "http";
    }

    $link .= "://";

    $link .= $_SERVER['HTTP_HOST'];

    $link .= $_SERVER['REQUEST_URI'];

    return $link;
}
