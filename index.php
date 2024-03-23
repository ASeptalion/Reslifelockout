<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Desk Worker Sign In</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <h1>Residence Life</h1>

    <form id="signin_form">
        <label for="desk_worker_username">Username:</label>
        <input type="text" id="desk_worker_username" name="desk_worker_username" required>

        <label for="desk_worker_password">Password:</label>
        <input type="password" id="desk_worker_password" name="desk_worker_password" required>

        <button type="submit">Sign In as Desk Worker</button>
    </form>

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
                      alert(res);

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
