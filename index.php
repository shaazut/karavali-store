<?php
ob_start(); // Start output buffering
?>
<!DOCTYPE html>
<html>
<head>
    <title>Karavali Rubber and Enterprises Login</title>
    <style>
        /* Add your existing CSS styles here */
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
    </style>
</head>
<body>
    <div class="container">
        <img src="karavali-logo.jpg" alt="Karavali Rubber and Enterprises">
        <h1>Login</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            handleLogin();
        }

        function handleLogin() {
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Connect to the database
            $servername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "my_account";

            $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $storedPassword = $row["password"];

                if ($password === $storedPassword) {
                    $role = $row["role"];
                    $redirect = ($role === "owner") ? "dashboard.php" : "worker_view.php";
                    loginSuccess($role, $redirect);
                } else {
                    echo "Invalid username or password.";
                }
            } else {
                echo "Invalid username or password.";
            }

            $stmt->close();
            $conn->close();
        }

        function loginSuccess($role, $redirect) {
            ob_start(); // Start output buffering
            echo "Login successful for $role";

            // No output should be sent before the header() function call
            header("Location: $redirect");

            ob_end_flush(); // Flush the buffered output and turn off output buffering
            exit();
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div style="text-align: left; margin-top: 20px;">
                <p><strong>Username</strong></p>
            </div>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>

            <div style="text-align: left; margin-top: 20px;">
                <p><strong>Password</strong></p>
            </div>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>
            <a href="forget_password.php" style="display: block; margin-top: 10px; text-decoration: none; color: #333;">Forget Password?</a>
        </form>
        <br>
        <div class="footer"><div align="center" class="footer_text">&copy: Karavali Rubber and Enterprises</div>
    </div>
</body>
</html>
<?php
ob_end_flush(); // Flush the output buffer and turn off output buffering
?>