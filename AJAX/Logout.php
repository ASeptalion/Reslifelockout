<?php
session_start();
// Destroying All Sessions
if(session_destroy())
{
// Redirecting To Home Page
header("Location: ../index.php?reason=logout");
}
mysqli_close($con);
?>
