<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>

    <style>
        body {
            margin: 0;
            padding: 0;
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
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
            border: 1px solid gold;
        }

        h2 {
            color: gold;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background: #222;
            color: white;
            font-size: 15px;
        }

        input::placeholder {
            color: #aaa;
        }

        .error {
            font-size: 13px;
            text-align: left;
            margin-top: -5px;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: gold;
            border: none;
            border-radius: 8px;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #ffd700;
            transform: scale(1.05);
        }

        .logo {
            font-size: 22px;
            color: gold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Forgot Password</h2>
        <form action="send_reset_otp.php" method="POST" onsubmit="return validateEmail()"> 
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <div id="email-error" class="error"></div>
            <button type="submit">Send OTP</button>
        </form>
    </div>
    <script>
        function validateEmail() {
            const email = document.getElementById("email").value;
            const error = document.getElementById("email-error");
            const pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!pattern.test(email)) {
                error.innerHTML = "❌ Invalid email format";
                error.style.color = "red";
                return false;
            } else {
                error.innerHTML = "✅ Valid email";
                error.style.color = "lightgreen";
                return true;
            }
        }
    </script>
</body>
</html>