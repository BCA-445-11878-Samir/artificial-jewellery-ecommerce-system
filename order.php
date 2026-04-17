<?php
    include 'connection.php';


    session_start();




    
    $user_id = $_SESSION['user_id'];
    if (!isset($user_id)) {
        header('location:login.php');
    }
   
    if (isset($_POST['logout'])) {
        session_destroy();
        header('location:login.php');
    }
    if (isset($_POST['submit-btn'])) {
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $number = mysqli_real_escape_string($conn,$_POST['number']);
        $message = mysqli_real_escape_string($conn,$_POST['message']);

        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$message'") or die ('query failed');
        if (mysqli_num_rows($select_message) > 0) {
            echo 'message already send';
        } else {
            mysqli_query($conn, "INSERT INTO `message`(`user_id`, `name`, `email`, `number`, `message`) VALUES('$user_id', '$name', '$email', '$number', '$message')") or die ('query failed');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order page</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php include 'header.php';?>
    <div class="banner">
        <div class="detail">
            <h1>order</h1>
            <p>Discover elegant designs, explore new collections, and find the perfect jewellery to match your style.</p>
            <a href="index.php">home</a><span>/ order</span>
        </div>
    </div>
    <div class="line"></div>
    <div class="order-section">
        <div class="box-container">
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order` WHERE user_id = '$user_id'") or die ('query failed');
                if (mysqli_num_rows($select_order) > 0) {
                    while ($fetch_order = mysqli_fetch_assoc($select_order)) {
                    
            ?>
            <div class="box">
                <p>order id: <span>#<?php echo $fetch_order['id']; ?></span></p>
                <p>placed on: <span><?php echo $fetch_order['placed_on']; ?></span></p>
                <p>name: <span><?php echo $fetch_order['name']; ?></span></p>
                <p>number: <span><?php echo $fetch_order['number']; ?></span></p>
                <p>email: <span><?php echo $fetch_order['email']; ?></span></p>
                <p>address: <span><?php echo $fetch_order['address']; ?></span></p>
                <p>payment method: <span><?php echo $fetch_order['method']; ?></span></p>
                <p>your order: <span><?php echo $fetch_order['total_products']; ?></span></p>
                <p>total price: <span><?php echo $fetch_order['total_price']; ?></span></p>
                <p>payment status: <span><?php echo $fetch_order['payment_status']; ?></span></p>
                <a href="invoice.php?id=<?php echo $fetch_order['id']; ?>" class="btn" target="blank">
                    Download Invoice
                </a>
            </div>
            <?php
                    }
                } else {
                    echo '
                            <div class="empty">
                                <p>no order placed yet!</p>
                            </div>
                        ';
                }
            ?>
        </div>
    </div>
    <?php include 'footer.php';?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>