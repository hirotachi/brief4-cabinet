<?php

function createStyleLink($link)
{
    echo "<link rel='stylesheet' type='text/css' href='./styles/$link.css'>";
}

function layoutStart($styles = [], $title = "cabinet rafik", $with_nav_comp = true)
{
    echo "
<!doctype html>
<html lang='n'
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link
      href='https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css'
      rel='stylesheet'
      type='text/css'      crossorigin='anonymous'
    />
    <title>$title</title>
    ";
    createStyleLink("styles");
    foreach ($styles as $style) {
        createStyleLink($style);
    }
    if ($with_nav_comp) {
        createStyleLink("components/navigation");
    }

    echo "</head><body>";
}


function createScript($name)
{
    echo "<script src='./scripts/$name.js'></script>";
}

function layoutEnd($scripts = [])
{
    createScript("main");
    foreach ($scripts as $script) {
        createStyleLink($script);
    }
    echo "</body></html>";
}
