<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .log-lockout {
            width: 200px;
            height: 200px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            line-height: 200px;
            border-radius: 10px;
            cursor: pointer;
        }

        .log-lockout:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome, <span id="logged-in-user">John Doe</span>!</h1>
    </header>

    <div class="container">
        <div class="log-lockout">
            <a href="LockoutCreate.php"/>Log a Lockout</a>
        </div>
    </div>

    <script>
        // Replace this script with actual user authentication logic
        document.getElementById('logged-in-user').innerText = "John Doe";


    </script>
</body>

</html>
