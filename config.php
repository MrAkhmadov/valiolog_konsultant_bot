<?php 
    class DB {
        private $host;
        private $user;
        private $pass;
        private $db;

        public function __construct() 
        {
           $this->host = "us-cdbr-east-03.cleardb.com";
           $this->user = "b15a93020b4059";
            $this->pass = "728124ea";
            $this->db = "salom";
            $this->conn = $this->connect();
        }
        public function connect() {
            $db = new mysqli($this->host, $this->user, $this->pass, $this->db);
            return $db;
        }
        public function insert($chat_id) {
            $sql = "INSERT INTO salom(user_id, step) VALUES($chat_id, 1)";
            $res = $this->conn->query($sql);
            if ($res) return true;
            else return false;
        }
        public function select($chat_id) {
            $sql = "SELECT * FROM salom WHERE user_id = $chat_id";
            $res = $this->conn->query($sql)->fetch_array(MYSQLI_ASSOC);
            if ($res) return $res;
            else false;
        }
        public function update($opt, $chat_id) {
            $sql = "UPDATE salom SET $opt WHERE user_id = $chat_id";
            $res = $this->conn->http_build_query($sql);
            if ($res) return true;
            else return false;
        }
    }
?>