<?php
    class Db
    {
        public function __construct(private string $host, private string $name, 
            private string $username, private string $password)
        {

        }

        public function getConnection():PDO
        {
            $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";
            return new PDO($dsn, $this->username, $this->password);
        }
    }