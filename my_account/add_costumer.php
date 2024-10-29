<?php
include("includes/db24.php");

// Function to validate input fields
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<html>
<head>
<title>Karavali Rubber and Enterprises</title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<style>
    body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    color: #333;
}
.header {
    background-color: #1abc9c;
    padding: 20px;
    text-align: center;
    overflow: hidden; /* Add this line to clear the float */
}
.header img {
    height: 120px; /* Adjusted height */
    width: 80px;
    margin-right: 10px; /* Add margin for spacing between logo and heading */
    float: left; /* Float the image to the left */
}
.header h1 {
            display: inline-block; /* Add this line to make the heading inline */
            margin-top: 100px; /* Remove default margin for the heading */
            font-size: 55px; /* Increase the font size */
        }
.header h1 {
    display: inline-block; /* Add this line to make the heading inline */
    margin: 0; /* Remove default margin for the heading */
}

/* Navigation Bar */
.navbar {
    background-color: #1abc9c;
    overflow: hidden;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.navbar a {
    float: right;
    color: #fff;
    text-decoration: none;
    padding: 10px 16px;
    margin-right: 10px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.navbar a:hover {
    background-color: #16a085;
}

/* Content */
.left_content {
    margin-top:10px;
    float: left;
    width: 73%;
}


/* Form */
form {
    background-color: #fff;
    color: #333;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

form div {
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
    font-size: 24px;
    color: #1abc9c;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table td {
    padding: 12px;
}

input[type="text"], select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #1abc9c;
    color: #fff;
    border: none;
    padding: 14px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #16a085;
}
.right_content {
    float: right;
    width: 27%;
    margin-top:10px;
    padding-bottom:426px;
    background-color: #097969;
    margin-bottom: -10px;
    

}
.right_content ul {
    list-style-type: none;16a085
    padding: 0;
}

.right_content li a {
    display: block;
    color: #fff;
    padding: 8px 16px;
    text-decoration: none;
}

.right_content li a:hover {
    background-color: #16a085;
}
input[type="checkbox"] {
    transform: scale(1.5); /* Increase the size of the checkbox */
    margin-right: 10px; /* Add some spacing between the checkbox and the label */
    vertical-align: middle; /* Align the checkbox vertically with the label */
}

label {
    font-size: 16px; /* Adjust the label font size as needed */
    vertical-align: middle; /* Align the label vertically with the checkbox */
}
/* Footer */
.footer {
    clear: both;
    background-color: #2c3e50;
    padding: 20px;
    text-align: center;
    color: #fff;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
}
</style>
</head>
<body>
<div class="header">
    <img src="images/logo.jpg" height="120" width="70">
    <br>
    <h1>Karavali Rubber and Enterprises</h1>
</div>
<div class="left_content">
    <div align="center" style="margin-top:0px;">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateForm()">
            <div style="font-size:30px; font-style:bolder;padding-bottom:20px;padding-top:20px;">
                Register Supplier
            </div>
            <table>
                <tr>
                    <td><b>Name</b></td>
                    <td>
                        <input type="text" name="costumer_name" required pattern="[a-zA-Z\s]+" title="Please enter a valid name (alphabets and spaces only)">
                    </td>
                </tr>
                <tr>
                    <td><b>Contact No.</b></td>
                    <td>
                        <input type="text" name="mob" required pattern="^\d{10}$" title="Please enter a valid 10-digit mobile number">
                    </td>
                </tr>
                <tr>
                    <td><b>Supplier Address</b></td>
                    <td>
                        <input type="text" name="cos_add" required>
                    </td>
                </tr>
                <tr>
                    <td><b>Supplier Amount</b></td>
                    <td>
                        <input type="text" name="cos_amount" required pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid amount (e.g., 100 or 100.50)">
                    </td>
                </tr>
                <tr>
                    <td><b>Payment Due</b></td>
                    <td>
                        <input type="checkbox" name="payment_due" value="1" checked>
                        <label for="payment_due">Yes</label>
                    </td>
                </tr>
                <tr>
                    <td><b>Select Village</b></td>
                    <td>
                        <select name="village" required>
                            <option value="">Select village</option>
                            <option>Sulia</option>
                            <option>Kalugundi</option>
                            <option>gonadka</option>
                            <option>madikeri</option>
                            <option>kadaba</option>
                            <option>puttur</option>
                            <option>others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="insert_costumer" value="Submit" style="background:#1abc9c; border:none;color:#fff;font-size:20px;border-radius:4px;"/>
                    </td>
                </tr>
            </table>
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
    </ul>
</div>
<div class="footer">
    <div align="center" class="footer_text">&copy: Karavali Rubber and Enterprises</div>
</div>

<?php
if(isset($_POST['insert_costumer'])) {
    $costumer_name = validateInput($_POST['costumer_name']);
    $mob = validateInput($_POST['mob']);
    $cos_add = validateInput($_POST['cos_add']);
    $village = validateInput($_POST['village']);
    $status = 'due';
    $cos_amount = validateInput($_POST['cos_amount']);
    $payment_due = isset($_POST['payment_due']) ? 1 : 0;

    // Check if the customer name already exists
    $check_query = "SELECT * FROM costumers WHERE cos_name = '$costumer_name'";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Customer name already exists. Please use a different name.');</script>";
    } else {
        // Server-side validation
        $errors = array();
        if (empty($costumer_name)) {
            $errors[] = "Please enter a name.";
        }
        if (empty($mob) || !preg_match('/^\d{10}$/', $mob)) {
            $errors[] = "Please enter a valid 10-digit mobile number.";
        }
        if (empty($cos_add)) {
            $errors[] = "Please enter a customer address.";
        }
        if (empty($cos_amount) || !preg_match('/^\d+(\.\d{1,2})?$/', $cos_amount)) {
            $errors[] = "Please enter a valid amount.";
        }
        if (empty($village)) {
            $errors[] = "Please select a village.";
        }

        if (empty($errors)) {
            $insert_cos = "INSERT INTO costumers (cos_name, mobile, village, p_status, cos_address, cos_amount, payment_due) VALUES ('$costumer_name', '$mob', '$village', '$status', '$cos_add', '$cos_amount', '$payment_due')";
            $run_cos = mysqli_query($con, $insert_cos);
            if($run_cos){
                echo "<script>alert('Customer inserted successfully')</script>";
            } else {
                echo "<script>alert('Error inserting customer')</script>";
            }
        } else {
            foreach ($errors as $error) {
                echo "<script>alert('$error')</script>";
            }
        }
    }
}
?>

<script>
function validateForm() {
    // Client-side validation (JavaScript)
    // You can add additional validation rules here if needed
    return true;
}
</script>
</body>
</html>