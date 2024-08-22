<?php
    class Auth {
        private $db;
        public function __construct() {
            $this->db = new DB();
            if(isset($_POST['method'])){
                $method = $_POST['method'];
                call_user_func([$this, $method]);
            }
        }

        public function login(){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
            $result = $this-> db-> connect() -> query($sql);
            if($result -> num_rows > 0){
                $_SESSION['id'] = $result->fetch_assoc()['id'];
                print_r(1);
            }
            else{
                print_r(0);
            }
            exit;
        }
        public function register(){
            $email = $this->db->data($_POST['email']);
            $password = $_POST['password'];
            $full_name = $this->db->data($_POST['full_name']);
            $username = $this->db->data($_POST['username']);
            $token = md5($email.$full_name.$username.rand(1000,9999));
            include ('classes/email.php');
            $sql = ("INSERT INTO `users` (`email`,`password`,`full_name`,`username`,`token`) 
                    VALUES ('$email','$password','$full_name','$username','$token')");
            $result = $this -> db ->  insert($sql);
            print_r($result);
            if($result['status']){
                sendEmail($full_name,$email,$token,'verificate');
                echo(1);
                exit;
            }
            else{
                echo(0);
                exit;
            }
        }

        public function validate_email($token) {
            $sql2 = "SELECT id FROM users WHERE token = '$token'";
            $user = $this->db->fetch($sql2);
            if($user['status']){
                $_SESSION['id'] = $user['message']['id'];
            }
            $sql = "UPDATE users SET status = '1', token = NULL WHERE token = '$token'";
            $result = $this->db->check($sql);
            if($result['status']){
                echo 1;
            }
            else{
                echo 'wrong link';
            }
        }
        public function forgot_password(){
            $email = $_POST['email'];
            $sql2 = "SELECT * FROM users WHERE email = '$email'";
            $user = $this->db->fetch($sql2);

            if($user['status']){
                include ('classes/email.php');
                $full_name = $user['message']['full_name'];
                $username = $user['message']['username'];
                $token = md5($email.$full_name.$username.rand(1000,9999));
                $sql = "UPDATE users SET token = '$token' WHERE email = '$email'";
                $result = $this->db->check($sql);
                if($result['status']){
                    sendEmail($full_name,$email,$token,'change_password' );
                }
            }

        }
        public function change_password(){
        }
    }
?>