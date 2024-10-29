<?php
include("includes/db24.php");

// Get the factory_id from the URL parameter
$factory_id = $_GET['factory_id'];

// Fetch factory details
$get_factory = "SELECT * FROM factories WHERE factory_id = '$factory_id'";
$run_factory = mysqli_query($con, $get_factory);
$factory_data = mysqli_fetch_assoc($run_factory);

// Fetch regular factory transactions
$get_transactions = "SELECT
                        transaction_id,
                        CASE
                            WHEN transaction_type = 'add' THEN 'Deposit'
                            WHEN transaction_type = 'subtract' THEN 'Payout'
                        END AS transaction_type,
                        amount,
                        transaction_date
                    FROM factory_transactions
                    WHERE factory_id = '$factory_id'
                    ORDER BY transaction_date DESC";
$run_transactions = mysqli_query($con, $get_transactions);

// Fetch initial amount
$get_initial_amount = "SELECT
                        NULL AS transaction_id,
                        CASE
                            WHEN f.payment_due = 1 AND f.factory_amount > 0 THEN 'Deposit'
                            WHEN f.payment_due = 0 AND f.factory_amount < 0 THEN 'Deposit'
                            ELSE 'Payout'
                        END AS transaction_type,
                        ABS(f.initial_amt) AS amount,
                        f.date AS transaction_date
                    FROM factories f
                    WHERE f.factory_id = '$factory_id'";
$run_initial_amount = mysqli_query($con, $get_initial_amount);

$all_transactions = array_merge(
    mysqli_fetch_all($run_transactions, MYSQLI_ASSOC),
    mysqli_fetch_all($run_initial_amount, MYSQLI_ASSOC)

);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Factory Ledger</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        h1, h2 {
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #1abc9c;
            color: #fff;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Factory Ledger</h1>

        <h2>Factory Details</h2>
        <p><strong>Name:</strong> <?php echo $factory_data['factory_name']; ?></p>
        <p><strong>Mobile:</strong> <?php echo $factory_data['factory_mobile']; ?></p>
        <p><strong>Address:</strong> <?php echo $factory_data['factory_address']; ?></p>
        <p><strong>Amount:</strong> <?php echo $factory_data['factory_amount']; ?></p>

        <h2>Transaction History</h2>
        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Transaction Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_transactions as $row_transactions) { ?>
                    <tr>
                        <td><?php echo isset($row_transactions['transaction_id']) ? $row_transactions['transaction_id'] : 'Initial Amount'; ?></td>
                        <td><?php echo $row_transactions['transaction_type']; ?></td>
                        <td><?php echo $row_transactions['amount']; ?></td>
                        <td><?php echo $row_transactions['transaction_date']; ?></td>
                        <td>
                            <?php if (isset($row_transactions['transaction_id'])) { ?>
                                <a href="generate_bill_factory_transaction.php?factory_id=<?php echo $factory_id; ?>&transaction_id=<?php echo $row_transactions['transaction_id']; ?>"><img src="images/download.jpg" width="20" height="20"></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="buttons">
        <button><a href="all_factories.php" style="text-decoration:none; color:white;">Cancel</a></button>
    </div>
</body>
</html>