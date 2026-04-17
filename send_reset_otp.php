<?php
session_start();
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

$email = $_POST['email'];

// check user exist
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) == 0){
    echo "Email not registered!";
    exit();
}

// OTP
$otp = rand(100000, 999999);

$_SESSION['reset_otp'] = $otp;
$_SESSION['reset_email'] = $email;

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

    $mail->Subject = 'Password Reset OTP';
    $mail->Body = "Your OTP is: $otp";

    $mail->send();

    header("Location: verify_reset_otp.php");
    exit();

} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
?>