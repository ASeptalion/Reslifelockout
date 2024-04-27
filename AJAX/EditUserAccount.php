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

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Extract data from POST request
        // Extract data from POST request
        $username = $_POST['username'];
        $role = $_POST['role'];
        $building = $_POST['building'];
        $userID = $_POST['row_id']; // Retrieve the user ID from POST data

        // Construct SQL query to update user account based on user ID
        $sql = "UPDATE Users SET Position = '$role', Building = '$building' WHERE id = '$userID'";


        // Execute the SQL query
        if (mysqli_query($con, $sql)) {
            // If the query was successful, return a success message
            echo "User account updated successfully!";
        } else {
            // If there was an error with the query, return an error message
            echo "Error updating user account: " . mysqli_error($con);
        }
    } else {
        // If the request method is not POST, return an error message
        echo "Invalid request method";
    }
} else {
    // Redirect if user is not logged in
    header('Location: index.php?reason="login"');
}

