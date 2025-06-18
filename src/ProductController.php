<?php
    class ProductController
    {
        private PDO $conn;

        public function __construct(Db $db)
        {
            
        }
        public function getProductID($id):int
        {
            $sql = "SELECT ProductID FROM myOrder WHERE ProductID=:ProductID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":ProductID", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result["ProductID"];
        }
    }