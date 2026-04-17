<?php
    include 'connection.php';
    session_start();
    $admin_id = $_SESSION['admin_name'];
    if (!isset($admin_id)) {
        header('location:login.php');
    }
    if (isset($_POST['logout'])) {
        session_destroy();
        header('location:login.php');
    }
?>
<style type="text/css">
    <?php 
        include 'style.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>admin pannel</title>
</head>
<body>
    <?php include 'admin_header.php';?>
    <div class="line4"></div>
    <section class="dashboard">
        <div id="dashboardData"></div>
    </section>
    <audio id="orderSound" src="ding.wav" preload="auto"></audio>
    <script>
        let previousOrders = 0;
        function loadDashboard(){
            fetch("fetch_dashboard.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("dashboardData").innerHTML = data;
                // Orders count read (3rd box)
                const orderBox = document.querySelectorAll(".box h3")[2];
                if(orderBox){
                    let currentOrders = parseInt(orderBox.innerText);
                    if(previousOrders && currentOrders > previousOrders){
                        document.getElementById("orderSound").play();
                    }
                    previousOrders = currentOrders;
                }
            });
        }
        loadDashboard();
        setInterval(loadDashboard, 5000);
    </script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>