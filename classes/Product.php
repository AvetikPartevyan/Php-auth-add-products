<?php

require('Upload.php');
class Product
{
    private $db;
    private $method;
    public function __construct()
    {
        $this->db = new DB();
        $this->method = (isset($_POST['method']) ? $_POST['method'] : null);
        switch ($this->method) {
            case 'create':
                $this->create();
                break;
            case 'read':
                $this->read();
                break;
            case 'read_by_ajax':
                $this->read_by_ajax();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
        }
    }
    // տվյալի տեղադրում
    public function create()
    {
        $title = $this->db->data($_POST['title']);
        $description = $this->db->data($_POST['description']);
        $price = $this->db->data($_POST['price']);
        $category = $this->db->data($_POST['category']);
        $user_id = $this->db->data($_SESSION['id']);
        $file_upload = new Upload();
        // print_r($file_upload);
        $file_name = $file_upload->upload_image('images', 3, 'uploads');
        $sql = "INSERT INTO `products` (`title`,`user_id`,`image`,`description`,`price`,`category`)
                            VALUES('$title','$user_id','$file_name','$description','$price','$category')";
        $result = $this->db->insert($sql);
        if($result['status'] == 1){
            // header('Location: views/products.php');
            
        }
        else{
            print_r($result['message']);
        }
    }

    // կարդալ տվյալներըը
    public function read()
    {
        $start = 1;
        $end = 12;
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM `products` WHERE `id` = '$id'";
            $sql2 = "SELECT COUNT(id) AS total FROM `products` WHERE `id` = '$id'";

        }
        else{
            $sql = "SELECT * FROM `products`";
            $sql2 = "SELECT COUNT(id) AS total FROM `products`";
        }
        $result = $this->db->fetchAll($sql);
        $total = $this->db->fetch($sql2);        
        if($result['status'] == 1){
            return ['products'=>$result['message'], 'total' => $total['message']['total']];
        }
        else{
            return false;
        }
    }
    public function read_by_user(){
        $user_id = $_SESSION['id'];
        $sql = "SELECT * FROM products WHERE user_id = '$user_id'";
        $result = $this->db->connect()->query($sql)->fetch_all(MYSQLI_ASSOC);
        return($result);
    }
    public function read_by_ajax(){
        $start = ($_POST['start']-1) * 12;
        $end = 12;
        $sql = "SELECT * FROM `products` LIMIT $start, $end";
        $result = $this->db->connect()->query($sql)->fetch_all(MYSQLI_ASSOC);
        print_r(json_encode($result));
        // print_r($_POST);
    }

    // թարմացնել տվյալները
    public function update()
    {
        $p_id = $_POST['id'];
        $user_id = $_SESSION['id'];
        $title = $this->db->data($_POST['title']);
        $desc = $this->db->data($_POST['desc']);
        $sql = "UPDATE `products` SET `title` = '$title', `description` = '$desc' WHERE `id`='$p_id' AND `user_id` = '$user_id'";
        $result = $this->db->check($sql);
        if($result['status'] == 1){
            echo 'deleted';
        }
        else{
            echo ' smt wrong';
        }
    }

    // հեռացները տվյալները
    public function delete()
    {
        $p_id = $_POST['id'];
        $user_id = $_SESSION['id'];

        $sql = "DELETE FROM products WHERE id='$p_id' AND user_id = '$user_id'";
        $result = $this->db->check($sql);
        if($result['status'] == 1){
            echo 'deleted';
        }
        else{
            echo ' smt wrong';
        }
    }
}
?>