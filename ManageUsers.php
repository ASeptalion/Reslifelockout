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
<title>Manage Users</title>
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
    display: grid; /* Change display to grid */
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Dynamic grid layout */
    gap: 10px; /* Add gap between grid items */
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 10px;
}

.action-button {
    width: auto;
    min-width: 120px;
    height: 30px;
    border-radius: 30px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 15px;
}

.red-block-e {
    background-color: red;
    margin-top:-5%;
    width: 100%;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 24px;
    text-align: center; /* Center align column names */
    border-bottom: 1px solid #ddd;
    
}

th {
    background-color: #f2f2f2;
}

.user-column {
    width: 70%; /* Adjust the width as needed */
}

th:nth-child(1) {
    width: 70%; /* Adjust the width as needed */
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

<div class="red-block-e">
    <h1 style="color: white;">Manage Users</h1>
</div>


<div class="login-container">
   

    <table>
        <thead>
            <tr>
                <th style="width: 60%;">User</th> <!-- Adjust width for more room -->
                <th style="width: 30%;">Role</th> <!-- Adjust width for more room -->
                <th style="width: 30%;">Action</th> <!-- Adjust width for more room -->
            </tr>
        </thead>
        <tbody>
            <!-- Replace the following static data with dynamic data from the database -->
            <tr>
                <td>John Doe</td>
                <td>Admin</td>
                <td class="action-buttons">
                    <button class="action-button" onclick="editUser('John Doe')">Edit</button>
                    <button class="action-button" onclick="deleteUser('John Doe')">Delete</button>
                    <button class="action-button" onclick="changePassword('John Doe')">Change Password</button>
                </td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>User</td>
                <td class="action-buttons">
                    <button class="action-button" onclick="editUser('Jane Smith')">Edit</button>
                    <button class="action-button" onclick="deleteUser('Jane Smith')">Delete</button>
                    <button class="action-button" onclick="changePassword('Jane Smith')">Change Password</button>
                </td>
            </tr>
            <!-- Add more users as needed -->
        </tbody>
    </table>

    <script>
        function editUser(username) {
            // Implement edit user functionality here
            console.log('Editing user:', username);
        }

        function deleteUser(username) {
            // Implement delete user functionality here
            console.log('Deleting user:', username);
        }

        function changePassword(username) {
            // Implement change password functionality here
            console.log('Changing password for user:', username);
        }
    </script>
</div>


<div class="black-row"></div>


</body>
</html>
