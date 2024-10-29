<?php
include("includes/db24.php");

if (isset($_GET['cos_id'])) {
    $cos_id = $_GET['cos_id'];
    $get_costumers = "SELECT c.cos_name, c.mobile, c.cos_address, c.village, c.date, c.cos_amount, c.payment_due
                      FROM costumers c
                      WHERE c.cos_id = '$cos_id'";
    $run_costumers = mysqli_query($con, $get_costumers);
    $row_costumers = mysqli_fetch_array($run_costumers);

    $cos_name = $row_costumers['cos_name'];
    $cos_mob = $row_costumers['mobile'];
    $cos_add = $row_costumers['cos_address'];
    $cos_village = $row_costumers['village'];
    $date = $row_costumers['date'];
    $cos_amount = $row_costumers['cos_amount'];
    $payment_due = $row_costumers['payment_due'];
    $u_status = ($payment_due == 1) ? "<img src='images/due.png' width='40' height='20'>" : "<img src='images/paid.png' width='40' height='20'>";
}
?>
<!DOCTYPE html>
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
    margin-top:10px;
    padding-bottom:310px;
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
    <h1>Karavali Rubber and Enterprises</h1></div>
    <div class="left_content">
        <div align="center">
            <form method="post" action="" enctype="multipart/form-data">
                <div style="font-size:30px; font-style:bolder;padding-bottom:20px;padding-top:20px;">
                    Delete Supplier Carefully
                </div>
                <table align="center" width="400px" height="300px">
                    <tr>
                        <td><b>Supplier ID</b></td>
                        <td># <?php echo $cos_id; ?></td>
                    </tr>
                    <tr>
                        <td><b>Registration Date</b></td>
                        <td><?php echo $date; ?></td>
                    </tr>
                    <tr>
                        <td><b>Name</b></td>
                        <td><?php echo $cos_name; ?></td>
                    </tr>
                    <tr>
                        <td><b>Contact No.</b></td>
                        <td><?php echo $cos_mob; ?></td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td><?php echo $cos_add; ?></td>
                    </tr>
                    <tr>
                        <td><b>Village</b></td>
                        <td><?php echo $cos_village; ?></td>
                    </tr>
                    <tr>
                        <td><b>Original Amount</b></td>
                        <td><?php echo $cos_amount; ?></td>
                    </tr>
                    <tr>
                        <td><b>Status</b></td>
                        <td><?php echo $u_status; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="delete" value="Delete" style="background: linear-gradient(rgba(76,175,80,1), rgba(1,4,4)); border-radius:4px; border:none; color:#fff; font-size:15px; margin-top:10px;" />
                            <button><a href="all_costumer.php" style="text-decoration:none; color:white;">Cancel</a></button>
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
</html>

<?php
if (isset($_POST['delete'])) {
    $cos_id = $_GET['cos_id'];

    $delete_customer = "DELETE FROM costumers WHERE cos_id='$cos_id'";
    $run_delete_customer = mysqli_query($con, $delete_customer);

    if ($run_delete_customer) {
        $delete_entries = "DELETE FROM entery WHERE cos_id='$cos_id'";
        $run_delete_entries = mysqli_query($con, $delete_entries);

        if ($run_delete_customer) {
            echo "<script>alert('Customer and associated entries deleted successfully')</script>";
            echo "<script>window.open('all_costumer.php','_self')</script>";
        } else {
            echo "<script>alert('Failed to delete associated entries. Please try again later.')</script>";
        }
    } else {
        echo "<script>alert('Failed to delete customer. Please try again later.')</script>";
    }
}
?>