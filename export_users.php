<?php
include 'connection.php';

// Excel header
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=users_report.xls");

// Count
$total_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$total_admin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE user_type='admin'"));
$total_normal = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE user_type='user'"));

echo "Users Report\n\n";
echo "Total Users: $total_users\n";
echo "Admin: $total_admin\n";
echo "Users: $total_normal\n\n";

// Table header
echo "S.No\tName\tEmail\tUser Type\n";

// Data
$i = 1;
$query = mysqli_query($conn, "SELECT * FROM users");

while($row = mysqli_fetch_assoc($query)){
    echo $i."\t".$row['name']."\t".$row['email']."\t".$row['user_type']."\n";
    $i++;
}
?>