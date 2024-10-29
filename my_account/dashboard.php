<?php
include("includes/db24.php");
?>
<html>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #2c3e50;
    color: #fff;
}
.header {
    background-color: #1abc9c;
    padding: 20px;
    text-align: center;
    overflow: hidden; /* Add this line to clear the float */
}
.header h1 {
            display: inline-block; /* Add this line to make the heading inline */
            margin: 20px; /* Remove default margin for the heading */
            font-size: 55px; /* Increase the font size */
        }
.header img {
    height: 120px; /* Adjusted height */
    width: 80px;
    margin-right: 10px; /* Add margin for spacing between logo and heading */
    float: left; /* Float the image to the left */
}

.header h1 {
    display: inline-block; /* Add this line to make the heading inline */
    margin: 0; /* Remove default margin for the heading */
}

/* Navigation Bar */
.navbar {
    background-color: #16a085;
    overflow: hidden;
    padding: 10px;
    display: flex; /* Use flexbox for aligning items */
    justify-content: space-between; /* Align items to the left and right */
    align-items: center; /* Vertically center the items */
}

.navbar h1 {
    margin: 0; /* Remove default margin for the heading */
}

.navbar a {
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
}

.navbar a:hover {
    background-color: #1abc9c;
}

/* Content */
.left_content {
    float: left;
    width: 70%;
    
}

.right_content {
    float: right;
    width: 30%; 
    background-color: #097969;
    padding-bottom:200px;
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

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #1abc9c;
}

/* Footer */
.footer {
    clear: both;
    background-color: #16a085;
    padding: 20px;
    text-align: center;
}

/* Logout Button */
.logout-btn {
    background-color: #e74c3c;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 4px;
}

.logout-btn:hover {
    background-color: #c0392b;
}
</style>
<body>
    <div class="header"><img src="images/logo.jpg" height="120" width="70">
    <br>
    <h1>Karavali Rubber and Enterprises</h1></div>
    <div class="navbar">
        <h1>Dashboard</h1>
        <a href="index.php" class="logout-btn">Logout</a>
    </div>
    <div class="left_content">
        <?php
        // Get data for customers
        $get_customers = "SELECT * FROM costumers";
        $run_customers = mysqli_query($con, $get_customers);
        $num_customers = mysqli_num_rows($run_customers);

        $total_due_customers = 0;
        $get_due_customers = "SELECT SUM(cos_amount) AS total_due FROM costumers WHERE payment_due = 1";
        $run_due_customers = mysqli_query($con, $get_due_customers);
        $due_row_customers = mysqli_fetch_array($run_due_customers);
        $total_due_customers = $due_row_customers['total_due'];

        $total_payout_customers = 0;
        $get_payout_customers = "SELECT SUM(amount) AS total_payout 
                                FROM customer_transactions 
                                WHERE transaction_type = 'subtract'";
        $run_payout_customers = mysqli_query($con, $get_payout_customers);
        $payout_row_customers = mysqli_fetch_array($run_payout_customers);
        $total_payout_customers = $payout_row_customers['total_payout'];

        $total_paid_customers = 0;
        $get_paid_customers = "SELECT SUM(cos_amount) AS total_paid FROM costumers WHERE payment_due = 0";
        $run_paid_customers = mysqli_query($con, $get_paid_customers);
        $paid_row_customers = mysqli_fetch_array($run_paid_customers);
        $total_paid_customers = $paid_row_customers['total_paid'];

        $total_paid_and_payout_customers = $total_paid_customers + $total_payout_customers;

        // Get data for factories
        $get_factories = "SELECT * FROM factories";
        $run_factories = mysqli_query($con, $get_factories);
        $num_factories = mysqli_num_rows($run_factories);

        $total_due_factories = 0;
        $get_due_factories = "SELECT SUM(factory_amount) AS total_due FROM factories WHERE payment_due = 1";
        $run_due_factories = mysqli_query($con, $get_due_factories);
        $due_row_factories = mysqli_fetch_array($run_due_factories);
        $total_due_factories = $due_row_factories['total_due'];

        $total_payout_factories = 0;
        $get_payout_factories = "SELECT SUM(amount) AS total_payout 
                                FROM factory_transactions 
                                WHERE transaction_type = 'subtract'";
        $run_payout_factories = mysqli_query($con, $get_payout_factories);
        $payout_row_factories = mysqli_fetch_array($run_payout_factories);
        $total_payout_factories = $payout_row_factories['total_payout'];
        
        $total_paid_factories = 0;
        $get_paid_factories = "SELECT SUM(factory_amount) AS total_paid FROM factories WHERE payment_due = 0";
        $run_paid_factories = mysqli_query($con, $get_paid_factories);
        $paid_row_factories = mysqli_fetch_array($run_paid_factories);
        $total_paid_factories = $paid_row_factories['total_paid'];

        $total_paid_and_payout_factories = $total_payout_factories + $total_paid_factories;

        ?>
        <h2>Suppliers</h2>
        <table>
            <tr>
                <th><h3>Total Due Amount</h3></th>
                <th><h3>Total Suppliers</h3></th>
                <th><h3>Total Paid</h3></th>
            </tr>
            <tr>
                <td align="center" style="color:white;"><h3><?php echo $total_due_customers; ?></h3></td>
                <td align="center" style="color:white;"><h3><?php echo $num_customers; ?></h3></td>
                <td align="center" style="color:white;"><h3><?php echo $total_paid_and_payout_customers; ?></h3></td>
        </table>
        <h2>Factories</h2>
        <table>
            <tr>
                <th><h3>Total Due Amount</h3></th>
                <th><h3>Total Factoriess</h3></th>
                <th><h3>Total Paid</h3></th>
            </tr>
            <tr>
                <td align="center" style="color:white;"><h3><?php echo $total_due_factories; ?></h3></td>
                <td align="center" style="color:white;"><h3><?php echo $num_factories; ?></h3></td>
                <td align="center" style="color:white;"><h3><?php echo $total_paid_and_payout_factories; ?></h3></td>
            </tr>
        </table>
    </div>
    <div class="right_content">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="add_costumer.php">Add Supplier</a></li>
            <li><a href="all_costumer.php">All Suppliers</a></li>
            <li><a href="add_factory.php">Add Factory</a></li>
            <li><a href="all_factories.php">All Factories</a></li>
            <li><a href="create_user.php">Manage User</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </div>
    <div class="footer"><div align="center" class="footer_text">&copy; Karavali Rubber and Enterprises</div></div>
</body>
</html>