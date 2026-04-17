<?php
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];

if(isset($_POST['id']) && isset($_POST['qty'])){

    $id = $_POST['id'];
    $qty = $_POST['qty'];

    mysqli_query($conn,
      "UPDATE cart SET quantity='$qty'
       WHERE id='$id' AND user_id='$user_id'");
}
?>