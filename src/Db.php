<?php
    class Db
    {
        public function __construct(private string $host, private string $name, 
            private string $username, private string $password)
        {

        }

        public function getConnection()
        {
            $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";
            try
            {
                return new PDO($dsn, $this->username, $this->password);
            }
            catch(Exception $ex)
            {
                json_encode(["PDO_connErr" => $ex->getMessage()]);
            }
        }
    }