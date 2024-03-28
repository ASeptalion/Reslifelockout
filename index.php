<?php
  require_once('Connections/ResLife.php');
  session_start();
  if(isset($_SESSION['username'])){
    header('Location: MainPage.php');
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
    }
    .red-block {
        background-color: red;
        width: 100%;
        height: 100px;
    }
    .image-row {
        display: flex;
        justify-content: center;
        align-items: center;
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
        justify-content: center;
        align-items: center;
    }
    .login-container {
        margin: 0 auto;
        width: 300px;
        height:150px;
        text-align: center;
        margin-top: 20px;
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
    }
    #SubmitButton{
      width:100px;
      font-size:20pt;
      border-radius: 20pt;
      margin-top:5%;
    }
</style>
</head>
<body>

<div class="red-block"></div>

<div class="image-row">
    <img src="Images/primaryLogo.png" width="400px" alt="Your Image" class="image">
</div>

<div class="red-block-2">
    <h2 style="color: white;">Residence Life Login</h2>
</div>

<div class="login-container">
    <form id="signin_form">

        <input type="text" id="desk_worker_username" name="desk_worker_username" required>
        <input type="password" id="desk_worker_password" name="desk_worker_password" required>

        <button id="SubmitButton" type="submit">Login</button>
    </form>
</div>

<div class="black-row"></div>

<script>
    $(document).ready(function(){
        $('#signin_form').submit(function(e){
            e.preventDefault(); // Prevent the form from submitting normally

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                type: 'POST',
                url: 'AJAX/LogIn.php',
                data: formData,
                success: function(res){
                  if(res == "success"){
                    window.location="MainPage.php";
                  }
                  else{
                    alert("Invalid");
                  }

                },
                error: function(xhr, status, error){
                    // Handle error
                    console.error(xhr.responseText); // Log the error message
                }
            });
        });
    });
</script>

</body>
</html>
