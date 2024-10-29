<?php
include("includes/db24.php");

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $factory_name = sanitizeInput($_POST['factory_name']);
    $factory_mobile = sanitizeInput($_POST['factory_mobile']);
    $factory_address = sanitizeInput($_POST['factory_address']);
    $factory_amount = sanitizeInput($_POST['factory_amount']);
    $payment_due = isset($_POST['payment_due']) ? 1 : 0;

    // Validate input data
    if (empty($factory_name) || empty($factory_mobile) || empty($factory_address) || empty($factory_amount)) {
        $error_message = "Please fill all the required fields!";
    } elseif (!preg_match('/^\d{10}$/', $factory_mobile)) {
        $error_message = "Invalid mobile number format!";
    } elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $factory_amount)) {
        $error_message = "Invalid amount format!";
    } else {
        // Prepare the SQL statement
        $stmt = $con->prepare("INSERT INTO factories (factory_name, factory_mobile, factory_address, factory_amount, payment_due) VALUES (?, ?, ?, ?, ?)");

        // Bind the parameters
        $stmt->bind_param("ssisi", $factory_name, $factory_mobile, $factory_address, $factory_amount, $payment_due);

        // Execute the statement
        if ($stmt->execute()) {
            $success_message = "Factory inserted successfully";
        } else {
            $error_message = "Error inserting factory: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Karavali Rubber and Enterprises</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
        /* Existing CSS styles */

        .error-message {
            color: #ff0000;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .success-message {
            color: #00ff00;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="images/logo.jpg" height="120" width="70">
        <h1>Karavali Rubber and Enterprises</h1>
    </div>
    <div class="left_content">
        <div align="center" style="margin-top:0px;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateForm()">
                <div style="font-size:30px; font-style:bolder;padding-bottom:20px;padding-top:20px;">
                    Register Factory
                </div>
                <table>
                    <tr>
                        <td><b>Factory Name</b></td>
                        <td>
                            <input type="text" name="factory_name" required />
                        </td>
                    </tr>
                    <tr>
                        <td><b>Contact No.</b></td>
                        <td>
                            <input type="text" name="factory_mobile" pattern="^\d{10}$" required />
                        </td>
                    </tr>
                    <tr>
                        <td><b>Factory Address</b></td>
                        <td>
                            <input type="text" name="factory_address" required />
                        </td>
                    </tr>
                    <tr>
                        <td><b>Factory Amount</b></td>
                        <td>
                            <input type="text" name="factory_amount" pattern="^\d+(\.\d{1,2})?$" required />
                        </td>
                    </tr>
                    <tr>
                        <td><b>Payment Due</b></td>
                        <td>
                            <input type="checkbox" name="payment_due" value="1" checked>
                            <label for="payment_due">Yes</label>
                        </td>
                    </tr>
                </table>

                <?php if (isset($error_message)) { ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php } ?>

                <?php if (isset($success_message)) { ?>
                    <div class="success-message"><?php echo $success_message; ?></div>
                <?php } ?>

                <div class="submit-button">
                    <input type="submit" name="insert_factory" value="Submit" />
                </div>
            </form>
        </div>
    </div>
    <div class="right_content">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="add_costumer.php">Add Supplier</a></li>
            <li><a href="all_costumer.php">All Suppliers</a></li>
            <li><a href="add_factory.php">Add Factory</a></li>
            <li><a href="all_factories.php">All Factories</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </div>
    <div class="footer">
        <div align="center" class="footer_text">&copy: Karavali Rubber and Enterprises</div>
    </div>

    <script>
        function validateForm() {
            return true;
        }
    </script>
</body>
</html>