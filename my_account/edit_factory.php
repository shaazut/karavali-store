<?php
include("includes/db24.php");

if (isset($_GET['factory_id'])) {
    $factory_id = $_GET['factory_id'];
    $get_factory = "SELECT * FROM factories WHERE factory_id='$factory_id'";
    $run_factory = mysqli_query($con, $get_factory);
    $row = mysqli_fetch_array($run_factory);

    $factory_name = $row['factory_name'];
    $factory_mobile = $row['factory_mobile'];
    $factory_address = $row['factory_address'];
    $factory_amount = $row['factory_amount'];
    $payment_due = $row['payment_due'];
}
?>

<html>
<head>
    <title>Karavali Rubber and Enterprises</title>
    <style>
        /* CSS styles... */
        /* General Styles */
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
    margin: 20px; /* Remove default margin for the heading */
    font-size: 55px; /* Increase the font size */
}

/* Navigation Bar */
.navbar {
    background-color: #1abc9c;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.navbar a {
    float: right;
    color: #fff;
    text-decoration: none;
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
    width: 70%;
    margin-bottom: -11px;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #1abc9c;
    color: #fff;
}

tr:hover {
    background-color: #f5f5f5;
}

.right_content {
    margin-top:10px;
    float: right;
    width: 30%; 
    background-color: #097969;
    padding-bottom:303px;
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

/* Footer */
.footer {
    clear: both;
    background-color: #2c3e50;
    padding: 20px;
    text-align: center;
    color: #fff;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
}

/* Buttons */
tr:last-child td {
    text-align: center;
}

tr:last-child td input[type="submit"],
tr:last-child td button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

tr:last-child td input[type="submit"] {
    background-color: #4CAF50; /* Green */
    color: white;
}

tr:last-child td input[type="submit"]:hover {
    background-color: #45a049;
}

tr:last-child td button {
    background-color: #f44336; /* Red */
    color: white;
}

tr:last-child td button a {
    color: white; /* Make the cancel link text white */
    text-decoration: none; /* Remove underline from the link */
}

tr:last-child td button:hover {
    background-color: #d32f2f;
}
    </style>
</head>
<body>
    <div class="header"><img src="images/logo.jpg" height="120" width="70">
        <h1>Karavali Rubber and Enterprises</h1>
    </div>
    <div class="left_content">
        <div align="center">
            <form method="post" action="" enctype="multipart/form-data">
                <div style="font-size:30px; font-style:bolder;padding-bottom:20px;padding-top:20px;">
                    Edit Factory Details
                </div>
                <table>
                    <tr>
                        <td><b>Factory ID</b></td>
                        <td># <?php echo $factory_id; ?></td>
                    </tr>
                    <tr>
                        <td><b>Name</b></td>
                        <td><input type="text" name="factory_name" value="<?php echo $factory_name; ?>" required /></td>
                    </tr>
                    <tr>
                        <td><b>Contact No.</b></td>
                        <td><input type="text" name="factory_mobile" value="<?php echo $factory_mobile; ?>" required /></td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td><input type="text" name="factory_address" value="<?php echo $factory_address; ?>" required /></td>
                    </tr>
                    <tr>
                        <td><b>Factory Amount</b></td>
                        <td><input type="text" name="factory_amount" value="<?php echo $factory_amount; ?>" required /></td>
                    </tr>
                    <tr>
                    <td><b>Deposit Amount</b></td>
                    <td><input type="text" name="add_amount" id="add_amount" placeholder="Enter amount to add" /></td>
                    </tr>
                    <tr>
                    <td><b>Payout Amount</b></td>
                    <td><input type="text" name="subtract_amount" id="subtract_amount" placeholder="Enter amount to subtract" /></td>
                    </tr>
                    <tr>
                        <td><b>Payment Due</b></td>
                        <td>
                            <input type="checkbox" name="payment_due" value="1" <?php echo ($payment_due == 1) ? 'checked' : ''; ?>>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="update" value="Save" style="background: linear-gradient(rgba(76,175,80,1), rgba(1,4,4)); border-radius:4px; border:none; color:#fff; font-size:15px;" />
                            <button><a href="all_factories.php" style="text-decoration:none; color:white;">Cancel</a></button>
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
    <div class="footer"><div align="center" class="footer_text">&copy; Karavali Rubber and Enterprises</div></div>
</body>
<?php
if (isset($_POST['update'])) {
    $factory_name = mysqli_real_escape_string($con, $_POST['factory_name']);
    $factory_mobile = mysqli_real_escape_string($con, $_POST['factory_mobile']);
    $factory_address = mysqli_real_escape_string($con, $_POST['factory_address']);
    $payment_due = isset($_POST['payment_due']) ? 1 : 0;

    $add_amount = isset($_POST['add_amount']) ? mysqli_real_escape_string($con, $_POST['add_amount']) : 0;
    $subtract_amount = isset($_POST['subtract_amount']) ? mysqli_real_escape_string($con, $_POST['subtract_amount']) : 0;

    $updated_amount = $factory_amount;

    // Start a transaction
    mysqli_autocommit($con, FALSE);

    // Update the factory details
    $update_factory = "UPDATE factories SET factory_name='$factory_name', factory_mobile='$factory_mobile', factory_address='$factory_address', payment_due='$payment_due' WHERE factory_id='$factory_id'";
    $run_update_factory = mysqli_query($con, $update_factory);

    if ($run_update_factory) {
        // Add deposit transaction
        if ($add_amount > 0) {
            $add_transaction = "INSERT INTO factory_transactions (factory_id, transaction_type, amount) VALUES ('$factory_id', 'add', '$add_amount')";
            $run_add_transaction = mysqli_query($con, $add_transaction);
            if ($run_add_transaction) {
                $updated_amount += $add_amount;
            } else {
                echo "Error: " . mysqli_error($con);
                mysqli_rollback($con);
                exit;
            }
        }

        // Add payout transaction
        if ($subtract_amount > 0) {
            $subtract_transaction = "INSERT INTO factory_transactions (factory_id, transaction_type, amount) VALUES ('$factory_id', 'subtract', '$subtract_amount')";
            $run_subtract_transaction = mysqli_query($con, $subtract_transaction);
            if ($run_subtract_transaction) {
                $updated_amount -= $subtract_amount;
            } else {
                echo "Error: " . mysqli_error($con);
                mysqli_rollback($con);
                exit;
            }
        }

        // Update the factory amount
        $update_amount = "UPDATE factories SET factory_amount='$updated_amount' WHERE factory_id='$factory_id'";
        $run_update_amount = mysqli_query($con, $update_amount);

        if ($run_update_amount) {
            mysqli_commit($con);
            echo "<script>alert('Factory details updated successfully')</script>";
            echo "<script>window.open('all_factories.php','_self')</script>";
        } else {
            mysqli_rollback($con);
            echo "<script>alert('Something went wrong. Please try again later.')</script>";
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
</body>
</html>