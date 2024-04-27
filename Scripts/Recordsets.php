<?php
if(isset($_SESSION['username']))
{$User = $_SESSION['username'];}
else{
	$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  	$url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  	$url .= $_SERVER["REQUEST_URI"];
		header('Location: ../index.php?reason=login&Location='. $url);
}

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_table);
if (mysqli_connect_errno()){
  header("Location: /RR_Error201.php"); exit();
}

$datetime = date("Y-m-d H:i:s");
$date = date_create();
$TimeNow = date_timestamp_get($date);


// ------------------------------------------------------------ TEAMS ---------------------------------------------------------------
if (!function_exists('UserInfo'))
{
    function UserInfo($con, $Username) {
			$sql_UserInfo = "SELECT * FROM Users WHERE username = ?";
			$stmt_UserInfo = $con->prepare($sql_UserInfo);
			$stmt_UserInfo->bind_param("s", $Username);
			$stmt_UserInfo->execute();
			$result_UserInfo = $stmt_UserInfo->get_result();

			return $result_UserInfo;
    }
}

if (!function_exists('UserInfoByID'))
{
    function UserInfoByID($con, $UserID) {
			$sql_UserInfoByID = "SELECT * FROM Users WHERE id = ?";
			$stmt_UserInfoByID = $con->prepare($sql_UserInfoByID);
			$stmt_UserInfoByID->bind_param("s", $UserID);
			$stmt_UserInfoByID->execute();
			$result_UserInfoByID = $stmt_UserInfoByID->get_result();

			return $result_UserInfoByID;
    }
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
