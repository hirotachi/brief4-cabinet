<?php

function getQueryParams($name, $valType = "")
{
    return filter_input(INPUT_GET, $name, match ($valType) {
        "int" => FILTER_SANITIZE_NUMBER_INT,
        default => FILTER_DEFAULT,
    });
}