<?php
ob_start();
session_start();
include 'connect.php';

session_unset();
session_destroy();

header('location: admin_login.php');
ob_end_flush();
?>