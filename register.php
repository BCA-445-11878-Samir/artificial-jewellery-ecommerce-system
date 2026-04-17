<?php
session_start();
include 'connection.php';
use PHPMailer\PHPMailer\PHPMailer;
$message = [];
if (isset($_POST['submit-btn'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = mysqli_real_escape_string($conn, $email);

    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Invalid email format';
    } 
    elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $message[] = "Invalid name";
    }
    else {

        $select_user = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($select_user) > 0) {
            $message[] = 'User already exists';
        }
        elseif (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W]).{8,}$/', $password)) {
            $message[] = 'Weak password';
        }
        elseif ($password != $cpassword) {
            $message[] = 'Passwords do not match';
        }
        else {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $otp = rand(100000, 999999);

            $_SESSION['otp'] = $otp;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $hashed_password;

            require 'PHPMailer-master/src/PHPMailer.php';
            require 'PHPMailer-master/src/SMTP.php';
            require 'PHPMailer-master/src/Exception.php';

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;

                $mail->Username = 'mdsamirparwez2006@gmail.com';
                $mail->Password = 'ejdtlftcysbmflfn';

                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('mdsamirparwez2006@gmail.com', 'Jewellery Shop');
                $mail->addAddress($email);

                $mail->Subject = 'Register OTP';
                $mail->Body = "Your OTP is: $otp";

                $mail->send();

                header("Location: verify_register_otp.php");
                exit();

            } catch (Exception $e) {
                echo "Error: {$mail->ErrorInfo}";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="form-container">
        <?php
            if (isset($message)) {
                foreach ($message as $msg) {
                    echo '
                        <div class="message">
                            <span>'.$msg.'</span>
                            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                        </div>
                    ';
                }
            }
        ?>
        <form method="post">
            <h1>register now</h1>
            <input type="text" name="name" placeholder="enter your name" required>
            <input type="email" name="email" placeholder="enter your email" required>
            <p id="email-msg"></p>
            <input type="password" name="password" placeholder="enter your password" required>
            <!-- PASSWORD RULES -->
            <ul id="password-rules">
                <li id="length">Minimum 8 characters</li>
                <li id="capital">1 Capital letter</li>
                <li id="number">1 Number</li>
                <li id="special">1 Special character</li>
            </ul>
            <input type="password" name="cpassword" placeholder="confirm your password" required>
            <input type="submit" name="submit-btn" value="register now" class="btn">
            <p>already have an account ? <a href="login.php">login now</a></p>
        </form>
    </section>
    <script>
        // EMAIL VALIDATION
        const email = document.querySelector('input[name="email"]');
        const emailMsg = document.getElementById('email-msg');

        email.addEventListener('keyup', function() {
            const val = email.value;
            const pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

            if (pattern.test(val)) {
                emailMsg.innerHTML = "Valid Email ✅";
                emailMsg.style.color = "green";
            } else {
                emailMsg.innerHTML = "Invalid Email ";
                emailMsg.style.color = "red";
            }
        });
        // PASSWORD VALIDATION
        const password = document.querySelector('input[name="password"]');
        password.addEventListener('keyup', function() {
            const val = password.value;

            document.getElementById('length').style.color =
                val.length >= 8 ? 'green' : 'red';

            document.getElementById('capital').style.color =
                /[A-Z]/.test(val) ? 'green' : 'red';

            document.getElementById('number').style.color =
                /[0-9]/.test(val) ? 'green' : 'red';

            document.getElementById('special').style.color =
                /[\W]/.test(val) ? 'green' : 'red';
        });

    </script>
</body>
</html>