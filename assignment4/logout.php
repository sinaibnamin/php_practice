<?php
session_start();
unset($_SESSION['customer_first_name']);
unset($_SESSION['customer_last_name']);
unset($_SESSION['customer_email']);
header('Location: login.php');
exit(); 
?>