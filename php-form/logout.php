<?php
session_start();
include 'cor/function.php';

session_destroy();


redirect('login.php');
