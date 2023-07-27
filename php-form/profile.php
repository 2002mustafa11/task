<?php 
session_start();
include_once "cor/connection.php";
include_once 'inc/header.php';
include 'inc/nav.php';

$id= $_SESSION['user'][0];
if (isset($_SESSION['user'])) {
    
    $sql="SELECT `id` FROM `carts` WHERE `user_id`='$id'AND `status`= '0' ";
    $cart_id =$conn->query($sql)->fetch_assoc() ;
    

    if ($conn->query($sql)->num_rows == 0) {
        $sql="INSERT INTO `carts`(`user_id`, `total`, `status`) 
        VALUES ('$id','0','0')";
        $conn->query($sql);
        $sql="SELECT `id` FROM `carts` WHERE `user_id`='$id'AND `status`= '0'";
         $cart_id =$conn->query($sql)->fetch_assoc();
    }
    $_SESSION['user'][4]=$cart_id['id'];

}else {
    header('Location: login.php');   
}

foreach ($_SESSION['user'] as $f=> $value) {
    echo $f.("$value"),'<br>';
}

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT products.*, categorys.category
            FROM products
            INNER JOIN categorys ON `products`.`category_id` = `categorys`.`id`
            WHERE `categorys`.`category` = '$category'";
} else {
    $sql = "SELECT products.*, categorys.category
            FROM products
            INNER JOIN categorys ON `products`.`category_id` = `categorys`.`id`";
}

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body><?php
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
    echo "<div class='alert alert-danger' role='alert''>".$_SESSION['error']."</div>";
    }
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success' role='alert''>".$_SESSION['success']."</div>";
           unset($_SESSION['success']);}
    ?>
    <div class="container">

<div class="row">
        
            <h1 class="text-center my-5"></h1>
            <div class="col-8 mx-auto" >
<?php 

if ($_SESSION['user'][3]==1) {

?>
    <form action="handler/store_task.php" method="post"class="form border p-1 my-5">

                <?php
                if (isset($_SESSION['success'])) {
                 echo "<div class='alert alert-success' role='alert''>".$_SESSION['success']."</div>";
                    unset($_SESSION['success']);
                }elseif (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger' role='alert''>".$_SESSION['error']."</div>";
                    unset($_SESSION['error']);
                }
                
                ?>
    <div class="mb-3">
      <label for="name" class="form-label"> name:</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label"> price:</label>
      <input type="text" class="form-control" id="email" name="price" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label"> qunatity:</label>
      <input type="text" class="form-control" id="email" name="qunatity" required>
    </div>

    <div class="mb-3">
    <label for="cars">category:</label>
    <select id="cars" name="category">
    <option value="1">phones</option>
    <option value="2">Appliances</option>
    
    </select>
    </div>

    <div class="mb-3">
      <label for="message" class="form-label">description:</label>
      <textarea class="form-control" id="message" name="description" rows="5" ></textarea>
    </div>
    <input class="btn btn-primary " type="submit" value="create">
    
  </form>
         <?php }?>   
            </div>
           <div class="col-20">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >category</th>
                        <th >name</th>
                        <th >price</th>
                        <th >action</th>
                        
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php while($row = $result->fetch_assoc()) {
                    
                        
                    ?>
                        <tr>
                            
                            <td><?=$row['id']?></td>
                            <td><?= $row["category"]?></td>                         
                            <td><?= $row["name"]?></td>
                            <td><?= $row["price"]?></td>
                            <?php 
                            if ($_SESSION['user'][3]==1) {
                            ?>
                            <td class='col-2'>
                            <a class="btn btn-secondary" href="update.php?id=<?=$row['id']?>">Edit</a>
                                <a class="btn btn-danger" href="handler/delete_task.php?id=<?=$row['id']?>">Delete</a>
                            </td>
                            <?php }
                            else {
                                $id=$_SESSION["user"][0];
                                ?>
                                
                            <td class='col-2'>
                            <form action="handler/cart_task.php" method="get">
                                <input type="hidden" name="cart_id" value="<?=$cart_id['id']?>">
                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                <input  class='btn btn-secondary'type="submit" value="add">
                                <input type="number"  name="quantity" min="1" value="1">
                            <!-- <a href='handler/cart_task.php?id=&cart_id='>add</a>-->
                            
                            </form>
                            <a class='btn btn-secondary' href='cart.php?cart_id=<?=$cart_id['id']?>'>cart</a>
                            </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>

</html>