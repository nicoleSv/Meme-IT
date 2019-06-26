<?php 
    class Database {
        // TODO 
        private $host = DB_HOST;
        private $db_name = DB_NAME; 
        private $username = DB_USER;
        private $password = DB_PASS;
        public $connection;

        // Get the database connection
        public function getConnection() {
            $this->connection = null;

            try {
                $this->connection = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                    $this->username, $this->password);

                $this->connection->exec("set names utf8");
            }
            catch(PDOException $exception) {
                echo "Connection error" . $exception->getMessage();
            }

            return $this->connection;
        }
    }
?>