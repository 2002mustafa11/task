<?php
session_start();
include '../cor/connection.php';


if ($_SERVER['REQUEST_METHOD']=='POST'&& isset($_POST['name'])) {
if (strlen($_POST['name'])<4) {
    $_SESSION['error']='not found';
    header("location:../index.php");
    exit;
}
    

foreach ($_POST as $key => $value) {
    $$key =  trim(htmlspecialchars(htmlentities($value)));
}

$sql= "INSERT INTO `products`(`name`, `price`, `description`,`qunatity`,`category_id`) 
VALUES ('$name','$price','$description','$qunatity','$category')";
$conn->query($sql);

if ($conn->affected_rows==1) {
    $_SESSION['success']='success';
}
$conn->close();

header("location:../index.php");
}