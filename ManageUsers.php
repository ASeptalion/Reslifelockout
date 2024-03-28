<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        #user-list {
            list-style-type: none;
            padding: 0;
        }
        .user-item {
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 5px;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            float: right;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1>User Management</h1>
    <div id="user-list-container">
        <ul id="user-list"></ul>
    </div>
    <div id="add-user-container">
        <input type="text" id="username" placeholder="Enter username">
        <button onclick="addUser()">Add User</button>
    </div>

    <script>
        let users = [];

        function renderUsers() {
            const userList = document.getElementById("user-list");
            userList.innerHTML = "";
            users.forEach((user, index) => {
                const listItem = document.createElement("li");
                listItem.className = "user-item";
                listItem.innerHTML = `${user} <button class="delete-btn" onclick="deleteUser(${index})">Delete</button>`;
                userList.appendChild(listItem);
            });
        }

        function addUser() {
            const usernameInput = document.getElementById("username");
            const username = usernameInput.value.trim();
            if (username) {
                users.push(username);
                renderUsers();
                usernameInput.value = "";
            } else {
                alert("Please enter a username.");
            }
        }

        function deleteUser(index) {
            users.splice(index, 1);
            renderUsers();
        }

        // Initial rendering
        renderUsers();
    </script>
</body>
</html>
