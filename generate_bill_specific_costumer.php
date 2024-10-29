<?php
include("includes/db24.php");

if (isset($_GET['cos_id']) && isset($_GET['transaction_id'])) {
    $cos_id = $_GET['cos_id'];
    $transaction_id = $_GET['transaction_id'];

    // Fetch customer details
    $get_costumer = "SELECT c.cos_name, c.mobile, c.cos_address, c.village, c.cos_amount, c.payment_due
                     FROM costumers c
                     WHERE c.cos_id = '$cos_id'";
    $run_costumer = mysqli_query($con, $get_costumer);
    $row_costumer = mysqli_fetch_array($run_costumer);

    $cos_name = $row_costumer['cos_name'];
    $cos_mob = $row_costumer['mobile'];
    $cos_add = $row_costumer['cos_address'];
    $cos_village = $row_costumer['village'];
    $cos_amount = $row_costumer['cos_amount'];
    $payment_due = $row_costumer['payment_due'];
    $u_status = ($payment_due == 1) ? "<img src='images/due.png' width='40' height='20'>" : "<img src='images/paid.png' width='40' height='20'>";

    // Fetch transaction details
    $get_transaction = "SELECT transaction_type, amount, transaction_date
                        FROM customer_transactions
                        WHERE transaction_id = '$transaction_id'";
    $run_transaction = mysqli_query($con, $get_transaction);
    $row_transaction = mysqli_fetch_array($run_transaction);

    $transaction_type = $row_transaction['transaction_type'];
    $transaction_amount = $row_transaction['amount'];
    $transaction_date = $row_transaction['transaction_date'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .bill-container {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .bill-header {
            display: flex;
            align-items: center; /* Center vertically */
            margin-bottom: -5px;
        }
        .bill-header img {
            max-width: 150px;
            height: auto;
            margin-right: 10px; /* Add margin for spacing */
        }
        .bill-header h1 {
            margin: 0; /* Remove default margin */
        }
        .bill-details {
            margin-bottom: 20px;
        }
        .bill-details p {
            margin: 5px 0;
        }
        .bill-footer {
            text-align: right;
            font-weight: bold;
        }
        .bill{
            text-align: center;
        }
        
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 5px;
            margin-right: 10px;
        }
        .buttons button:last-child {
            background-color: #f44336;
        }
        @media print {
            .buttons {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="bill-container">
        <div class="bill-header">
            <img src="images/logo.jpg" alt="Company Logo" height="65" width="50" >
            <h1>Karavali Rubber and Enterprises</h1>
        </div >
        <div class=bill>
            <p>MAIN ROAD KALLUGUNDI,SAMPAJE,SULLIA-574234</p>
            <h4>Contact: 9448930796 | GSTIN/UIN: 29AATPE6713H1ZE</h4>
        </div>
        <p>Supplier Bill</p>
        <div class="bill-details">
            <p><strong>Transaction Date:</strong> <?php echo $transaction_date; ?></p>
            <p><strong>Supplier Name:</strong> <?php echo $cos_name; ?></p>
            <p><strong>Mobile:</strong> <?php echo $cos_mob; ?></p>
            <p><strong>Address:</strong> <?php echo $cos_add; ?>, <?php echo $cos_village; ?></p>
            <p><strong>Transaction Type:</strong> <?php echo ($transaction_type == 'add') ? 'Deposit' :'Payout'; ?></p>
            <p><strong>Transaction Amount:</strong> <?php echo $transaction_amount; ?></p>
            <p><strong>Status:</strong> <?php echo $u_status; ?></p>
        </div>
        <div class="bill-footer">
            <p><strong>Total Amount:</strong> <?php echo $cos_amount; ?></p>
        </div>
        </div>
        <div class="buttons">
            <button onclick="window.print()">Print Bill</button>
            <button><a href="all_costumer.php" style="text-decoration:none; color:white;">Cancel</a></button>
        </div>
</body>
</html>
