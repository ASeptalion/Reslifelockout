<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        h1 {
            color: #333;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .sign-in-button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        #hall-director-button {
            background-color: #3498db;
            color: #fff;
        }

        #desk-worker-button {
            background-color: #2ecc71;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>Welcome to Your Hall</h1>

    <div class="button-container">
        <button id="hall-director-button" class="sign-in-button"><a href="DeskManagerSignIn.php"/>Hall Director Sign In</a></button>
        <button id="desk-worker-button" class="sign-in-button"><a href="DeskWorkerSignIn.php"/>Desk Worker Sign In</a></button>
    </div>
</body>
</html>
