<?php
ob_start(); // Start output buffering

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "my_account";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        $create_message = "User created successfully!";
    } else {
        $create_message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 400px;
            text-align: center;
        }

        .container img {
            max-width: 180px;
            margin-bottom: 30px;
        }

        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .container select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .container button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .container button:hover {
            background-color: #45a049;
        }

        .container a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #333;
        }

        .create-message {
            margin-top: 20px;
            color: #4CAF50;
        }

        .delete-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 400px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create User</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div style="text-align: left; margin-top: 20px;">
                <p><strong>Username</strong></p>
            </div>
            <input type="text" id="username" name="username" placeholder="Enter a username" required>

            <div style="text-align: left; margin-top: 20px;">
                <p><strong>Password</strong></p>
            </div>
            <input type="password" id="password" name="password" placeholder="Enter a password" required>

            <div style="text-align: left; margin-top: 20px;">
                <p><strong>Role</strong></p>
            </div>
            <select id="role" name="role" required>
                <option value="">Select a role</option>
                <option value="owner">Admin</option>
                <option value="worker">Employee</option>
            </select>

            <button type="submit">Create User</button>
            <a href="delete_user.php" style="display: block; margin-top: 10px; text-decoration: none; color: #333;">Delete User</a>
            <a href="dashboard.php">Back to Dashboard</a>
        </form>

        <?php if (isset($create_message)) { ?>
            <div class="create-message"><?php echo $create_message; ?></div>
        <?php } ?>
    </div>
</body>
</html>
<?php
ob_end_flush(); // Flush the output buffer and turn off output buffering
?>