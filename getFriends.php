<?php

include ('db_connect.php');

session_start();
$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $q = "SELECT user_id, first_name, last_name, profile_img 
        FROM user_table u 
        WHERE u.user_id in (SELECT from_user FROM friend_requests WHERE to_user = $user_id and statu != '0') 
        OR u.user_id in (SELECT to_user FROM friend_requests WHERE from_user = $user_id and statu != '0');";

    $r = mysqli_query($connect, $q);
    while ($row = $r->fetch_assoc()) {
        strlen($row['profile_img']) > 10 ? $p_img = $row['profile_img'] : $p_img = 'profile.jpg';
        $friend_id = $row['user_id'];

        echo '<div class="contact-friend d-flex gap-2 p-2">';
        echo '<div class="profile-img">';
        echo '<img id="'.$friend_id.'" class="w-100 h-100" src="profiles_images/' . $p_img . '" alt="">';
        echo '</div>';
        echo '<div class="profile-name">';
        echo $row['first_name'] . ' ' . $row['last_name'];
        echo '</div>';
        echo '</div>';
    }


}
