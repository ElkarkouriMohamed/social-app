<?php

include('db_connect.php');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['friend_id'])) {
        $fr_id = $_POST['friend_id'];
        if ($_POST['statu_ajx'] === 'accept') {
            $q_upd = "UPDATE friend_requests SET statu = '1' 
                        WHERE to_user = $user_id 
                        AND from_user = $fr_id";
            mysqli_query($connect, $q_upd);
        } else {
            $q_del = "DELETE FROM friend_requests 
                        WHERE to_user = $user_id 
                        AND from_user = $fr_id";
            mysqli_query($connect, $q_del);
        }

    }

    $q_select = "SELECT from_user, first_name, last_name, profile_img 
                FROM friend_requests fr, user_table u 
                WHERE fr.to_user = $user_id
                AND fr.from_user = u.user_id
                AND statu = '0';";

    $r = mysqli_query($connect, $q_select);

    if (mysqli_num_rows($r) > 0) {
        while ($row = $r->fetch_assoc()) {
            strlen($row['profile_img']) > 10 ? $p_img = $row['profile_img'] : $p_img = 'profile.jpg';
            $friend_id = $row['from_user'];

            echo '<div class="request d-flex flex-column gap-2">';
            echo '<div class="user-profile d-flex gap-2">';
            echo '<div class="profile-img">';
            echo '<img class="w-100 h-100" src="profiles_images/' . $p_img . '" alt="">';
            echo '</div>';
            echo '<div class="username">';
            echo $row['first_name'] . ' ' . $row['last_name'];
            echo '</div>';
            echo '</div>';
            echo '<div class="buttons d-flex justify-content-end gap-2" id="' . $friend_id . '">';
            echo '<button class="cancel btn btn-dark">';
            echo '<span>Cancel</span>';
            echo '<i class="fa-solid fa-xmark"></i>';
            echo '</button>';
            echo '<button class="accept btn btn-primary">';
            echo '<span>Accept</span>';
            echo '<i class="fa-solid fa-circle-check"></i>';
            echo '</button>';
            echo '</div>';
            echo '</div>';
        }
    }
}
