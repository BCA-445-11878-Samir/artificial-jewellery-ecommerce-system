<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>

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

        .otp-boxes {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .otp-boxes input {
            width: 40px;
            height: 45px;
            text-align: center;
            font-size: 18px;
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
            background: #ffd700;
            transform: scale(1.05);
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
    <h2>Verify OTP</h2>

    <form method="POST" onsubmit="return validateOTP()">

        <div class="otp-boxes">
            <input type="text" maxlength="1" onkeyup="moveNext(this,1)">
            <input type="text" maxlength="1" onkeyup="moveNext(this,2)">
            <input type="text" maxlength="1" onkeyup="moveNext(this,3)">
            <input type="text" maxlength="1" onkeyup="moveNext(this,4)">
            <input type="text" maxlength="1" onkeyup="moveNext(this,5)">
            <input type="text" maxlength="1" onkeyup="moveNext(this,6)">
        </div>

        <input type="hidden" name="otp" id="finalOtp">

        <div id="error" class="error"></div>

        <button type="submit">Verify</button>
    </form>

</div>

<script>
// auto move
function moveNext(current, next){
    if(current.value.length == 1){
        if(next <= 6){
            document.querySelectorAll(".otp-boxes input")[next].focus();
        }
    }
}

// combine OTP
function validateOTP(){
    let inputs = document.querySelectorAll(".otp-boxes input");
    let otp = "";

    inputs.forEach(input => {
        otp += input.value;
    });

    if(otp.length !== 6 || isNaN(otp)){
        document.getElementById("error").innerHTML = "❌ Enter valid 6-digit OTP";
        return false;
    }

    document.getElementById("finalOtp").value = otp;
    return true;
}
</script>

</body>
</html>

<?php
if(isset($_POST['otp'])){

    if($_POST['otp'] == $_SESSION['otp']){

        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];

        mysqli_query($conn, "INSERT INTO users (name, email, password) 
        VALUES ('$name', '$email', '$password')");

        echo "<script>
            alert('Registered Successfully');
            window.location.href='login.php';
        </script>";

        session_destroy();

    } else {
        echo "<p style='color:red;text-align:center;'>Wrong OTP ❌</p>";
    }
}
?>