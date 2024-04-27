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

        $result_UserInfoByID = UserInfoByID($con, $userID);
        $row_UserInfoByID = mysqli_fetch_assoc($result_UserInfoByID);

        $CurrentUsername = $row_UserInfoByID['username'];
        $Additions = "";

        if ($CurrentUsername != $NewUsername && $NewUsername != "") {
            $Additions = $Additions . " , username = '" . $NewUsername . "'";
        } elseif ($NewPassword != "") {
            $Additions = $Additions . " , password = '" . $NewPassword . "'";
        }

        $sql = "UPDATE Users SET Position = '$role', MainBuilding = '$building' $Additions WHERE id = '$userID'";

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
