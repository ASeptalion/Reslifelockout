<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../Connections/db_details.php');
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_table);
session_start();

// Check if user is logged in
if (isset($_SESSION['username'])) {
    // Include necessary scripts
    require '../Scripts/Recordsets.php';

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $NewUsername = $_POST['username'];
        $role = $_POST['role'];
        $building = $_POST['building'];
        $userID = $_POST['row_id'];
        $NewPassword = $_POST['password'];

        mysqli_query($con, "INSERT INTO Users(Position, username, password, MainBuilding) VALUES('$role', '$NewUsername', '$NewPassword', '$building')");

        echo "Done";

    } else {
        // If the request method is not POST, return an error message
        echo "Invalid request method";
    }
} else {
    // Redirect if user is not logged in
    header('Location: index.php?reason="login"');
}
