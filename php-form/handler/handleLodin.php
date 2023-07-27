<?php
session_start();

include '../cor/function.php';
include '../cor/connection.php';
include '../cor/Validation.php';
$errors=[];
if (request('POST') && input('email')) {
    foreach ($_POST as $key => $value) {
        $$key = test_input($value);
    }

    if (empty($email)) {
        $errors[]='fals email'; 
    }
    if (empty($psw)) {
        $errors[]='fals psw'; 
    }



    if (empty($errors)) {

      $sql="SELECT * FROM `users` WHERE `email`='$email' AND `password`='$psw'";
      $row=$conn->query($sql);

        
        $name=$row->fetch_assoc();
          
        if ($conn->affected_rows==1) {


            if (isset($name['id'])) {
             $id=$name['id'];
                $sql="SELECT `id` FROM `carts` WHERE `user_id`='$id'AND `status`= '0' ";
                $cart_id =$conn->query($sql)->fetch_assoc() ;
                
            
                if ($conn->query($sql)->num_rows == 0) {
                    $sql="INSERT INTO `carts`(`user_id`, `total`, `status`) 
                    VALUES ('$id','0','0')";
                    $conn->query($sql);
                    $sql="SELECT `id` FROM `carts` WHERE `user_id`='$id'AND `status`= '0'";
                     $cart_id =$conn->query($sql)->fetch_assoc();
                }
            }else {
                header('Location: login.php');   
            }

           $_SESSION['user']=[$name['id'],$name['name'],$email,$name['priv_id'],$cart_id['id']];
            redirect('../index.php');
        }else {
            $errors[]='fals'; 
            $_SESSION['errors']=$errors;
            redirect( '../login.php');
        }
        
        
        
        
    
    }else {
        $_SESSION['errors']=$errors;
        redirect( '../login.php');
    }
}