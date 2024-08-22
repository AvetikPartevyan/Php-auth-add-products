<?php
    class DB{
        private $host;
        private $name;
        private $user;
        private $password;
        public $db;

        public function __construct() {
            $this -> host = 'localhost';
            $this -> name = 'firstProj';
            $this -> user = 'root';
            $this -> password = 'root';
            $this->connect();
        }
        public function connect(){
            $this->db = new mysqli($this->host, $this->user, $this->password, $this->name);
            if($this->db->connect_error){
                return $this->db->connect_error;
            }
            else{
                return $this->db;
            }
        }
        public function data($el){
            $el = trim($el);
            $el = stripslashes($el);
            $el = strip_tags($el);
            $el = htmlspecialchars($el);
            return $el;
        }

        public function insert($sql){
            if($this->db->query($sql)){
                return ['status'=> 1, 'message'=>'Inserted succefully'];
            }
            else{
                return ['status'=> 0, 'message' => $this->db->error];
            }
        }

        public function fetch($sql){
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                return ['status'=> 1, 'message'=>$result->fetch_assoc()];
            }
            else{
                return ['status'=> 0, 'message' => $this->db->error];
            }
        }

        public function fetchAll($sql){
            $result = $this -> db -> query($sql);
            if($this->db->error){
                return ['status'=> 0, 'message' => $this->db->error];
            }
            else if($result->num_rows > 0){
                return ['status'=> 1, 'message'=>$result];
            }
            else{
                return ['status'=> 0, 'message' => $this->db->error];
            }
        }

        public function check($sql){
            $this->db->query($sql);
            if($this->db->affected_rows > 0){
                return ['status'=> 1, 'message'=> $this->db->affected_rows];
            }
            else{
                return ['status'=> 0, 'message' => $this->db->error];
            }
            
        }

        // public function queryBool($sql) {
        //     return ($this->db->query($sql) === TRUE ? TRUE : $this->db->error);
        // }
        // public function fetch($sql) {
        //     $row = $this->db->query($sql);
        //     if($row -> num_rows > 0){
        //         return($row->fetch_assoc());
        //     }
        //     return($this->db->error);
        // }
    }
?>