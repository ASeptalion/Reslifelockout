<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Lockout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-bottom: 0;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Create Lockout</h1>

    <form action="process_lockout.php" method="post">
        <label for="full-name">Full Name:</label>
        <input type="text" id="full-name" name="full-name" required>

        <label for="s0-number">S0 Number:</label>
        <input type="text" id="s0-number" name="s0-number" required>

        <label>Is this a replacement key?</label>
        <label><input type="radio" name="replacement-key" value="yes"> Yes</label>
        <label><input type="radio" name="replacement-key" value="no" checked> No</label>

        <label for="room-number">Room Number:</label>
        <input type="text" id="room-number" name="room-number" required>

        <label>Check In or Check Out?</label>
        <label><input type="radio" name="check-type" value="check-in" checked> Check In</label>
        <label><input type="radio" name="check-type" value="check-out"> Check Out</label>

        <label for="key-card-number">Key Card Number:</label>
        <input type="text" id="key-card-number" name="key-card-number" required>

        <label for="ra-name">RA's Name:</label>
        <input type="text" id="ra-name" name="ra-name" required>

        <label for="additional-comments">Additional Comments:</label>
        <textarea id="additional-comments" name="additional-comments" rows="4"></textarea>

        <button type="submit">Submit</button>
    </form>
</body>

</html>
