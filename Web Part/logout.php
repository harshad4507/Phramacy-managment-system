<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = array();
$_SESSION['loggedin'] = false;

// Destroy the session
session_destroy();

// Redirect to the login page or homepage
header("location: index.php");
exit;
?>