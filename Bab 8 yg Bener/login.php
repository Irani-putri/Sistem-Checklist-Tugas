<?php
session_start();
$_SESSION['username'] = 'UserDummy';
header('location:dashboard.php');
?>
