<?php

include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $psw = $_POST['password'];

    $q0 = "SELECT * FROM user_table WHERE email='$email'";
    $result = mysqli_query($connect, $q0);
    $rows_num = mysqli_num_rows($result);

    $q_hash_psw = "SELECT psw FROM user_table WHERE email='$email'";
    $result_psw = mysqli_query($connect, $q_hash_psw);
    $rows_num_psw = mysqli_num_rows($result_psw);
    if ($result_psw->num_rows > 0) {
        while ($row = $result_psw->fetch_assoc()) {
            $hash_psw = $row['psw'];
        }
    }

    if ($rows_num > 0 && password_verify($psw, $hash_psw)) {
        $q2 = "SELECT user_id FROM user_table WHERE email='$email'";
        $result2 = $connect->query($q2);
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $user_id = $row['user_id'];
            }
            echo $user_id;
            session_start();
            $_SESSION['user_id'] = $user_id;
        }
        // $q3 = "SELECT first_name, last_name FROM user_table WHERE user_id='$user_id';";
        // $result3 = $connect->query($q3);
        // if ($result3->num_rows > 0) {
        //     while ($row = $result3->fetch_assoc()) {
        //         $username = $row['first_name'] . ' ' . $row['last_name'];
        //     }
        //     $_SESSION['username'] = $username;

        // }
        $_SESSION['email'] = $email;

        if ($result->num_rows > 0) {
            header("Location: login1.php");
        }

    } else {
        $e = 'Your email or password is incorrect';
        header("Location: index.php?error=$e");
    }
}

