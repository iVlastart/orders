<?php
    $parts = explode("/", $_SERVER["REQUEST_URI"]);

    spl_autoload_register(function($class)
    {
        require __DIR__ . "/src/$class.php";
    });
    header("Content-type: application/json");

    $id = $parts[2]??null;

    $db = new Db("localhost", "orders", "root", "");
    $orderController = new OrderController($db);
    $results = $orderController->getOrder($id);

    switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        if ($parts[1] === "order" && $id)
        {
            
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
        } 
        else 
        {
            http_response_code(400);
            echo json_encode(["error" => "Bad Request"]);
        }
        break;
    }