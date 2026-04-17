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
    if (isset($_POST['order_btn'])) {
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $number = mysqli_real_escape_string($conn,$_POST['number']);
        $method = mysqli_real_escape_string($conn, $_POST['method'] ?? '');
        $address = mysqli_real_escape_string($conn, 'flat no. '.$_POST['flat'].','.$_POST['street'].','.$_POST['city'].','.$_POST['state'].','.$_POST['country'].','.$_POST['pin']);
        $placed_on = date('d-M-Y');
        $cart_total = 0;
        $cart_product[] = '';
        $cart_query = mysqli_query($conn, "SELECT *FROM `cart` WHERE user_id = '$user_id'") or die ('query failed');

        if (mysqli_num_rows($cart_query) > 0) {
            while ($cart_item = mysqli_fetch_assoc($cart_query)) {
                $cart_product[] = $cart_item['name'].'('.$cart_item['quantity'].')';
                $sub_total = ($cart_item['price'] * $cart_item['quantity']);
                $cart_total += $sub_total;
            }
        }
        $total_products = implode(',', $cart_product);
        mysqli_query($conn, "INSERT INTO `order`(`user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`) VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')");
        // Last inserted order id lo
        $order_id = mysqli_insert_id($conn);

// ===== CART ITEMS KO order_items TABLE ME SAVE KARO =====
$cart_items = mysqli_query($conn,
"SELECT * FROM cart WHERE user_id='$user_id'");

while($item = mysqli_fetch_assoc($cart_items)){

mysqli_query($conn,
"INSERT INTO order_items
(order_id, product_id, name, price, quantity)
VALUES
('$order_id',
 '{$item['pid']}',
 '{$item['name']}',
 '{$item['price']}',
 '{$item['quantity']}')");
}

// ===== AB CART CLEAR KARO =====
mysqli_query($conn,
"DELETE FROM cart WHERE user_id='$user_id'");

        // Confirmation page par bhejo (ID ke saath)
        header("Location: confirmation.php?id=".$order_id);
        exit();
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout page</title>
    
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
    <div class="checkout-form">
        <h1 class="title">payment process</h1>
        <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '
                        <div class="message">
                            <span>'.$message.'</span>
                            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                        </div>
                ';
                }
            }
        ?>
        <div class="display-order">
            <div class="box-container">
                <?php 
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die ('query failed');
                    $total = 0;
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                            $grand_total += $total_price;
                        
                ?>
                
                    <div class="box">
                        <img src="image/<?php echo $fetch_cart['image'];?>">
                        <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                    </div>
                
                <?php 
                        }
                    }
                ?>
            </div>
            <span class="grand-total">Total Amount Payable : $ <?= $grand_total; ?></span>
        </div>
            <form method="post">

                <div class="input-field">
                    <label>Your Name <span class="star">*</span></label>
                    <input type="text" name="name" placeholder="enter your name" required>
                </div>

                <div class="input-field">
                    <label>Your Number <span class="star">*</span></label>
                    <input type="tel" name="number" placeholder="enter your number" required>
                </div>

                <div class="input-field">
                    <label>Your Email <span class="star">*</span></label>
                    <input type="email" name="email" placeholder="enter your email" required>
                </div>

                <div class="input-field">
                    <label>Select Payment Method <span class="star">*</span></label>
                    <select name="method" required>
                        <option value="" disabled selected>Select payment method</option>
                        <option value="cash on delivery">Cash on delivery</option>
                        <option value="credit card">Credit card</option>
                        <option value="paytm">Paytm</option>
                        <option value="paypal">Paypal</option>
                    </select>
                </div>

                <div class="input-field">
                    <label>Address Line 1 <span class="star">*</span></label>
                    <input type="text" name="flat" placeholder="e.g. flat no." required>
                </div>

                <div class="input-field">
                    <label>Address Line 2 <span class="star">*</span></label>
                    <input type="text" name="street" placeholder="e.g. street name" required>
                </div>

                <div class="input-field">
                    <label>City <span class="star">*</span></label>
                    <input type="text" name="city" placeholder="e.g. Delhi" required>
                </div>

                <div class="input-field">
                    <label>State <span class="star">*</span></label>
                    <input type="text" name="state" placeholder="e.g. New Delhi" required>
                </div>

                <div class="input-field">
                    <label>Country <span class="star">*</span></label>
                    <input type="text" name="country" placeholder="e.g. India" required>
                </div>

                <div class="input-field">
                    <label>Pin Code <span class="star">*</span></label>
                    <input type="text" name="pin" placeholder="e.g. 800010" required>
                </div>

                <input type="submit" name="order_btn" class="btn" value="Order Now">

            </form>
        
    </div>
    <?php include 'footer.php';?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>