<?php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../Connections/db_details.php');
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_table);
if (mysqli_connect_errno()){
  header("Location: /RR_Error201.php"); exit();
}
session_start();
if(isset($_SESSION['username']))
{
  require '../Scripts/Recordsets.php';
}
else{
	header('Location: index.php?reason="login"');
}

// Fetch user info
$result_UserInfo = UserInfo($con, $User);
$row_UserInfo = mysqli_fetch_assoc($result_UserInfo);
$Position = $row_UserInfo['Position'];

// Check if rowId is set
if (isset($_POST['rowId'])) {
    $rowId = $_POST['rowId'];

    // Update the database
    $query = "UPDATE Lockouts SET Processed = 1 WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $rowId);
    if ($stmt->execute()) {
        echo "success";
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Error updating database: " . $stmt->error;
    }
    $stmt->close();
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Missing rowId parameter";
}
?>
