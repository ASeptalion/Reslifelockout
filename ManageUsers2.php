<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Manage Users</title>
    <style>
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
    </style>
</head>

<body>
    <h1>Manage Users</h1>

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Replace the following static data with dynamic data from the database -->
            <tr>
                <td>John Doe</td>
                <td class="action-buttons">
                    <button class="action-button" onclick="editUser('John Doe')">Edit</button>
                    <button class="action-button" onclick="deleteUser('John Doe')">Delete</button>
                    <button class="action-button" onclick="changePassword('John Doe')">Change Password</button>
                </td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td class="action-buttons">
                    <button class="action-button" onclick="editUser('Jane Smith')">Edit</button>
                    <button class="action-button" onclick="deleteUser('Jane Smith')">Delete</button>
                    <button class="action-button" onclick="changePassword('Jane Smith')">Change Password</button>
                </td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>

    <script>
        function editUser(username) {
            // Implement edit user functionality here
            console.log('Editing user:', username);
        }

        function deleteUser(username) {
            // Implement delete user functionality here
            console.log('Deleting user:', username);
        }

        function changePassword(username) {
            // Implement change password functionality here
            console.log('Changing password for user:', username);
        }
    </script>
</body>

</html>
