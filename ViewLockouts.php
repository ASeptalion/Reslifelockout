<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lockout Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    <h1>Lockout Information</h1>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>S0 Number</th>
                <th>Replacement Key</th>
                <th>Room Number</th>
                <th>Check Type</th>
                <th>Key Card Number</th>
                <th>RA's Name</th>
                <th>Additional Comments</th>
            </tr>
        </thead>
        <tbody>
            <!-- Replace the following static data with dynamic data from the database -->
            <tr>
                <td>John Doe</td>
                <td>S01234567</td>
                <td>No</td>
                <td>123</td>
                <td>Check In</td>
                <td>987654</td>
                <td>Jane RA</td>
                <td>No issues reported</td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>S09876543</td>
                <td>Yes</td>
                <td>456</td>
                <td>Check Out</td>
                <td>123456</td>
                <td>Bob RA</td>
                <td>Lost original key</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>

</html>
