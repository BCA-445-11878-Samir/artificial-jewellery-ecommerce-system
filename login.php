<?php
include 'connection.php';
session_start();
$message = [];
if (isset($_POST['submit-btn'])) {

    // EMAIL
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = mysqli_real_escape_string($conn, $email);

    // PASSWORD
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // EMAIL VALIDATION
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Invalid email format';
    } 
    else {
        // CHECK USER EXIST
        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

        if (mysqli_num_rows($select_user) == 0) {
            $message[] = 'Email not registered! Please register first';
        } 
        else {
            $row = mysqli_fetch_assoc($select_user);

            // PASSWORD VERIFY
            if (!password_verify($password, $row['password'])) {
                $message[] = 'Incorrect password';
            } 
            else {

                // ADMIN LOGIN
                if ($row['user_type'] == 'admin') {
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['id'];
                    header('location:admin_pannel.php');
                } 
                // USER LOGIN
                else {
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    header('location:index.php');
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
            <h1>login now</h1>
            <div class="input-field">
                <label>your email</label><br>
                <input type="email" name="email" placeholder="enter your email" required>
            </div>
            <div class="input-field">
                <label>your password</label><br>
                <input type="password" name="password" placeholder="enter your password" required>
            </div>
            <input type="submit" name="submit-btn" value="login now" class="btn">
            <p><a href="forgot_password.php">Forgot Password?</a></p>
            <p>do not have an account ? <a href="register.php">register now</a></p>
        </form>
    </section>
</body>
</html>
