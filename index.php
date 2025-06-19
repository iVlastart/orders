<?php
    use Dotenv\Dotenv;

    require_once __DIR__ . "/vendor/autoload.php";
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $parts = explode("/", $_SERVER["REQUEST_URI"]);
    spl_autoload_register(function($class)
    {
        require __DIR__ . "/src/$class.php";
    });
    header("Content-type: application/json");

    $id = $parts[2]??null;

    $db = new Db($_ENV["DB_HOST"], $_ENV["DB_NAME"], $_ENV["DB_USERNAME"],
        $_ENV["DB_PASSWORD"]);
    $orderController = new OrderController($db);

    switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        if ($parts[1] === "order" && $id)
        {
            $results = $orderController->getOrder($id);
            foreach($results as $result)
            {
                printf(json_encode([
                    "OrderID" => $result["OrderID"],
                    "ProductID" => $result["ProductID"],
                    "Name" => $result["Name"],
                    "IsAvailable" => $result["IsAvailable"],
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