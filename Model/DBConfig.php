<?php
    class DB {
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "qldm";
        
        protected $conn = NULL;

        public function getConnection() {
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            } catch(PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
        }
        
    }
?>