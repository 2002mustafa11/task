<?php
session_start();

include 'inc/header.php';
include 'inc/nav.php';
include 'cor/connection.php';

if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);}


if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    unset($_SESSION['success']);}


$cart_id=$_SESSION['user'][4];
if (isset($cart_id)) {
        $id=$_SESSION['user'][0];
    $sql="SELECT cart_products.*, Products.name ,Products.price ,Products.id AS Products_id
    FROM `cart_products` 
    INNER JOIN products ON `cart_products`.`Product_id` = `Products`.`id`
    WHERE `cart_id`='$cart_id'";
    $result=$conn->query($sql);

    $sql="SELECT SUM(`total`)AS total_price 
    FROM `cart_products` 
    INNER JOIN products ON `cart_products`.`Product_id` = `Products`.`id`
    WHERE `cart_id`=$cart_id";
    $total_price=$conn->query($sql)->fetch_assoc();
    

    ?>     
    
    <div class="col-20">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th >#</th>
                <th >category</th>
                <th >name</th>
                <th >price</th>
                <th >quantity</th>
                <th >action</th>
                
            </tr>
        </thead>
        <tbody class="table-group-divider">
        

            <?php 
            $Products_id='';
            $quantity='';
             $total='';
            while($row = $result->fetch_assoc()) {
            
                
            ?>
                <tr>
                    
                 <td><?php
                 $Products_id.='-'.$row['Products_id'];
                 
                 ?>
                
                 </td>
                    <td><?php //$row["category"]?></td>                         
                    <td><?= $row["name"]?></td>
                    <td>
                    <?php echo $row["total"];

                    $total.= '-'.$row["total"];
                    
                    ?></td>
                    <td><?php
                    $quantity.='-'.$row["quantity"];
                    ?>
                
                    </td>
                    <td class='col-2'>
                    

                    <!-- <a class='btn btn-secondary' href='handler/order.php?user=<?=$id?>'>order</a> -->
                    <a class='btn btn-secondary' href='handler/cart_task.php?del=<?=$row['id']?>&cart_id=<?=$row["cart_id"]?>&price=<?=$total_price['total_price']-$row["total"]?>'>delete</a>
                    </td>
                </tr>
            <?php }?>
            <td></td>
                    <td></td>                         
                    <td></td>
                    <td><?php 
                    echo $total_price['total_price'];
                    ?></td>
                    <td></td>
                    <td >
                    
                    </td>
                </tr>
        </tbody>
    </table>
    <form action="handler/order.php" method="get">
    <input type="hidden" name="user" value="<?=$id?>">
    <input type="hidden" name="Products_id" value="<?=$Products_id?>">
    <input type="hidden" name="total" value="<?=$total?>">
    <input type="hidden" name="quantity" value="<?=$quantity?>">
    <input type="text" name="address" value="Cairo">
    <input  class='btn-secondary'type="submit" value="order">

    </form>
                    

</div>


<?php

  }else {
    header('Location: login.php');
         exit;
  }
?>