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
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
    <style>

    </style>
</head>

<body>
    <header>
        <h1>Welcome, <span id="logged-in-user">John Doe</span>!</h1>
    </header>
    <a href="LockoutCreate.php">
    <div class="container">
        <?php
          if($Position == "Admin"){
            ?>
            <div class="log-lockout">
                <a href="LockoutCreate.php"/>Manage Users</a>
            </div>
            <div class="log-lockout">
                <a href="LockoutCreate.php"/>Change Passwords</a>
            </div>
            <div class="log-lockout">
                <a href="LockoutCreate.php"/>View Lockouts</a>
            </div>
            <?php
          }
          else if($Position == "Hall Director"){
            ?>
            <div class="log-lockout">
                <a href="LockoutCreate.php"/>View Lockouts</a>
            </div>
            <?php
          }
        ?>
        <div class="log-lockout">
        Log a Lockout
        </div>
    </div>
</a>

</body>

</html>
