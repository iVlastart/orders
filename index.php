<?php
    $parts = explode("/", $_SERVER["REQUEST_URI"]);

    spl_autoload_register(function($class)
    {
        require __DIR__ . "/src/$class.php";
    });
    header("Content-type: application/json");

    $id = $parts[2]??null;
    if($parts[1]!=="order" && $id!==null && $_SERVER["REQUEST_METHOD"]!=="GET")
    {
        http_response_code(404);
        exit;
    }

    $db = new Db("localhost", "orders", "root", "");
    $orderController = new OrderController($db);
    $results = $orderController->getOrder($id);

    foreach($results as $result)
    {
        printf(json_encode([
            "ID" => $result["ID"],
            "ProductID" => $result["ProductID"],
            "DateOfCreation" => $result["DateOfCreation"],
            "Price" => $result["Price"],
            "Currency" => $result["Currency"],
            "Status" => $result["Status"]
        ]));
    }