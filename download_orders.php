<?php
include 'connection.php';

// ===== GET VALUES =====
$user_id = $_GET['user_id'] ?? '';
$from    = $_GET['from'] ?? '';
$to      = $_GET['to'] ?? '';
$status  = $_GET['status'] ?? '';

// ===== DATE LIMITS =====
$today   = date("Y-m-d");
$minDate = date("Y-m-d", strtotime("-1 year"));


// ===== VALIDATION =====

// Future block
if(($from && $from > $today) || ($to && $to > $today)){
    die(" Future date allowed nahi hai");
}

// Last 1 year only
if(($from && $from < $minDate) || ($to && $to < $minDate)){
    die(" Sirf last 1 year ka data allowed hai");
}

// From > To block
if($from && $to && $from > $to){
    die(" From date bada nahi ho sakta To date se");
}

// ===== EXCEL HEADERS =====
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=order_report.xls");

// ===== WHERE CONDITION =====
$where = "WHERE 1";

// User security
if($user_id != ''){
    $where .= " AND user_id='$user_id'";
}

// Status filter
if($status != ''){
    $where .= " AND LOWER(payment_status)=LOWER('$status')";
}

// Date filter
$where = "WHERE 1";

if($user_id != ''){
    $where .= " AND user_id='$user_id'";
}

if($status != ''){
    $where .= " AND LOWER(payment_status)=LOWER('$status')";
}

if($from != ''){
    $where .= " AND STR_TO_DATE(placed_on,'%d-%b-%Y') >= '$from'";
}

if($to != ''){
    $where .= " AND STR_TO_DATE(placed_on,'%d-%b-%Y') <= '$to'";
}


// ===== QUERY =====
$query = mysqli_query($conn,
"SELECT * FROM `order` $where ORDER BY id DESC")
or die("Query Error: " . mysqli_error($conn));


// ===== EXCEL TABLE =====
echo "<table border='1'>
<tr>
<th>Order ID</th>
<th>User ID</th>
<th>Name</th>
<th>Number</th>
<th>Email</th>
<th>Address</th>
<th>Products</th>
<th>Total Price</th>
<th>Payment Method</th>
<th>Status</th>
<th>Date</th>
</tr>";

while($row = mysqli_fetch_assoc($query)){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['user_id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['number']}</td>
    <td>{$row['email']}</td>
    <td>{$row['address']}</td>
    <td>{$row['total_products']}</td>
    <td>{$row['total_price']}</td>
    <td>{$row['method']}</td>
    <td>{$row['payment_status']}</td>
    <td>{$row['placed_on']}</td>
    </tr>";
}

echo "</table>";
?>