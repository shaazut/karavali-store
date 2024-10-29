<?php
include("includes/db24.php");

if (isset($_GET['factory_id']) && isset($_GET['transaction_id'])) {
    $factory_id = $_GET['factory_id'];
    $transaction_id = $_GET['transaction_id'];

    // Fetch factory details
    $get_factory = "SELECT f.factory_name, f.factory_mobile, f.factory_address, f.factory_amount, f.payment_due
                    FROM factories f
                    WHERE f.factory_id = '$factory_id'";
    $run_factory = mysqli_query($con, $get_factory);
    $row_factory = mysqli_fetch_array($run_factory);

    $factory_name = $row_factory['factory_name'];
    $factory_mob = $row_factory['factory_mobile'];
    $factory_add = $row_factory['factory_address'];
    $factory_amount = $row_factory['factory_amount'];
    $payment_due = $row_factory['payment_due'];
    $u_status = ($payment_due == 1) ? "<img src='images/due.png' width='40' height='20'>" : "<img src='images/paid.png' width='40' height='20'>";

    // Fetch transaction details
    $get_transaction = "SELECT transaction_type, amount, transaction_date
                        FROM factory_transactions
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
    <title>Factory Transaction Bill</title>
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
        .bill {
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
            <img src="images/logo.jpg" alt="Company Logo" height="65" width="50">
            <h1>Karavali Rubber and Enterprises</h1>
        </div>
        <div class="bill">
            <p>MAIN ROAD KALLUGUNDI,SAMPAJE,SULLIA-574234</p>
            <h4>Contact: 9448930796 | GSTIN/UIN: 29AATPE6713H1ZE</h4>
        </div>
        <p>Factory Transaction Bill</p>
        <div class="bill-details">
            <p><strong>Transaction Date:</strong> <?php echo $transaction_date; ?></p>
            <p><strong>Factory Name:</strong> <?php echo $factory_name; ?></p>
            <p><strong>Mobile:</strong> <?php echo $factory_mob; ?></p>
            <p><strong>Address:</strong> <?php echo $factory_add; ?></p>
            <p><strong>Transaction Type:</strong> <?php echo ($transaction_type == 'add') ? 'Deposit' : 'Payout'; ?></p>
            <p><strong>Transaction Amount:</strong> <?php echo $transaction_amount; ?></p>
            <p><strong>Status:</strong> <?php echo $u_status; ?></p>
        </div>
        <div class="bill-footer">
            <p><strong>Total Amount:</strong> <?php echo $factory_amount; ?></p>
        </div>
    </div>
    <div class="buttons">
        <button onclick="window.print()">Print Bill</button>
        <button><a href="all_factories.php" style="text-decoration:none; color:white;">Cancel</a></button>
    </div>
</body>
</html>