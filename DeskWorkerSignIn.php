<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desk Worker Sign In</title>
</head>

<body>
    <h1>Desk Worker Sign In Page</h1>

    <form action="authenticate_desk_worker.php" method="post">
        <label for="desk_worker_username">Username:</label>
        <input type="text" id="desk_worker_username" name="desk_worker_username" required>

        <label for="desk_worker_password">Password:</label>
        <input type="password" id="desk_worker_password" name="desk_worker_password" required>

        <button type="submit">Sign In as Desk Worker</button>
    </form>
</body>

</html>
