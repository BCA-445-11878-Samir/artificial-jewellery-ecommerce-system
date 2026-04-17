<?php
include 'connection.php';

// Pending Amount
$r = mysqli_query($conn,
    "SELECT SUM(total_price) AS total
     FROM `order` WHERE payment_status='pending'");
$total_pendings = mysqli_fetch_assoc($r)['total'] ?? 0;

// Complete Amount
$r = mysqli_query($conn,
    "SELECT SUM(total_price) AS total
     FROM `order` WHERE payment_status='complete'");
$total_completes = mysqli_fetch_assoc($r)['total'] ?? 0;

// Orders
$r = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `order`");
$num_of_order = mysqli_fetch_assoc($r)['total'];

// Users
$r = mysqli_query($conn,
    "SELECT COUNT(*) AS total FROM users WHERE user_type='user'");
$num_of_users = mysqli_fetch_assoc($r)['total'];

// Admin
$r = mysqli_query($conn,
    "SELECT COUNT(*) AS total FROM users WHERE user_type='admin'");
$num_of_admin = mysqli_fetch_assoc($r)['total'];

// Messages
$r = mysqli_query($conn,
    "SELECT COUNT(*) AS total FROM message");
$num_of_message = mysqli_fetch_assoc($r)['total'];

// Products
$r = mysqli_query($conn,
    "SELECT COUNT(*) AS total FROM products");
$num_of_products = mysqli_fetch_assoc($r)['total'];

// Total Registered Users
$r = mysqli_query($conn,
    "SELECT COUNT(*) AS total FROM users");
$num_of_total_users = mysqli_fetch_assoc($r)['total'];
?>

<div class="box-container">

    <div class="box">
        <h3>$ <?php echo $total_pendings; ?>/-</h3>
        <p>total pendings</p>
    </div>

    <div class="box">
        <h3>$ <?php echo $total_completes; ?>/-</h3>
        <p>total completes</p>
    </div>

    <div class="box">
        <h3><?php echo $num_of_order; ?></h3>
        <p>order placed</p>
    </div>

    <div class="box">
        <h3><?php echo $num_of_users; ?></h3>
        <p>total normal users</p>
    </div>

    <div class="box">
        <h3><?php echo $num_of_admin; ?></h3>
        <p>total admin</p>
    </div>

    <div class="box">
        <h3><?php echo $num_of_message; ?></h3>
        <p>new messages</p>
    </div>
    <div class="box">
        <h3><?php echo $num_of_products; ?></h3>
        <p>products added</p>
    </div>
    <div class="box">
    <h3><?php echo $num_of_total_users; ?></h3>
    <p>total registered users</p>
</div>
</div>