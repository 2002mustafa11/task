<?php
session_start();

include 'inc/header.php';
include 'inc/nav.php';

if (isset($_SESSION['user'])) {
        header('Location: profile.php');
         exit;
  }else {
    header('Location: login.php');
         exit;
  }
?>