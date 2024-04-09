<?php
require_once('Connections/db_details.php');
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_table);
if (mysqli_connect_errno()){
  header("Location: /RR_Error201.php"); exit();
}
session_start();
if(isset($_SESSION['username']))
{
  require 'Scripts/Recordsets.php';
}
else{
	header('Location: index.php?reason="login"');
}

$result_UserInfo = UserInfo($con, $User);
$row_UserInfo = mysqli_fetch_assoc($result_UserInfo);

$Position = $row_UserInfo['Position'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Page Title</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}
.red-block {
    background-color: red;
    width: 100%;
    height: 50px;
}
.image-row {
    display: flex;
    align-items: flex-start; /* Adjust alignment */
    height: 200px;
}
.image {
    max-width: 100%;
    max-height: 100%;
}
.red-block-2 {
    background-color: red;
    width: 100%;
    height: 50px;
    display: flex;
    padding:5px;
    text-align: left;
    margin-top:-3%;
}
.login-container {
    margin: 0 auto;
    width: 500px;
    height:150px;
    text-align: center;
    margin-top: 20px;
    padding:30px;
}
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}
.black-row {
    background-color: black;
    width: 100%;
    height: 50px;
    position: fixed; /* Fixed position to stick at the bottom */
    bottom: 0; /* Stick to the bottom */
    left: 0; /* Align to the left */
    z-index: 999; /* Ensure it's above other content */
}
#SubmitButton{
  width:100px;
  font-size:20pt;
  border-radius: 20pt;
  margin-top:5%;
}
.function-button {
    background-color: #8a1f28; /* Green */
    border: none;
    color: white;
    padding: 10px 20px; /* Adjust padding */
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    margin-right: 10px; /* Adjust margin between buttons */
    cursor: pointer;
    border-radius: 8px;
    width: 150px; /* Adjust button width */
    box-sizing: border-box; /* Ensure padding and border included in width */
}

.login-container {
    text-align: left; /* Align buttons left */
    display: flex; /* Change display to flex */
    flex-wrap: nowrap; /* Prevent wrapping */
}
.logout-button {
    background-color: transparent;
    color: white;
    border: none;
    float: right;
}



</style>
</head>
<body>

<div class="red-block">
    <button onclick="location.href='AJAX/Logout.php'" id="logoutBtn" class="function-button logout-button">Logout</button>
</div>


<div class="image-row">
    <img src="Images/primaryLogo.png" width="300px" alt="Your Image" class="image">
</div>

<div class="red-block-2">
    <h2 style="color: white;">Welcome <?php echo $User?></h2>
</div>


<div class="login-container">
  <?php
    if($Position == "Admin"){
      ?>
      <button onclick="location.href='ManageUsers.php'" id="manageUsersBtn" class="function-button">Manage Users</button>
      <button onclick="location.href='ViewLockouts.php'" id="viewLockoutsBtn" class="function-button">View Lockouts</button>
      <?php
    }
    else if($Position == "Admin"){
      ?>
      <button onclick="location.href='ViewLockouts.php'" id="viewLockoutsBtn" class="function-button">View Lockouts</button>
      <?php
    }
  ?>
  <button onclick="location.href='LockoutCreate.php'" id="logLockoutBtn" class="function-button">Log a Lockout</button>
</div>


<div class="black-row"></div>


</body>
</html>
