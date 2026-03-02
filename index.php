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
                <img src="img/slider5.jpg">
                <div class="slider-caption">
                    <span>Pure Elegance</span>
                    <h1>Premium Diamond Look <br>Jewellery</h1>
                    <p>Discover timeless diamond jewellery crafted with precision, brilliance, <br>and unmatched luxury for every special moment.</p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/final.png">
                <div class="slider-caption">
                    <span>Pure Elegance</span>
                    <h1>Premium Diamond Look <br>Jewellery</h1>
                    <p>Discover timeless diamond jewellery crafted with precision, brilliance, <br>and unmatched luxury for every special moment.</p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/image.png">
                <div class="slider-caption">
                    <span>Pure Elegance</span>
                    <h1>Premium Diamond Look <br>jewellery</h1>
                    <p>Discover timeless diamond jewellery crafted with precision, brilliance, <br>and unmatched luxury for every special moment.</p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev"></i>
            <i class="bi bi-chevron-right next"></i>
        </div>
    </div>
    <div class="line"></div>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="img/0.png">
                <div>
                    <h1>Free Shipping Fast</h1>
                    <p>Lorem ipsum dolor sit amet consectet adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/1.png">
                <div>
                    <h1>Money Back and Guarantee</h1>
                    <p>Lorem ipsum dolor sit amet consectet adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/2.png">
                <div>
                    <h1>Online Support 24/7</h1>
                    <p>Lorem ipsum dolor sit amet consectet adipisicing elit.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line2"></div>
    <div class="story">
        <div class="row">
            <div class="box">
                <span>our story</span>
                <h1>Production of natural honey since 1190</h1>
                <p>introduvton your name and to your name is to be the school samit parwez aiya gauhar sifa tabrez kalia julaya and tum bin kate na ratiya aa ja mahi na hai </p>
                <a href="shop.php" class="btn">shop now</a>
            </div>
            <div class="box">
                <img src="img/8.png">
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
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>lorem introduvton your name and to your name is to be the school samit parwez aiya gauhar sifa tabrez kalia julaya and tum bin kate na ratiya aa ja mahi na hai</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="img/profile.jpg">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>lorem introduvton your name and to your name is to be the school samit parwez aiya gauhar sifa tabrez kalia julaya and tum bin kate na ratiya aa ja mahi na hai</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="img/4.jpg">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>lorem introduvton your name and to your name is to be the school samit parwez aiya gauhar sifa tabrez kalia julaya and tum bin kate na ratiya aa ja mahi na hai</p>
                </div>
            </div>
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev1"></i>
            <i class="bi bi-chevron-right next1"></i>
        </div>
    </div>
    <div class="line"></div>
    <!---------discover section-------->
    <div class="line"></div>
    <div class="discover">
        <div class="detail">
            <h1 class="title">Organic Honey Be Healthy</h1>
            <span>Buy Now And Save 30% Off</span>
            <p>lorem introduvton your name and to your name is to be the school samit parwez aiya gauhar sifa tabrez kalia julaya and tum bin kate na ratiya aa ja mahi na hair and wash this for the newly for the women and king of two new thing and new and kind of two two more than two thing</p>
            <a href="shop.php" class="btn">discover now</a>
        </div>
        <div class="img-box">
            <img src="img/13.png">
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
            <img src="img/client0.png">
        </div>
        <div class="box">
            <img src="img/client1.png">
        </div>
        <div class="box">
            <img src="img/client2.png">
        </div>
        <div class="box">
            <img src="img/client3.png">
        </div>
        <div class="box">
            <img src="img/client.png">
        </div>
    </div>
    <?php include 'footer.php';?>

    <!---------------slick slider link------------------------------------------>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="jquary.js"></script>
    <script src="slick.js"></script>
    <script type="text/javascript">
        <?php include 'script2.js"'?>
    </script>
</body>
</html>