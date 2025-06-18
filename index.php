<?php
    $parts = explode("/", $_SERVER["REQUEST_URI"]);

    spl_autoload_register(function($class)
    {
        require __DIR__ . "/src/$class.php";
    });

    $id = $parts[2]??null;
    if($parts[1]!=="order" && $id!==null && $_SERVER["REQUEST_METHOD"]!=="GET")
    {
        http_response_code(404);
        exit;
    }

    