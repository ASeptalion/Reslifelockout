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

$data = json_decode(file_get_contents('php://input'), true);

// Check if data is received and is an array
if (is_array($data)) {
    // Initialize success counter
    $successCount = 0;

    // Prepare and execute the update query for each selected row ID
    $query = "UPDATE Lockouts SET Processed = 1 WHERE id = ?";
    $stmt = $con->prepare($query);

    foreach ($data as $rowId) {
        // Bind parameters and execute query
        $stmt->bind_param("i", $rowId);
        if ($stmt->execute()) {
            $successCount++;
        } else {
            // Log errors if necessary
        }
    }

    // Close statement
    $stmt->close();

    // Return success message
    echo "Complete";
} else {
    echo "No data received from client or data is not an array.";
}
?>
