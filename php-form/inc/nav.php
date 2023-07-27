



<body>

<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="profile.php?category=phones">phones</a></li>
  <li><a href="profile.php?category=Appliances">Appliances</a></li>
  <?php if (empty($_SESSION['user'])) {
  ?>
  <li><a href="login.php">login</a></li>
  <li><a href="register.php">register</a></li>
  <?php }else {
  ?>
  <li><a href="profile.php">profile</a></li>
<?php }
if (isset($_SESSION['user'])) {
?>
  <li style="float:right"><a class="active" href="logout.php">logout</a></li>

<?php
}
?>
</ul>
</body>
</html>


