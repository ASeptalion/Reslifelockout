<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Director Sign In</title>
</head>

<body>
    <h1>Hall Director Sign In Page</h1>

    <form action="authenticate_hall_director.php" method="post">
        <label for="hall_director_username">Username:</label>
        <input type="text" id="hall_director_username" name="hall_director_username" required>

        <label for="hall_director_password">Password:</label>
        <input type="password" id="hall_director_password" name="hall_director_password" required>

        <button type="submit">Sign In as Hall Director</button>
    </form>
</body>

</html>
