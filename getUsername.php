<?php

$user_id = $_SESSION['user_id'];

include('db_connect.php');

$q = "SELECT first_name, last_name FROM user_table WHERE user_id = $user_id";
$r = mysqli_query($connect, $q);
while ($row = $r->fetch_assoc()) {
    $full_name = $row['first_name'].' '.$row['last_name'];
}

