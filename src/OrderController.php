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
            $sql = "SELECT * FROM myOrder WHERE ProductID=:ProductID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":ProductID", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }