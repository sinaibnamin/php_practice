<?php
session_start();
unset($_SESSION['admin_name']);
unset($_SESSION['admin_email']);
header('Location: /admin/login.php');
exit(); 
?>