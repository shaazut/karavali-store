<?php
include("includes/db24.php");

// Get the cos_id from the URL parameter
$cos_id = $_GET['cos_id'];

// Fetch customer details
$get_customer = "SELECT * FROM costumers WHERE cos_id = '$cos_id'";
$run_customer = mysqli_query($con, $get_customer);
$customer_data = mysqli_fetch_assoc($run_customer);

// Fetch regular customer transactions
$get_transactions = "SELECT
                        transaction_id,
                        CASE
                            WHEN transaction_type = 'add' THEN 'Deposit'
                            WHEN transaction_type = 'subtract' THEN 'Payout'
                        END AS transaction_type,
                        amount,
                        transaction_date
                    FROM customer_transactions
                    WHERE cos_id = '$cos_id'
                    ORDER BY transaction_date DESC";
$run_transactions = mysqli_query($con, $get_transactions);

// Fetch initial amount
$get_initial_amount = "SELECT
                        NULL AS transaction_id,
                        CASE
                            WHEN c.cos_amount > (SELECT SUM(amount) FROM customer_transactions WHERE cos_id = c.cos_id AND transaction_type = 'add') - (SELECT SUM(amount) FROM customer_transactions WHERE cos_id = c.cos_id AND transaction_type = 'subtract') THEN 'Deposit'
                            ELSE 'Payout'
                        END AS transaction_type,
                        ABS(c.cos_amount - ((SELECT SUM(amount) FROM customer_transactions WHERE cos_id = c.cos_id AND transaction_type = 'add') - (SELECT SUM(amount) FROM customer_transactions WHERE cos_id = c.cos_id AND transaction_type = 'subtract'))) AS amount,
                        c.date AS transaction_date,
                        'Initial Amount' AS transaction_id_text
                    FROM costumers c
                    WHERE c.cos_id = '$cos_id'";
$run_initial_amount = mysqli_query($con, $get_initial_amount);

$all_transactions = array_merge(
    mysqli_fetch_all($run_transactions, MYSQLI_ASSOC),
    mysqli_fetch_all($run_initial_amount, MYSQLI_ASSOC)
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Ledger</title>
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
        <h1>Customer Ledger</h1>

        <h2>Customer Details</h2>
        <p><strong>Name:</strong> <?php echo $customer_data['cos_name']; ?></p>
        <p><strong>Mobile:</strong> <?php echo $customer_data['mobile']; ?></p>
        <p><strong>Address:</strong> <?php echo $customer_data['cos_address']; ?></p>
        <p><strong>Village:</strong> <?php echo $customer_data['village']; ?></p>
        <p><strong>Amount Due:</strong> <?php echo $customer_data['cos_amount']; ?></p>

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
                        <td><?php echo isset($row_transactions['transaction_id']) ? $row_transactions['transaction_id'] : $row_transactions['transaction_id_text']; ?></td>
                        <td><?php echo $row_transactions['transaction_type']; ?></td>
                        <td><?php echo $row_transactions['amount']; ?></td>
                        <td><?php echo $row_transactions['transaction_date']; ?></td>
                        <td>
                            <?php if (isset($row_transactions['transaction_id'])) { ?>
                                <a href="generate_bill_specific_costumer.php?cos_id=<?php echo $cos_id; ?>&transaction_id=<?php echo $row_transactions['transaction_id']; ?>">Generate Bill</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="buttons">
        <button><a href="all_costumer.php" style="text-decoration:none; color:white;">Cancel</a></button>
    </div>
</body>
</html>