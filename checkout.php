
<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
    exit();
}
$message = [];
if (isset($_POST['order_btn'])) {
    // ===== INPUT CLEAN =====
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = mysqli_real_escape_string($conn, $email);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $flat = isset($_POST['flat']) ? trim($_POST['flat']) : '';
    $street = isset($_POST['street']) ? trim($_POST['street']) : '';
    $city = isset($_POST['city']) ? trim($_POST['city']) : '';
    $state = isset($_POST['state']) ? trim($_POST['state']) : '';
    $country = isset($_POST['country']) ? trim($_POST['country']) : '';
    $pin = isset($_POST['pin']) ? trim($_POST['pin']) : '';
    // ===== VALIDATIONS =====
    // NAME
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $message[] = "Invalid name (only letters allowed)";
    }
    // EMAIL
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = "Invalid email format";
    }
    // PHONE (India 10 digit)
    elseif (!preg_match("/^[6-9][0-9]{9}$/", $number)) {
        $message[] = "Invalid phone number (10 digit required)";
    }
    // PIN
    elseif (!preg_match("/^[0-9]{6}$/", $pin)) {
        $message[] = "Invalid PIN code";
    }
    // ADDRESS CHECK
    elseif (empty($flat) || empty($street) || empty($city) || empty($state) || empty($country)) {
        $message[] = "All address fields required";
    }
    // PAYMENT METHOD
    elseif (empty($method)) {
        $message[] = "Select payment method";
    }
    else {
        // ===== CART CHECK =====
        $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'");
        if (mysqli_num_rows($cart_query) == 0) {
            $message[] = "Your cart is empty!";
        } else {
            $cart_total = 0;
            $cart_product = [];
            while ($item = mysqli_fetch_assoc($cart_query)) {
                $cart_product[] = $item['name'].'('.$item['quantity'].')';
                $cart_total += ($item['price'] * $item['quantity']);
            }
            $total_products = implode(', ', $cart_product);
            $address = "Flat: $flat, Street: $street, City: $city, State: $state, Country: $country, PIN: $pin";
            $placed_on = date('d-M-Y');

            // ===== INSERT ORDER =====
            mysqli_query($conn, "INSERT INTO `order`
            (user_id, name, number, email, method, address, total_products, total_price, placed_on)
            VALUES
            ('$user_id','$name','$number','$email','$method','$address','$total_products','$cart_total','$placed_on')");

            $order_id = mysqli_insert_id($conn);

            // ===== SAVE ITEMS =====
            $cart_items = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id'");
            while($item = mysqli_fetch_assoc($cart_items)){
                mysqli_query($conn, "INSERT INTO order_items
                (order_id, product_id, name, price, quantity)
                VALUES
                ('$order_id','{$item['pid']}','{$item['name']}','{$item['price']}','{$item['quantity']}')");
            }
            // CLEAR CART
            mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");
            header("Location: confirmation.php?id=".$order_id);
            exit();
        }
    }
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
            <button class="btn" type="button" id="location-btn">Use My Current Location</button>
            <div class="input-field">
                <label>Address Line 1 <span class="star">*</span></label>
                <input type="text" name="flat" placeholder="e.g. Flat no. / Building name / Road no." required>
            </div> 
            <div class="input-field">
                <label>Address Line 2 <span class="star">*</span></label>
                <input type="text" name="street" placeholder="e.g. street name" required>
            </div>

            <div class="input-field">
                <label>City <span class="star">*</span></label>
                <select name="city" id="city" required></select>
            </div>

            <div class="input-field">
                <label>State <span class="star">*</span></label>
                <select name="state" id="state" required></select>
            </div>
            <div class="input-field">
                <label>Country <span class="star">*</span></label>
                <select name="country" id="country" required></select>
            </div>
            <div class="input-field">
                <label>Pin Code <span class="star">*</span></label>
                <input type="text" name="pin" id="pin" placeholder="Enter PIN" required>
            </div>
            <input type="submit" name="order_btn" class="btn" value="Order Now">
        </form>
    </div>
    <?php include 'footer.php';?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>