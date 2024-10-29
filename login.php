<!DOCTYPE html>
<html>
<head>
    <title>Karavali Rubber and Enterprises Login</title>
    <style>
        /* CSS Reset */
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
            max-width: 200px;
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
            // Code to handle login logic here
            $username = $_POST["username"];
            $password = $_POST["password"];
            if ($username === "shaaz" && $password === "mash") {
                echo "Login successful for owner";
                header("Location: index.php");
                exit();
            } else if ($username === "mash" && $password === "shaaz") {
                echo "Login successful for worker";
                header("Location: worker_view.php");
                // Add any additional actions or redirection for this user.
                exit();
            } else {
                echo "Invalid username or password.";
            }
            
            // Perform database checks and authentication
            // ...

            // Redirect to the appropriate page upon successful login
            // ...
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div style="text-align: left; margin-top: 20px;">
                <p><strong>Username</strong></p>
            </div>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>

            <div style="text-align: left; margin-top: 20px;">
                <p><strong>password</strong></p>
            </div>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>
        </form>
        <div class="footer"><div align="center" class="footer_text">&copy: Karavali Rubber and Enterprises</div>
    </div>
</body>
</html>