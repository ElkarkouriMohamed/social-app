<?php

session_start();
$user_id = $_SESSION['user_id'];

include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_psw = $_POST['rn_psw'];
    $old_psw = $_POST['c_psw'];
    $q_hash_psw = "SELECT psw FROM user_table WHERE user_id='$user_id'";
    $result_psw = mysqli_query($connect, $q_hash_psw);
    $rows_num_psw = mysqli_num_rows($result_psw);
    while ($row = $result_psw->fetch_assoc()) {
        $hash_psw = $row['psw'];
    }
    if (password_verify($old_psw, $hash_psw)) {
        $p = password_hash($new_psw, PASSWORD_DEFAULT);
        $qp = "UPDATE user_table SET psw = '$p' WHERE user_id='$user_id'";
        mysqli_query($connect, $qp);
        header("Location: modifyUserInfo.php");
    } else {
        $e = 'Your password is incorrect';
        header("Location: modifyUserInfo.php?error=$e");
    }
}