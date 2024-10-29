<?php
ob_start(); // Start output buffering
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>
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
        <h1>Forget Password</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            handleForgetPassword();
        }
        function handleForgetPassword() {
            $username = $_POST["username"];
        
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
                $password = $row['password'];
        
                // Send password reset email
                require 'phpmailer/Exception.php';
                require 'phpmailer/PHPMailer.php';
                require 'phpmailer/SMTP.php';
        
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = 'utshaaz2@gmail.com';
                $mail->Password = 'lkzxgjhgrytpnbuv';
                $mail->setFrom('utshaaz2@gmail.com', 'Karavali Rubber and Enterprises');
                $mail->addAddress('utshaaz2@gmail.com');
                $mail->Subject = 'Password Reset';
                $mail->Body = "Username: $username\nPassword: $password";
        
                if ($mail->send()) {
                    echo "A password has been sent to owner";
                } else {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                }
            } else {
                echo "Invalid username.";
            }
        
            $stmt->close();
            $conn->close();
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div style="text-align: left; margin-top: 20px;">
                <p><strong>Username</strong></p>
            </div>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>

            <button type="submit">Send Password</button>
        </form>
        <a href="index.php" style="display: block; margin-top: 10px; text-decoration: none; color: #333;">Back to login page</a>
    </div>
</body>
</html>
<?php
ob_end_flush(); // Flush the output buffer and turn off output buffering
?>