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
$Building = $row_UserInfo['MainBuilding'];

if (isset($_POST['rowId'])) {
    $rowId = $_POST['rowId'];

    // Update the database
    $query = "UPDATE Lockouts SET Processed = 1 WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $rowId);
    $stmt->execute();
    $stmt->close();
}
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
    min-height: 115vh; /* Set minimum height to viewport height */
    overflow-y: auto; /* Enable vertical scrolling if content exceeds viewport height */
}
.red-block {
    background-color: red;
    width: 100%;
    height: 80px; /* Increased height */
}
.image-row {
    display: flex;
    align-items: flex-start; /* Adjust alignment */
    height: 300px; /* Increased height */
}
.image {
    max-width: 100%;
    max-height: 100%;
}
.red-block-2 {
    background-color: red;
    width: 100%;
    height: 80px; /* Increased height */
    display: flex;
    padding:5px;
    text-align: left;
    margin-top:-9%;
}
.login-container {
    margin: 0 auto;
    width: 97%;
    height:400px; /* Increased height */
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
    height: 50px; /* Increased height */
    position: fixed; /* Fixed position to stick at the bottom */
    bottom: 0; /* Stick to the bottom */
    left: 0; /* Align to the left */
    z-index: 999; /* Ensure it's above other content */
}
#SubmitButton{
  width:100px;
  font-size:20pt;
  border-radius: 20pt;
  margin-top:10px; /* Adjust spacing between button and the black line */
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
}
.logout-button {
    background-color: transparent;
    color: white;
    border: none;
    float: right;
}
#SubmitButton {
    width: 29%;
    font-size: 20pt;
    border-radius: 20pt;
    margin-top: 10px;
    background-color: #8a1f28;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#SubmitButton:hover {
    background-color: #75191f;
}
.form-wrapper {
    border: 1px solid #ccc;
    padding: 20px;
    margin-top: 20px;
    width: 100%;
    height:168%;
    margin: 0 auto;
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
.form-container {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}
table {
    width: 100%;
    border-collapse: collapse;
}

table th,
table td {
    border: 1px solid #ccc;
    padding: 8px;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.form-container {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}

/* Apply alternating row colors */
table {
    width: 100%;
    border-collapse: collapse;
}

table th,
table td {
    border: 1px solid #ccc;
    padding: 8px;
    cursor: pointer; /* Add cursor pointer for column headers */
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
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
    <h1 style="color: white;">Lockout Information</h1>
</div>


<div class="login-container">

  <table id="lockoutTable">
      <thead>
          <tr>
            <th onclick="sortTable(0)">
              Date Submitted <span id="sortIcon0"></span>
            </th>
            <th onclick="sortTable(1)">
              Full Name <span id="sortIcon1"></span>
            </th>
            <th onclick="sortTable(2)">
              S0 Number <span id="sortIcon2"></span>
            </th>
            <th onclick="sortTable(3)">
              Replace? <span id="sortIcon3"></span>
            </th>
            <th onclick="sortTable(4)">
              Building <span id="sortIcon4"></span>
            </th>
            <th onclick="sortTable(5)">
              Room Number <span id="sortIcon5"></span>
            </th>
            <th onclick="sortTable(6)">
              Check Type <span id="sortIcon6"></span>
            </th>
            <th onclick="sortTable(7)">
              Key Card Number <span id="sortIcon7"></span>
            </th>
            <th onclick="sortTable(8)">
              RA's Name <span id="sortIcon8"></span>
            </th>
            <th onclick="sortTable(9)">
              Additional Comments <span id="sortIcon9"></span>
            </th>
            <th>
                Completed
            </th>

          </tr>
      </thead>
        <tbody>
            <?php
            // Query the Lockouts table
            $sql = "SELECT * FROM Lockouts WHERE Building = '$Building'";
            $result = mysqli_query($con, $sql);

            // Output data of each row
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["DateRecorded"] . "</td>";
                    echo "<td>" . $row["FullName"] . "</td>";
                    echo "<td>" . $row["S0_Number"] . "</td>";
                    echo "<td>" . $row["isReplacement"] . "</td>";
                    echo "<td>" . $row["Building"] . "</td>";
                    echo "<td>" . $row["RoomNumber"] . "</td>";
                    echo "<td>" . $row["isCheckOut"] . "</td>";
                    echo "<td>" . $row["KeyCardNum"] . "</td>";
                    echo "<td>" . $row["RecordedBy"] . "</td>";
                    echo "<td>" . $row["Comments"] . "</td>";
                    ?>
                    <td>
                        <input type="checkbox" class="completed-checkbox" data-rowid="<?php echo $row['ID']; ?>">
                    </td>
                    <?php
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No lockout information available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</div>

<script>
function sortTable(columnIndex) {
    var table, rows, switching, i, x, y, shouldSwitch, icon;
    table = document.getElementById("lockoutTable");
    switching = true;

    // Get the icon element associated with the clicked column
    icon = document.getElementById("sortIcon" + columnIndex);

    // Get the current sorting direction for the clicked column
    var currentDirection = icon.getAttribute("data-direction") || "asc";

    // Toggle sorting direction and update icon
    if (currentDirection === "asc") {
        icon.innerHTML = "&#9660;"; // Down arrow
        icon.setAttribute("data-direction", "desc");
    } else {
        icon.innerHTML = "&#9650;"; // Up arrow
        icon.setAttribute("data-direction", "asc");
    }

    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[columnIndex];
            y = rows[i + 1].getElementsByTagName("td")[columnIndex];

            // Compare the content of two cells based on the sorting direction
            if (columnIndex === 0) { // Date column
                console.log("Comparing dates:", x.innerHTML, y.innerHTML);
                if (
                    (currentDirection === "asc" && compareDates(x.innerHTML, y.innerHTML) > 0) ||
                    (currentDirection === "desc" && compareDates(x.innerHTML, y.innerHTML) < 0)
                ) {
                    shouldSwitch = true;
                    break;
                }
            } else { // Other columns
                if (
                    (currentDirection === "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) ||
                    (currentDirection === "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())
                ) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

function compareDates(dateStr1, dateStr2) {
    // Try parsing date strings in different formats
    var date1 = new Date(dateStr1);
    if (isNaN(date1.getTime())) {
        date1 = new Date(Date.parse(dateStr1.replace(/-/g, '/')));
    }
    var date2 = new Date(dateStr2);
    if (isNaN(date2.getTime())) {
        date2 = new Date(Date.parse(dateStr2.replace(/-/g, '/')));
    }

    // Return the difference in milliseconds
    return date1.getTime() - date2.getTime();
}

var checkboxes = document.querySelectorAll('.completed-checkbox');
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var rowId = this.getAttribute('data-rowid');
        var tableRow = this.closest('tr');

        // Remove the row from the table
        tableRow.parentNode.removeChild(tableRow);

        // Send an AJAX request to update the database
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_completed.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Request successful, handle response if needed
                } else {
                    // Error handling
                }
            }
        };
        xhr.send('rowId=' + rowId);
    });
});
</script>

<div class="black-row"></div>


</body>
</html>
