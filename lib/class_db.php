<?php
    class DB{
        public $conn;
        public $primary_key = "hkt";
        public $ALGORITHM = "HS512";
        private $servername = 'localhost';
        private $user = 'root';
        private $pass = '';
        private $database = 'php-api-jwt';

        /**
         * DB constructor.
         * @param $conn
         * @param string $localhost
         * @param string $user
         * @param string $pass
         * @param string $database
         */
        public function __construct()
        {
            $this->conn = new mysqli($this->servername,$this->user,$this->pass,$this->database);
            if ($this->conn->connect_error){
                die("Connect failed " . $this->conn->connect_error );
            }
        }
    }
?>