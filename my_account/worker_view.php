<?php
include("includes/db24.php");
?>
<html>
<head>
<title>Karavali Rubber and Enterprises</title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<style>
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

/* Content */
.left_content {
    margin-top:10px;
    float: left;
    width: 100%;
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


.footer {
    clear: both;
    background-color: #2c3e50;
    padding: 20px;
    text-align: center;
    color: #fff;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
}
.logout-btn {
    background-color: #e74c3c;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 4px;
    float: right;
    margin: 7px;
    margin-top:15px;
}

.logout-btn:hover {
    background-color: #c0392b;
}
</style>
</body>
<div class="header"><img src="images/logo.jpg" height="120" width="70">
    <h1>Karavali Rubber and Enterprises</h1></div>
    <a href="index.php" class="logout-btn">Logout</a>
<div class="left_content">
    <table>
        <tr>
            <th align="center" style="width:50px;">Sr No.</th>
            <th align="center" style="width:60px;">Clint Id</th>
            <th align="center" style="width:180px;">Name</th>
            <th align="center" style="width:140px;">Mobile No.</th>
            <th align="center" style="width:180px;">Address</th>
            <th align="center" style="width:140px;">Village</th>
            <th align="center" style="width:110px;">Amount</th>
            <th align="center" style="width:110px;">Status</th>
        </tr>
        <?php
        $i = 0;
        $get_costumers = "SELECT * FROM costumers ORDER BY 1 DESC;";
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
            </tr>
        <?php } ?>
    </table>
</div>

<div class="footer"><div align="center" class="footer_text">&copy; Karavali Rubber and Enterprises</div></div>
</body>
</html>