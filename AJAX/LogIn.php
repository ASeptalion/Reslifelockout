<?php
require_once('../Connections/ResLife.php');

// Check if the form data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the POST data
    $username = $_POST['desk_worker_username'];
    $password = $_POST['desk_worker_password'];

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_table);
    if (mysqli_connect_errno()) {
        echo "error"; // Return error if unable to connect to the database
    } else {
        // Escape user inputs to prevent SQL injection
        $username = mysqli_real_escape_string($con, $username);
        $password = mysqli_real_escape_string($con, $password);

        // Query to check if the username and password match
        $query = "SELECT * FROM Users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($con, $query);

        // Check if there is a matching row
        if (mysqli_num_rows($result) == 1) {
            // Authentication successful
            session_start();
            $_SESSION['username'] = $username; // Store the username in the session
            echo "success"; // Return success
        } else {
            // Authentication failed
            echo "invalid"; // Return invalid
        }
        // Close the database connection
        mysqli_close($con);
    }
} else {
    // If the request method is not POST, return an error
    echo "error";
}
?>
