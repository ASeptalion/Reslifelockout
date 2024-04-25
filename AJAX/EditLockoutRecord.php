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

echo "In Here";
?>
