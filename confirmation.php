<?php
    include 'connection.php';
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }
    $user_id = $_SESSION['user_id'];
    
    if(!isset($_GET['id'])){
        header("Location: index.php");
        exit();
    }
    $order_id = $_GET['id'];
    
    $query = mysqli_query($conn,
        "SELECT * FROM `order`
        WHERE id='$order_id'
        AND user_id='$user_id'"
    );
    if(mysqli_num_rows($query) > 0){
        $order = mysqli_fetch_assoc($query);
    }else{
        echo "Order not found!";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Confirmation</title>
<style>
body{
    font-family: Arial;
    background:#f4f6f9;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.box{
    background:white;
    padding:40px;
    border-radius:12px;
    text-align:center;
    box-shadow:0 0 20px rgba(0,0,0,0.1);
    width:450px;
}
.check{ font-size:70px; color:#28a745; }
.btn{
    display:block;
    margin:12px 0;
    padding:14px;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
}
.invoice{ background:#28a745; }
.order{ background:#007bff; }
.btn:hover{ opacity:0.9; }
.info{ margin:8px 0; color:#333; }
</style>
</head>
<body>
<div class="box">
    <div class="check">✔</div>
    <h1>Order Placed Successfully!</h1>
    <p>Thank you for your purchase 😊</p>
    <div class="info"><b>Order ID:</b> #<?php echo $order['id']; ?></div>
    <div class="info"><b>Name:</b> <?php echo $order['name']; ?></div>
    <div class="info"><b>Payment:</b> <?php echo $order['method']; ?></div>
    <div class="info"><b>Total Amount:</b> $ <?php echo $order['total_price']; ?></div>
    <a href="invoice.php?id=<?php echo $order['id']; ?>" class="btn invoice" target="blank">
       Download / Print Invoice 
    </a>
    <a href="order.php" class="btn order">
       Click here to order more
    </a>
</div>
</body>
</html>