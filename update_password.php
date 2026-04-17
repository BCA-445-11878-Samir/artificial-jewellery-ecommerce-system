<?php
session_start();
include 'connection.php';
$email = $_SESSION['reset_email'];
$new_pass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
mysqli_query($conn, "UPDATE users SET password='$new_pass' WHERE email='$email'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Password Updated</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1a1a1a, #000);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: #111;
            padding: 40px;
            border-radius: 15px;
            width: 350px;
            text-align: center;
            box-shadow: 0 0 25px rgba(255, 215, 0, 0.4);
            border: 1px solid gold;
        }

        .logo {
            font-size: 24px;
            color: gold;
            margin-bottom: 15px;
        }

        h2 {
            color: lightgreen;
            margin-bottom: 15px;
        }

        p {
            color: #ccc;
            font-size: 14px;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background: gold;
            color: black;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        a:hover {
            background: #ffd700;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="logo">💎 Jewellery Shop</div>
        <h2>Password Updated Successfully ✅</h2>
        <p>Your password has been changed securely.</p>
        <a href="login.php">Go to Login</a>
    </div>
</body>
</html>