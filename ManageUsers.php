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
    height: 80px;
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
#NewUserButton{
  position: absolute;
  top:30%;
  left:63%;
}
</style>
</head>
<body>

  <div class="red-block">
      <button onclick="location.href='AJAX/Logout.php'" id="logoutBtn" class="function-button logout-button">Logout</button>
  </div>

  <div id="HealthAlert" class="PopWindow" style="display:none;z-index:11;background-color:#FFFFFF;height:auto;width:50%;left:25%;top:15%;position:fixed;">
    <div class="popup">
        <div class="close" onClick="document.getElementById('HealthAlert').style.display='none'">x</div>
        <div class="content">
            <h2 id="HealthAlertTitle">Edit<br/></h2>
        </div>
        <div class="content" id="HealthAlertWords" style="font-size:23px;color:black">
            Edit username, role, and main building here
        </div>
        <div style="margin-top: 20px;">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" style="margin-left: 10px;" autocomplete="off">
        </div>
        <div id="passwordFields" style="display:none;">
            <input type="hidden" id="dummy_password" autocomplete="off"> <!-- Hidden input field -->
            <div style="margin-top: 20px;">
                <label for="password">New Password:</label>
                <input type="password" id="password" style="margin-left: 10px;" autocomplete="new-password">
            </div>
            <div style="margin-top: 20px;">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" style="margin-left: 10px;" autocomplete="new-password">
            </div>
        </div>
        <div style="margin-top: 20px;" id="PasswordButton">
            <button onclick="togglePasswordFields()">Change Password</button>
        </div>
        <br><br>
        Position: <select id="role" name="role" style="margin-left: 10px;" required>
            <option value="" disabled selected>Please select a role</option>
            <option value="Admin">Admin</option>
            <option value="Hall Director">Hall Director</option>
            <option value="Desk Worker">Desk Worker</option>
        </select>
        <br>
        Building: <select id="building" name="building" style="margin-left: 10px;" required>
            <option value="" disabled selected>Please select a building</option>
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
        <br>
        <input type="hidden" id="row_id" name="row_id" value="123">
        <div style="margin-top: 20px;">
            <button id="saveButton">Save</button>
        </div>
    </div>
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

<div id="NewUserButton" class="action-button" onclick="NewUser();" >New User</div>

<?php
$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);

if ($result) {
    echo '<table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Main Building</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td>' . $row['username'] . '</td>
                <td>' . $row['Position'] . '</td>
                <td>' . $row['MainBuilding'] . '</td>
                <td class="action-buttons">
                    <button class="action-button" onclick="editUser(\'' . $row['username'] . '\', \'' . $row['id'] . '\', \'' . $row['MainBuilding'] . '\', \'' . $row['Position'] . '\')">Edit</button>
                    <button class="action-button" onclick="deleteUser(\'' . $row['username'] . '\', \'' . $row['id'] . '\')">Delete</button>
                </td>
              </tr>';
    }
    echo '</tbody>
        </table>';
}
?>
</div>
<div class="black-row"></div>

