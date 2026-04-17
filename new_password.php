<?php
session_start();
if(!isset($_SESSION['reset_email'])){
    echo "Session expired ❌";
    echo "<br><a href='forgot_password.php'>Go Back</a>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Set New Password</title>

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
            border-radius: 8px;
            border: none;
            background: #222;
            color: white;
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
        }

        button:hover {
            transform: scale(1.05);
        }

        ul {
            text-align: left;
            font-size: 13px;
            color: red;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .logo {
            color: gold;
            font-size: 22px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="logo">💎 Jewellery Shop</div>
        <h2>Set New Password</h2>
        <form action="update_password.php" method="POST" onsubmit="return validatePassword()">
            <input type="password" id="password" name="new_pass" placeholder="Enter new password" required>
            <!-- PASSWORD RULES -->
            <ul>
                <li id="length">Minimum 8 characters</li>
                <li id="capital">1 Capital letter</li>
                <li id="number">1 Number</li>
                <li id="special">1 Special character</li>
            </ul>
            <input type="password" id="cpassword" name="confirm_pass" placeholder="Confirm password" required>
            <div id="error" class="error"></div>
            <button type="submit">Update Password</button>
        </form>
    </div>
    <script>
        // LIVE PASSWORD CHECK
        const password = document.getElementById("password");

        password.addEventListener("keyup", function(){
            const val = password.value;
            document.getElementById('length').style.color =
                val.length >= 8 ? 'lightgreen' : 'red';

            document.getElementById('capital').style.color =
                /[A-Z]/.test(val) ? 'lightgreen' : 'red';

            document.getElementById('number').style.color =
                /[0-9]/.test(val) ? 'lightgreen' : 'red';

            document.getElementById('special').style.color =
                /[\W]/.test(val) ? 'lightgreen' : 'red';
        });
        // FINAL VALIDATION (REGISTER jaisa)
        function validatePassword(){
            const pass = document.getElementById("password").value;
            const cpass = document.getElementById("cpassword").value;
            const error = document.getElementById("error");

            const pattern = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W]).{8,}$/;

            if(!pattern.test(pass)){
                error.innerHTML = "❌ Password must be 8 chars, 1 capital, 1 number, 1 special char";
                return false;
            }
            if(pass !== cpass){
                error.innerHTML = "❌ Passwords do not match";
                return false;
            }
            return true;
        }
    </script>
</body>
</html>