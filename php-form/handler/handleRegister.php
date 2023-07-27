<?php
session_start();

include '../cor/function.php';
include '../cor/Validation.php';
include '../cor/connection.php';
$errors=[];
if (request('POST') && input('name')) {
    
    foreach ($_POST as $key => $value) {
        $$key = test_input("$value");
    }

if (empty($name)) {
    $errors[]='error name';   
}else{
if (!minVal($name,3)) {
    $errors[]='min <3';
}
if (!maxVal($name,25)) {
    $errors[] ='max >25';
}
}

if (empty($email)) {
    $errors[]='fals email';   
}elseif (!emailVal($email)) {
    $errors[]='error email';
}

if (empty($psw)) {
    $errors[]='error psw';   
}else{
if (!minVal($psw,6)) {
    $errors[]='min <6';
}
if (!maxVal($psw,25)) {
    $errors[] ='max >25';
}
}




if (empty($errors)){

$sql="INSERT INTO `users`(`name`, `email`, `phone`, `password`) 
VALUES ('$name','$email','$phone','$psw')";
$conn->query($sql);
if ($conn->affected_rows==1) {
    $_SESSION['user']=[$name,$email];
}
$conn->close();
    redirect('../index.php');
}else {
    $_SESSION['errors']=$errors;
    redirect( '../register.php');
}

}