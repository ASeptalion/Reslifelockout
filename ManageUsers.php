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
    width: 97%;
    height:150px;
    text-align: center;
    margin-top: 20px;
    padding:30px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 10px;
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
    margin-left:130%;
    width: 800px;
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
.logout-button {
    background-color: transparent;
    color: white;
    border: none;
    float: right;
}

.back-button {
    position: absolute;
    top: 20px;
    left: 20px;
    background-color: #8a1f28;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
}

.back-button:hover {
    background-color: #75191f;
}

.PopWindow {
    position:absolute;
    z-index:10;
    top:5%;
    left:20%;
    padding:5px;
    display:none;
    font-family: "IntroHead";
    width:700px;
    height:450px;
    /*overflow-y:scroll;*/
    border:2px solid #000;
    border-radius:20px;
    background-color:#c0ded0;
    box-shadow: 5px 10px rgba(48, 48, 48, 0.6);
    padding:20px;
}
.close{
    float:right;
    font-size:30pt;
    padding-right:20px;
    margin-top:-40px;
    cursor:pointer;
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
                <th>User</th> <!-- Adjust width for more room -->
                <th>Role</th> <!-- Adjust width for more room -->
                <th>Action</th> <!-- Adjust width for more room -->
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
                    <button class="action-button" onClick="document.getElementById('HealthAlert').style.display='initial'">Edit</button>
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

<button class="back-button" onclick="history.back()">Back</button>

<div id="HealthAlert" class="PopWindow" style="display:none;z-index:11;background-color:#FFFFFF;height:70%;width:50%;left:25%;top:15%;position:fixed;">
    <div class="popup">
        <div class="close" onClick="document.getElementById('HealthAlert').style.display='none'">x</div>
        <div class="content">
            <h2 id="HealthAlertTitle">Edit<br/></h2>
        </div>
        <div class="content" id="HealthAlertWords" style="font-size:23px;color:black">
            Edit username, role, main building, new password, and confirm password here
        </div>
        <div style="margin-top: 20px;">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" style="margin-left: 10px;">
        </div>
        <div style="margin-top: 20px;">
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" style="margin-left: 10px;">
        </div>
        <div style="margin-top: 20px;">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" style="margin-left: 10px;">
        </div>
        <div style="margin-top: 20px;">
            <label for="role">Role:</label>
            <select id="role" name="role" style="margin-left: 10px;">
                <option value="Admin">Admin</option>
                <option value="HD">HD</option>
                <option value="RA">RA</option>
            </select>
        </div>
        <div style="margin-top: 20px;">
            <label for="building">Main Building:</label>
            <select id="building" name="building" style="margin-left: 10px;">
                <option value="Towers & Greek">Towers & Greek</option>
                <option value="Laferla">Laferla</option>
                <option value="Merick">Merick</option>
                <option value="Vandiver">Vandiver</option>
                <option value="River">River</option>
                <option value="Towers East">Towers East</option>
                <option value="Towers North">Towers North</option>
                <option value="Towers South">Towers South</option>
                <option value="Towers West">Towers West</option>
                <option value="Greek">Greek</option>
            </select>
        </div>
        <div style="margin-top: 20px;">
            <button onclick="saveUserInfo()">Save</button>
        </div>
        <img id="HealthQuestion" onClick="document.getElementById('QuestionInfo').style.display='initial'" style='display:none;' src="Images/RR_Art/WebsitePages/Icons/QuestionMark.png" width="50px"/>
    </div>
</div>




</div>

</body>
</html>