<script>
    var passwordFieldsVisible = false; // Track if password fields are visible

    function togglePasswordFields()
    {
        var passwordFields = document.getElementById("passwordFields");
        if (passwordFields.style.display === "none") {
            passwordFields.style.display = "block";
            document.getElementById("password").setAttribute("name", "password");
            document.getElementById("confirm_password").setAttribute("name", "confirm_password");
            passwordFieldsVisible = true; // Set the flag to true when password fields are visible
        } else {
            passwordFields.style.display = "none";
            document.getElementById("password").removeAttribute("name");
            document.getElementById("confirm_password").removeAttribute("name");
            passwordFieldsVisible = false; // Set the flag to false when password fields are not visible
        }
    }

    function saveUserInfo(event)
    {
      var role = $('#role').val();
      var building = $('#building').val();
      var username = $('#username').val();

      var password = $('#password').val();
      var confirm_password = $('#confirm_password').val();

      // Check if role and building are either null or empty
      if (!role || !building) {
          alert("Please select a role and a building.");
          return; // Prevent further execution of the function
      }

      // Check if password fields are visible and password is entered
      if ($('#passwordFields').is(':visible') && password) {
          if (password !== confirm_password) {
              alert("The passwords you entered do not match!");
              return; // Prevent further execution of the function
          }
          else if (password.length < 6 || !/[A-Z]/.test(password)) {
              alert("Password must be at least 6 characters long and contain at least 1 capital letter.");
              return; // Prevent further execution of the function
          }
      }

      if (!username.includes('@semo.edu')) {
          alert("The username for the account should be the SEMO email on file for this person");
          return; // Prevent further execution of the function
      }

      // Collect form data
      var formData = {
          username: $('#username').val(),
          role: role,
          building: building,
          row_id: $('#row_id').val(),
          password: $('#password').val()
      };

      // If the password fields are visible and password is entered, add them to the formData
      if ($('#passwordFields').is(':visible') && password) {
          formData.password = password;
          formData.confirm_password = confirm_password;
      }

      // Send AJAX request
      $.ajax({
          type: 'POST',
          url: 'AJAX/EditUserAccount.php',
          data: formData,
          success: function(response) {
              alert(response);
              window.location.reload();
          },
          error: function(xhr, status, error) {
              alert("Error: " + error); // Alert any errors that occur during the AJAX request
          }
      });
    }

    function CreateNewUser(event)
    {
      var role = $('#role').val();
      var building = $('#building').val();
      var username = $('#username').val();

      var password = $('#password').val();
      var confirm_password = $('#confirm_password').val();

      // Check if role and building are either null or empty
      if (!role || !building) {
          alert("Please select a role and a building.");
          return; // Prevent further execution of the function
      }

      // Check if password fields are visible and password is entered
      if ($('#passwordFields').is(':visible') && password) {
          if (password !== confirm_password) {
              alert("The passwords you entered do not match!");
              return; // Prevent further execution of the function
          }
          else if (password.length < 6 || !/[A-Z]/.test(password)) {
              alert("Password must be at least 6 characters long and contain at least 1 capital letter.");
              return; // Prevent further execution of the function
          }
      }

      if (!username.includes('@semo.edu')) {
          alert("The username for the account should be the SEMO email on file for this person");
          return; // Prevent further execution of the function
      }

      // Collect form data
      var formData = {
          username: $('#username').val(),
          role: role,
          building: building,
          row_id: $('#row_id').val(),
          password: $('#password').val()
      };

      // If the password fields are visible and password is entered, add them to the formData
      if ($('#passwordFields').is(':visible') && password) {
          formData.password = password;
          formData.confirm_password = confirm_password;
      }

      // Send AJAX request
      $.ajax({
          type: 'POST',
          url: 'AJAX/CreateNewUser.php',
          data: formData,
          success: function(response) {
            // alert(response); // Alert the response from the server
               if(response == "Done"){
                 window.location.reload();
               }
          },
          error: function(xhr, status, error) {
              alert("Error: " + error); // Alert any errors that occur during the AJAX request
          }
      });
    }


    function editUser(username, UserID, Building, Role)
    {
        document.getElementById('HealthAlert').style.display = 'block';
        document.getElementById('HealthAlertTitle').innerText = 'Edit ' + username;

        var saveButton = document.getElementById('saveButton');
        saveButton.onclick = function(event) {
            saveUserInfo(event);
        };

        document.getElementById('username').value = username;
        document.getElementById('building').value = Building;
        document.getElementById('role').value = Role;
        document.getElementById('row_id').value = UserID;
    }

    function NewUser()
    {
        var saveButton = document.getElementById('saveButton');
        saveButton.onclick = function(event) {
            CreateNewUser(event);
        };

        document.getElementById('HealthAlert').style.display = 'block';
        document.getElementById('PasswordButton').style.display = 'none';
        document.getElementById('passwordFields').style.display = 'block';
    }

    function deleteUser(username, UserID)
    {
        // Ask for confirmation before deleting
        var confirmation = confirm("Are you sure you want to delete user " + username + "?");
        if (confirmation) {
          $.ajax({
              type: 'POST',
              url: 'AJAX/DeleteUser.php',
              data: { UserID: UserID },
              success: function(response) {
                  if(response == "Complete"){
                    window.location.reload();
                  }
              },
              error: function(xhr, status, error) {
                  alert("Error: " + error); // Alert any errors that occur during the AJAX request
              }
          });
        }
    }


</script>
<button class="back-button" onclick="history.back()">Back</button>
</div>
</body>
</html>
