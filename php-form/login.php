<?php 
session_start();
if (isset($_SESSION['user'])) {
  header('Location: profile.php');
   exit;
}

  
 
include 'inc/header.php';
include 'inc/nav.php';
?>

<body>

<h3>Using</h3>
<?php
if (isset($_SESSION['errors'])) {


foreach ($_SESSION['errors'] as  $value) {

echo '<br>';
?>
<div class="active">
  <?php
    echo $value,'<br>';
   }
  }
  ?>
</div>

<br><br>


  <form action="handler/handleLodin.php" method="post">

    

    <label>email</label>
    <input type="email" name="email">

    <label>password</label>
    <input type="password" name="psw">

    <input type="submit" value="Submit">
  </form>


</body>
</html>
