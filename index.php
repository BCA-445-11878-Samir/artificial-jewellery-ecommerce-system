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
    //adding product in wishlist
    if (isset($_POST["add_to_wishlist"])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image= $_POST['product_image'];
        $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id ='$user_id'") or die ('query failed');
        $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id ='$user_id'") or die ('query failed');
        if (mysqli_num_rows($wishlist_number) > 0) {
            $message[] = 'product already exist in wishlist';
        } else if (mysqli_num_rows($cart_num) > 0){
            $message[] = 'product already exist in cart';
        } else {
            mysqli_query($conn, "INSERT INTO `wishlist` (`user_id`, `pid`, `name`, `price`, `image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')");
            $message[] = 'product successfuly added in your wishlist';
        }
    }
    //adding product in cart
    if (isset($_POST["add_to_cart"])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image= $_POST['product_image'];
        $product_quantity= $_POST['product_quantity'];
        $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id ='$user_id'") or die ('query failed');
        if (mysqli_num_rows($cart_num) > 0){
            $message[] = 'product already exist in cart';
        } else {
            mysqli_query($conn, "INSERT INTO `cart` (`user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')");
            $message[] = 'product successfuly added in your cart';
        }
    }
?>
<style type = "text/css">
    <?php
        include 'main.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hoome page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->  
</head>
<body>
    <?php include 'header.php';?>
    <!---------------home slider link------------------------------------------>
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
            <img src="img/spver.png">
            <div class="slider-caption">
                <span>Elegant Collection</span>
                <h1>Designer Gold <br>Bangles</h1>
                <p>Stylish and lightweight designer bangles <br> crafted to add charm and elegance to every occasion.</p>
                <a href="shop.php" class="btn">Shop Now</a>
            </div>
        </div>
        <!-- SLIDE 2 -->
        <div class="slider-item">
            <img src="img/huii.png">
            <div class="slider-caption">
                <span>Modern Style</span>
                <h1>Diamond <br>Earrings</h1>
                <p>Elegant and sparkling diamond earrings to <br> enhance your everyday look with timeless shine.</p>
                <a href="shop.php" class="btn">Shop Now</a>
            </div>
        </div>
        <!-- SLIDE 3 -->
        <div class="slider-item">
            <img src="img/ghyy.png">
            <div class="slider-caption">
                <span>Bridal Special</span>
                <h1>Premium Bridal <br>Jewellery Set</h1>
                <p>Complete bridal jewellery set crafted with <br> precision and elegance for your big day.</p>
                <a href="shop.php" class="btn">Shop Now</a>
            </div>
        </div>
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev"></i>
            <i class="bi bi-chevron-right next"></i>
        </div>
    </div>
    <!-- <div class="line"></div> -->
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
    <div class="line2"></div>
    <div class="story">
        <div class="row">
            <div class="box">
                <span>our story</span>
                <h1>Beautiful Artificial Jewellery for Every Occasion</h1>
                <p>
                    Discover our beautiful collection of artificial jewellery designed to add elegance and charm to every occasion. 
                    We offer a wide variety of bangles, necklaces, earrings, rings, and bridal jewellery sets crafted with modern 
                    designs and fine finishing. Our jewellery is perfect for weddings, festivals, parties, and everyday fashion. 
                    We focus on quality, style, and affordability so that every customer can enjoy a luxurious look without spending 
                    too much. Explore our collection and find the perfect piece that complements your personality and enhances your style.
                    </p>
                <a href="shop.php" class="btn">shop now</a>
            </div>
            <div class="box">
                <img src="img/imageu.png">
            </div>
        </div>
    </div>
    <div class="line3"></div>
    <!-- testimonial -->
    <div class="line4"></div>
    <div class="testimonial-fluid">
        <h1 class="title">What Our Customers Say's</h1>
        <div class="testimonial-slider">

            <div class="testimonial-item">
                <img src="img/3.jpg">
                <div class="testimonial-caption">
                    <span>Customer Review</span>
                    <h1>Beautiful Jewellery Collection</h1>
                    <p>
                    I recently bought a pair of bangles and earrings from this jewellery store and I am extremely happy with my purchase. <br> 
                    The design is very elegant and the finishing is amazing. The jewellery looks premium but the price is very affordable. <br>
                    I wore it to a family function and everyone complimented my look. I highly recommend this store to anyone who loves <br>
                    stylish and beautiful artificial jewellery.
                    </p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="img/profile.jpg">
                <div class="testimonial-caption">
                    <span>Happy Customer</span>
                    <h1>Perfect for Every Occasion</h1>
                    <p>
                    This is one of the best online stores for artificial jewellery. The collection is modern, trendy, and suitable <br> 
                    for every occasion such as weddings, parties, and festivals. The quality is really impressive and the jewellery <br> 
                    is very comfortable to wear. The delivery was fast and the packaging was also very secure. I will definitely <br>
                    purchase more jewellery from this store in the future.
                    </p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="img/4.jpg">
                <div class="testimonial-caption">
                    <span>Customer Feedback</span>
                    <h1>Elegant and Affordable</h1>
                    <p>
                    I was searching for affordable jewellery with stylish designs and I found exactly what I wanted here. <br>
                    The variety of bangles, necklaces, earrings, and bridal sets is really impressive. Each product is <br>
                    beautifully designed and looks very elegant when worn. The customer service is also very helpful and <br>
                    responsive. I truly love the quality and style of the jewellery available in this shop.
                    </p>
                </div>
            </div>
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev1"></i>
            <i class="bi bi-chevron-right next1"></i>
        </div>
    </div>
    <!-- <div class="line"></div> -->
    <!---------discover section-------->
    <div class="line"></div>
    <div class="line8"></div>
    <div class="discover">
        <div class="detail">
            <h1 class="title">Timeless Jewellery, Eternal Beauty</h1>
            <span>Exclusive Wedding Collection Available</span>
            <p>
                Explore our handcrafted jewellery designed for weddings, festivals and celebrations. From classic to modern styles, find the perfect piece that completes your look with grace and tradition.
            </p>
            <a href="shop.php" class="btn">Discover Now</a>
        </div>
        <div class="img-box">
            <img src="img/kkki.png">
        </div>
    </div>
    <div class="line3"></div>
    <?php include 'homeshop.php';?>
    <div class="line2"></div>
    <div class="newslatter">
        <h1 class="title">Join Our To Newslatter</h1>
        <p>Get 15% off your next order. Be the first to learn about promotions events, new arrivals and more.</p>
        <input type="text" name="" placeholder="your Email Address...">
        <button>subscribe now</button>
    </div>
    <div class="line3"></div>
    <div class="client">
        <div class="box">
            <img src="img/pc4.png">
        </div>
        <div class="box">
            <img src="img/pc0.png">
        </div>
        <div class="box">
            <img src="img/pc1.png">
        </div>
        <div class="box">
            <img src="img/pc2.png">
        </div>
        <div class="box">
            <img src="img/pc3.png">
        </div>
    </div>
    <?php include 'footer.php';?>
    <!---------------slick slider link------------------------------------------>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript">
        <?php include 'script2.js'?>
    </script>
</body>
</html>