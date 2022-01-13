<?php

function layoutStart($title, $with_nav_comp)
{

    echo '<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
      href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css"
      rel="stylesheet"
      type="text/css"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="./styles/styles.css">';
    if ($with_nav_comp) {
        echo "<link rel='stylesheet' type='text/css' href='./styles/components/navigation.css'> ";
    }
    echo "<title>$title</title>
</head>
<body>";
}

function layoutEnd()
{
    echo "</body></html>";
}
