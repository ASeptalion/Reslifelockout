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
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract data
    $fullName = mysqli_real_escape_string($con, $data['fullName']);
    $s0Number = mysqli_real_escape_string($con, $data['s0Number']);
    $isReplacement = mysqli_real_escape_string($con, $data['isReplacement']);
    $building = mysqli_real_escape_string($con, $data['building']);
    $roomNumber = mysqli_real_escape_string($con, $data['roomNumber']);
    $isCheckOut = mysqli_real_escape_string($con, $data['isCheckOut']);
    $keyCardNum = mysqli_real_escape_string($con, $data['keyCardNum']);
    $recordedBy = mysqli_real_escape_string($con, $data['recordedBy']);
    $comments = mysqli_real_escape_string($con, $data['comments']);
    $RowID = mysqli_real_escape_string($con, $data['row_id']);

    // Construct and execute SQL query to update database
    $sql = "UPDATE Lockouts SET
            FullName = '$fullName',
            S0_Number = '$s0Number',
            isReplacement = '$isReplacement',
            Building = '$building',
            RoomNumber = '$roomNumber',
            isCheckOut = '$isCheckOut',
            KeyCardNum = '$keyCardNum',
            RecordedBy = '$recordedBy',
            Comments = '$comments'
            WHERE id = $RowID";

    if (mysqli_query($con, $sql)) {
        // If update successful, send success response
        echo "success";
    } else {
        // If update fails, send error response
        echo "Error updating record: " . mysqli_error($con);
    }
} else {
    // Redirect if user is not logged in
    header('Location: index.php?reason="login"');
}
?>
