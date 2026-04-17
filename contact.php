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
    $message_text = mysqli_real_escape_string($conn,$_POST['message']);
    $select_message = mysqli_query($conn,
    "SELECT * FROM `message`
     WHERE email='$email'
     AND message='$message_text'")
     or die('query failed');

    if (mysqli_num_rows($select_message) > 0) {
        $message[] = 'Message already sent';
    } else {
        mysqli_query($conn,
        "INSERT INTO `message`
        (`user_id`, `name`, `email`, `number`, `message`)
        VALUES('$user_id', '$name', '$email', '$number', '$message_text')")
        or die('query failed');

        $message[] = 'Message sent successfully';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact us page</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php include 'header.php';?>
    <div class="banner">
        <div class="detail">
            <h1>contact</h1>
            <p>Discover elegant designs, explore new collections, and find the perfect jewellery to match your style.</p>
            <a href="index.php">home</a><span>/ contact</span>
        </div>
    </div>
    <div class="line7"></div>
    <!---------about us------------>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="img/0.png">
                <div>
                    <h1>Free & Fast Shipping</h1>
                    <p>Enjoy free and fast delivery on all orders. We ensure that your jewellery reaches you safely and on time.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/1.png">
                <div>
                    <h1>Quality Guarantee</h1>
                    <p>Our jewellery is carefully crafted with high-quality materials to provide a stylish and long-lasting shine.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/2.png">
                <div>
                    <h1>24/7 Customer Support</h1>
                    <p>Our support team is always ready to help you with your orders, product details, and any queries.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line4"></div>
    <div class="form-container">
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
        <h1 class="title">leave a message</h1>
        <form method="post">

            <div class="input-field">
                <label>Your Name <span class="star">*</span></label><br>
                <input type="text" name="name" required>
            </div>

            <div class="input-field">
                <label>Your Email <span class="star">*</span></label><br>
                <input type="email" name="email" required>
            </div>

            <div class="input-field">
                <label>Number <span class="star">*</span></label><br>
                <input type="tel" name="number" pattern="[0-9]{10}" required>
            </div>

            <div class="input-field">
                <label>Your Message <span class="star">*</span></label><br>
                <textarea name="message" required></textarea>
            </div>

            <button type="submit" name="submit-btn">Send Message</button>
        </form>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <div class="address">
        <h1 class="title">our contact</h1>
        <div class="row">
            <div class="box">
                <i class="bi bi-map-fill"></i>
                <div>
                    <h4>address</h4>
                    <p>Cimage Group of Institutions,
                        Patna,<br>Bihar,
                        India,824101
                    </p> 
                </div>
            </div>
            <div class="box">
                <i class="bi bi-telephone-fill"></i>
                <div>
                    <h4>phone number</h4>
                    <p>9334139734</p> 
                </div>
            </div>
            <div class="box">
                <i class="bi bi-envelope-fill"></i>
                <div>
                    <h4>email</h4>
                    <p>mdsamirparwez@gmail.com</p> 
                </div>
            </div>
        </div>
    </div>
    <div class="line3"></div>
    <?php include 'footer.php';?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>