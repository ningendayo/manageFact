<?php
session_start();

// Destroy session variables
$_SESSION = array();
session_destroy();

// Redirect to login page
header("location: login.php");