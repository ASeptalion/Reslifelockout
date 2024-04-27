<?php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection details
require_once('../Connections/db_details.php');

// Connect to the database
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_table);

// Check for connection errors
if (mysqli_connect_errno()) {
    header("Location: /RR_Error201.php");
    exit();
}

// Start session
session_start();

// Check if user is logged in
if (isset($_SESSION['username'])) {
    // Include necessary scripts
    require '../Scripts/Recordsets.php';

    echo "In here";
} else {
    // Redirect if user is not logged in
    header('Location: index.php?reason="login"');
}
?>
