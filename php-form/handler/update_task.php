<?php 
 
 session_start();
include '../cor/connection.php';
 

if ($_SERVER['REQUEST_METHOD']=='POST'&& isset($_POST['id'])) {
    if (strlen($_POST['name'])<4) {
        $_SESSION['error']='not found';
        header("location:../index.php");
        exit;
    }
    foreach ($_POST as $key => $value) {
        $$key =  trim(htmlspecialchars(htmlentities($value)));
    }
    $sql= "UPDATE `products` 
    SET `name`='$name',`price`='$price',`description`='$description',`qunatity`='$qunatity',`category_id`='$category'
    WHERE id=$_POST[id]";
    $conn->query($sql);

if (mysqli_affected_rows($conn)==1) {
    $_SESSION['success']='success';
}else {
    $_SESSION['error']='not found';
}
$conn->close();
header("location:../index.php");
}