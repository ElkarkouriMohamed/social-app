<?php

include('db_connect.php');

$en_email = $_POST['email'];


if (strlen($en_email) > 4) {
    $en_email = $_POST['email'];
    $q = "SELECT email FROM user_table WHERE email like '$en_email%'";
    $r = mysqli_query($connect, $q);

    if (mysqli_num_rows($r) > 0) {
        echo 'email is already exist';
    }

}