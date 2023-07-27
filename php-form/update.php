<?php

session_start();
include_once "cor/connection.php";
include_once 'inc/header.php';
include 'inc/nav.php';
foreach ($_SESSION['user'] as $value) {
    echo("$value"),'<br>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">

<div class="row">
        
            <h1 class="text-center my-5"></h1>
            <div class="col-8 mx-auto" >
<?php 

if ($_SESSION['user'][3]==1) {

?>
    <form action="handler/update_task.php" method="post"class="form border p-1 my-5">
    <input type="hidden" name="id" value="<?=$_GET['id']?>">
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