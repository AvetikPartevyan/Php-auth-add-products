<?php 
include('classes/Product.php');
$products = new Product();

$all_products = $products->read();
// print_r($all_products);

while($row = $all_products['products'] ->fetch_assoc()){
    print_r($row);
    echo '<br>';
}

?>