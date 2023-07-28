<?php
session_start();
$id=$_SESSION['user'][0];
include 'cor/connection.php';

$sql = "SELECT `product_id`
FROM `orders` 
INNER JOIN `order_products`
ON `orders`.`id`=`order_products`.`order_id`
WHERE `orders`.`user_id`='$id'AND `orders`.`status`='0'";
$product_id=$conn->query($sql);

while ($row=$product_id->fetch_assoc()) {

    $sql="SELECT * FROM `products` WHERE `id`='$row[product_id]'";
    $product=$conn->query($sql);


    while ($row=$product->fetch_assoc()) {
    echo '<pre>';
    print_r($row);
    }
}




