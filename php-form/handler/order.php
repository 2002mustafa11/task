<?php  
include '../cor/connection.php';
include '../cor/function.php';

session_start();



foreach ($_GET as $key => $value) {
    echo '<br>';
     $$key = explode('-',$_GET[$key]);

    
}
$c=count($Products_id)-1;


if (isset($_GET['user'])&&isset($_GET['address']) ) {
    $address=test_input($_GET['address']);

    if (strlen($address)<5) {
        $_SESSION['error']='Enter the full address';
        header('Location: ../cart.php');
        exit;
    }else{

        $sql="INSERT INTO `orders`(`order_code`, `user_id`, `address`, `status`) 
    VALUES ('0101$_GET[user]','$_GET[user]','$address','0')";
    $conn->query($sql);
    
    $sql="SELECT id FROM `orders`  
    ORDER BY `orders`.`id` DESC LIMIT 1";
    echo $order_id=$conn->query($sql)->fetch_assoc()['id'];

    $sql="UPDATE `carts` SET `status`='1' WHERE `user_id`='$_GET[user]'";
    $conn->query($sql);
     for ($i=1; $i <= $c; $i++) { 
        $sql0="INSERT INTO `order_products`(`product_id`, `order_id`, `quantity`, `total`) 
        VALUES ('$Products_id[$i]','$order_id','$quantity[$i]','$total[$i]')";
        $conn->query($sql0);
     }
    

    
    
    $_SESSION['success']='success';
   // header('Location: ../profile.php');
    }
   
    
}