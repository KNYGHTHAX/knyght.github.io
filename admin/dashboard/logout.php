<?php
session_start();
include "Ip.php";
// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page (change "login.php" to the actual login page URL)
header("Location: login.php");
exit;
?>
