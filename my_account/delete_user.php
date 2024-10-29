<?php
ob_start(); // Start output buffering

// Connect to the database
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "my_account";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];

    // Check if the user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if ($result->num_rows === 0) {
        $delete_message = "User does not exist.";
    } elseif ($user['role'] == 'owner') {
        // Check if there is more than one owner
        $stmt = $conn->prepare("SELECT COUNT(*) AS owner_count FROM users WHERE role = 'owner'");
        $stmt->execute();
        $owner_count = $stmt->get_result()->fetch_assoc()['owner_count'];

        if ($owner_count <= 1) {
            $delete_message = "You cannot delete the last owner.";
        } else {
            // Prepare and execute the SQL statement to delete the user
            $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);

            if ($stmt->execute()) {
                $delete_message = "User deleted successfully!";
            } else {
                $delete_message = "Error: " . $stmt->error;
            }
        }
    } else {
        // Prepare and execute the SQL statement to delete the user
        $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            $delete_message = "User deleted successfully!";
        } else {
            $delete_message = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <style>
       * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 80%;
            max-width: 600px; /* Added max-width to prevent container from becoming too wide */
            text-align: center;
        }

        .container h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .container th, .container td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .container th {
            background-color: #f2f2f2;
        }

        .container button {
            background-color: #e53935;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .container button:hover {
            background-color: #c62828;
        }

        .container a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #4CAF50;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .container a:hover {
            color: #45a049;
        }

        .create-message {
            margin-top: 20px;
            color: #4CAF50;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete User</h1>

        <h2>All Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>";
                        if ($row["role"] == 'owner') {
                            echo "Admin";
                        } else {
                            echo "Employee";
                        }
                        echo "</td>";
                        echo "<td>";
                        if ($row["role"] == 'owner') {
                            // Check if there is more than one owner
                            $stmt = $conn->prepare("SELECT COUNT(*) AS owner_count FROM users WHERE role = 'owner'");
                            $stmt->execute();
                            $owner_count = $stmt->get_result()->fetch_assoc()['owner_count'];

                            if ($owner_count > 1) {
                                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                                echo "<input type='hidden' name='username' value='" . $row["username"] . "'>";
                                echo "<button type='submit' class='delete-button'>Delete</button>";
                                echo "</form>";
                            } else {
                                echo "Cannot delete last owner";
                            }
                        } else {
                            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                            echo "<input type='hidden' name='username' value='" . $row["username"] . "'>";
                            echo "<button type='submit' class='delete-button'>Delete</button>";
                            echo "</form>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found.</td></tr>";
                }
                ?>
            </tbody>

        </table>

            <a href="create_user.php" style="display: block; margin-top: 10px; text-decoration: none; color: #333;">Create User</a>
            <a href="dashboard.php" style="display: block; margin-top: 10px; text-decoration: none; color: #333;">Back to Dashboard</a>

        <?php if (isset($delete_message)) { ?>
            <div class="create-message" style="margin-top: 20px;"><?php echo $delete_message; ?></div>
        <?php } ?>
    </div>
</body>
</html>
<?php
$conn->close();
ob_end_flush(); // Flush the output buffer and turn off output buffering
?>