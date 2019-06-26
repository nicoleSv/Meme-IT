<?php 
    require __DIR__ . '/../config/database.php';

    class BaseModel {
        protected $connection;
        private $db;

        public function __construct() {
            $this->db = new Database();
            $this->connection = $this->db->getConnection();
        }
    }
?>