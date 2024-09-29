<?php
session_start();
ini_set('display_errors', 1);


// Check if user has passed OTP verification
if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    // Redirect user to login page
    header("Location: dashboard/login.php");
    exit;
}?><!DOCTYPE html>
<html>
<head>
   <meta http-equiv="refresh" 
   content="0; url=dashboard/">
</head>
<body>
</body>
</html>