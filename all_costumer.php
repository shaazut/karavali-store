<?php
include("includes/db24.php");
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
            overflow: hidden;
        }

        .header img {
            height: 120px;
            width: 80px;
            margin-right: 10px;
            float: left;
        }

        .header h1 {
            display: inline-block;
            margin: 20px;
            font-size: 55px;
        }

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

        .search-container {
            position: sticky;
            top: 0;
            background-color: #f5f5f5;
            padding: 10px;
            box-sizing: border-box;
            z-index: 2;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-container form {
            display: flex;
            justify-content: center;
        }

        .search-container input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 300px;
        }

        .search-container input[type="submit"] {
            background-color: #1abc9c;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-container input[type="submit"]:hover {
            background-color: #16a085;
        }

        .table-header {
            position: sticky;
            top: 0;
            background-color: #1abc9c;
            color: #fff;
            z-index: 1;
        }

        .table-header th {
            padding: 12px;
            text-align: left;
            white-space: nowrap;
        }

        .left_content {
            margin-top: 10px;
            float: left;
            width: 75%;
            height: 500px; /* Set a fixed height for the left content */
            overflow-y: auto; /* Make the table content scrollable */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }

        

        .nav-buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .nav-buttons a {
            background-color: #1abc9c;
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            margin: 0 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .nav-buttons a:hover {
            background-color: #16a085;
        }

        .footer {
            clear: both;
            background-color: #2c3e50;
            padding: 20px;
            text-align: center;
            color: #fff;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        .right_content {
            float: right;
            width: 25%;
            background-color: #097969;
            margin-top: 10px;
            padding-bottom: 310px;
        }

        .right_content ul {
            list-style-type: none;
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
    </style>
</head>
<body>
    <div class="header">
        <img src="images/logo.jpg" height="120" width="70">
        <h1>Karavali Rubber and Enterprises</h1>
    </div>
    <div class="navbar">
        <!-- ... (existing navbar content) ... -->
    </div>
    <div class="search-container">
        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="search" placeholder="Search by name or mobile number">
            <input type="submit" value="Search">
        </form>
    </div>
    <div class="left_content">
        <table>
            <thead class="table-header">
                <tr>
                    <th align="center" style="width:50px;">Sr No.</th>
                    <th align="center" style="width:60px;">Client Id</th>
                    <th align="center" style="width:180px;">Name</th>
                    <th align="center" style="width:140px;">Mobile No.</th>
                    <th align="center" style="width:180px;">Address</th>
                    <th align="center" style="width:140px;">Village</th>
                    <th align="center" style="width:110px;">Amount</th>
                    <th align="center" style="width:110px;">Status</th>
                    <th align="center" style="width:110px;">Tools</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $search_query = isset($_GET['search']) ? $_GET['search'] : '';

                $get_costumers = "SELECT * FROM costumers WHERE cos_name LIKE '%$search_query%' OR mobile LIKE '%$search_query%' ORDER BY 1 DESC;";
                $run_costumers = mysqli_query($con, $get_costumers);

                while ($row_costumers = mysqli_fetch_array($run_costumers)) {
                    $cos_id = $row_costumers['cos_id'];
                    $cos_name = $row_costumers['cos_name'];
                    $cos_mob = $row_costumers['mobile'];
                    $cos_add = $row_costumers['cos_address'];
                    $cos_village = $row_costumers['village'];
                    $cos_amount = $row_costumers['cos_amount'];
                    $payment_due = $row_costumers['payment_due'];
                    $i++;

                    if ($cos_amount == 0) {
                        $u_status = "<img src='images/clear.jpg' width='40' height='20'>";
                    } elseif ($payment_due == 1) {
                        $u_status = "<img src='images/due.png' width='40' height='20'>";
                    } else {
                        $u_status = "<img src='images/paid.png' width='40' height='20'>";
                    }
                    ?>
                    <tr>
                        <td align="center"><?php echo $i; ?></td>
                        <td align="center"><?php echo $cos_id; ?></td>
                        <td align="center"><?php echo $cos_name; ?></td>
                        <td align="center"><?php echo $cos_mob; ?></td>
                        <td align="center"><?php echo $cos_add; ?></td>
                        <td align="center"><?php echo $cos_village; ?></td>
                        <td align="center"><?php echo $cos_amount; ?></td>
                        <td align="center"><?php echo $u_status; ?></td>
                        <td align="center" style="width:100px;">
                            <a href="generate_bill.php?cos_id=<?php echo $cos_id; ?>"><img src="images/download.jpg" width="20" height="20"></a>&nbsp;
                            <a href="view_costumer.php?cos_id=<?php echo $cos_id; ?>"><img src="images/view.png" width="20" height="20"></a>&nbsp;
                            <a href="edit.php?cos_id=<?php echo $cos_id; ?>"><img src="images/edit.png" width="20" height="20"></a>&nbsp;
                            <a href="delete.php?cos_id=<?php echo $cos_id; ?>"><img src="images/delete.png" width="20" height="20"></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="right_content">
        <!-- ... (existing sidebar content) ... -->
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="add_costumer.php">Add Supplier</a></li>
            <li><a href="all_costumer.php">All Suppliers</a></li>
            <li><a href="add_factory.php">Add Factory</a></li>
            <li><a href="all_factories.php">All Factories</a></li>
        </ul>
    </div>
    <div class="footer">
        <div align="center" class="footer_text">&copy; Karavali Rubber and Enterprises</div>
    </div>
</body>
</html>