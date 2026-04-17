<?php
    include 'connection.php';
    $order_id = $_GET['id'];
    // Order info
    $order = mysqli_fetch_assoc(
        mysqli_query($conn,
            "SELECT * FROM `order` WHERE id='$order_id'")
    );
    // Order items
    $items = mysqli_query($conn,
        "SELECT * FROM order_items WHERE order_id='$order_id'"
    );
    // Company info (edit as needed)
    $company_address = "Catalyst College, Patna, Bihar";
    $company_phone = "+91 99316 22827";
    $company_email = "support@jewelrystore.com";
    $invoice_no = "INV-" . $order['id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Invoice</title>
<style>
body{
    font-family:Arial;
    background:#f4f6f9;
    padding:30px;
}
.invoice{
    max-width:950px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 20px rgba(0,0,0,.1);
}
/* Header */
.header{
    display:flex;
    justify-content:space-between;
    border-bottom:2px solid #eee;
    padding-bottom:15px;
}
.logo{
    font-size:26px;
    font-weight:bold;
    color:#007bff;
}
.company{
    text-align:right;
    font-size:14px;
}
/* Info */
.info{
    margin-top:20px;
    display:flex;
    justify-content:space-between;
}
.box{
    width:48%;
    background:#fafafa;
    padding:12px;
    border-radius:6px;
}
/* Table */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:25px;
}
th{
    background:#007bff;
    color:white;
    padding:12px;
}
td{
    padding:12px;
    border-bottom:1px solid #eee;
    text-align:center;
}
.total{
    text-align:right;
    font-size:22px;
    font-weight:bold;
    margin-top:15px;
}
.footer{
    margin-top:25px;
    text-align:center;
    color:#777;
}
/* Button */
.print-btn{
    margin-top:20px;
    padding:14px;
    background:#28a745;
    color:white;
    border:none;
    width:100%;
    font-size:16px;
    border-radius:6px;
    cursor:pointer;
}
.home-btn{
    display:inline-block;
    margin-top:10px;
    padding:12px 22px;
    background:#007bff;
    color:white;
    text-decoration:none;
    border-radius:6px;
    font-weight:bold;
}
.home-btn:hover{
    background:#0056b3;
}
/* Print me hide */
@media print{
    .home-btn{display:none;}
}
@media print{
    .print-btn{display:none;}
    body{background:white;}
}
</style>
</head>
<body>
<div class="invoice">
<!-- Header -->
<div class="header">
    <div class="logo">
        <img src="img/logo.png" alt="Company Logo" style="height:60px;">
    </div>
    <div class="company">
        <?php echo $company_address; ?><br>
        Phone: <?php echo $company_phone; ?><br>
        Email: <?php echo $company_email; ?><br>
        <b>Invoice No:</b> <?php echo $invoice_no; ?><br>
        <b>Date:</b> <?php echo $order['placed_on']; ?>
    </div>
</div>

<!-- Billing / Shipping -->
<div class="info">

    <div class="box">
        <b>Billed To:</b><br>
        <?php echo $order['name']; ?><br>
        <?php echo $order['email']; ?><br>
        <?php echo $order['number']; ?><br>
        <?php echo $order['address']; ?>
    </div>
    <div class="box">
        <b>Payment Info:</b><br>
        Method: <?php echo $order['method']; ?><br>
        Order ID: #<?php echo $order['id']; ?>
    </div>
</div>

<!-- Product Table -->
<table>
<tr>
    <th>S.No</th>
    <th>Product Name</th>
    <th>Product ID</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Total</th>
</tr>
<?php
$grand_total = 0;
$serial = 1;
while($item = mysqli_fetch_assoc($items)){
    $total = $item['price'] * $item['quantity'];
    $grand_total += $total;
?>
<tr>
    <td><?php echo $serial++; ?></td>
    <td><?php echo $item['name']; ?></td>
    <td><?php echo $item['product_id']; ?></td>
    <td><?php echo $item['quantity']; ?></td>
    <td>₹<?php echo $item['price']; ?></td>
    <td>₹<?php echo $total; ?></td>
</tr>
<?php } ?>
</table>
<div class="total">
    Grand Total : ₹<?php echo $grand_total; ?>
</div>
<button class="print-btn" onclick="window.print()">
    Print / Save as PDF
</button>
<div class="footer">
Thank you for shopping with us ❤️
<div style="margin-top:20px;text-align:center;">
<a href="index.php" class="home-btn">
🏠 Click here to Home Page
</a>
</div>
</div>
</div>
</body>
</html>