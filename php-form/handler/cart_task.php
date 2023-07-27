<?php
include '../cor/connection.php';

if (isset($_GET['id'])) {
$sql="SELECT `price`,`qunatity` FROM `products` WHERE `id`='$_GET[id]'";
$result =$conn->query($sql)->fetch_assoc();


if ($conn->query($sql)->num_rows >0) {
$count=$_GET['quantity'];
if ($count < $result['qunatity']) {
    $total=$count*$result['price'];
    $sql="INSERT INTO `cart_products`(`cart_id`, `product_id`, `quantity`, `price`, `total`) 
    VALUES ('$_GET[cart_id]','$_GET[id]','$count','$result[price]','$total')";
    $conn->query($sql);

    $sql="SELECT SUM(`total`)AS total FROM `cart_products` WHERE `cart_id`='$_GET[cart_id]'";
    $result =$conn->query($sql)->fetch_assoc();

    $sql="UPDATE `carts` SET `total`='$result[total]' WHERE id='$_GET[cart_id]'";
    $conn->query($sql);
}
    
    header('Location: ../profile.php');
    exit;
}else {
    header('Location: ../profile.php');
    exit;
}
    

} elseif (isset($_GET['del'])) {
    

    
    $sql="DELETE FROM `cart_products` WHERE `id`='$_GET[del]'";
    $conn->query($sql);

    $sql="UPDATE `carts` SET `total`='$_GET[price]' WHERE id='$_GET[cart_id]'";
    $conn->query($sql);

    header('Location: ../cart.php');
}

