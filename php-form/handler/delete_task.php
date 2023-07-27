<?php
session_start();
include '../cor/connection.php';


if ($_SERVER['REQUEST_METHOD']=='GET'&& isset($_GET['id'])) {

$sql= "DELETE FROM `products` WHERE id=$_GET[id]";

$conn->query($sql);



if ($conn->affected_rows==1) {
    $_SESSION['success']='success';
}else {
    $_SESSION['error']='not found';
}
$conn->close();
header("location:../index.php");
}