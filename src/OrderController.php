<?php
    class OrderController
    {
        private PDO $conn;
        public function __construct(Db $db)
        {
            $this->conn = $db->getConnection();
        }
        public function getOrder($id):array
        {
            $sql = "SELECT 
                myOrder.ID AS OrderID,
                myOrder.ProductID AS ProductID,
                product.Name AS Name,
                product.Is_available AS IsAvailable,
                myOrder.DateOfCreation,
                myOrder.Price AS Price,
                myOrder.Currency AS Currency,
                myOrder.Status AS Status
            FROM myOrder
            JOIN product ON myOrder.ProductID = product.ID
            WHERE myOrder.ID = :OrderID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":OrderID", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }