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

    // Retrieve data from the AJAX request
      $UserToDelete = mysqli_real_escape_string($con, $_POST['UserID']);

      mysqli_query($con, "DELETE From Users WHERE id='$UserToDelete'");
      echo "Complete";

} else {
    // Redirect if user is not logged in
    header('Location: index.php?reason="login"');
}
?>
