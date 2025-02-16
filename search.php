<?php

include('db_connect.php');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search_key = $_POST['name'];

    if (isset($_POST['friend_id'])) {
        $to_user = $_POST['friend_id'];
        $q_insert = "INSERT INTO friend_requests VALUES ($user_id, $to_user, '')";
        mysqli_query($connect, $q_insert);
    }

    $q = "SELECT user_id, first_name, last_name, profile_img
    FROM user_table u
    WHERE u.user_id NOT IN (SELECT from_user FROM friend_requests WHERE to_user =$user_id) 
    AND u.user_id NOT IN (SELECT to_user FROM friend_requests WHERE from_user =$user_id)
    AND u.user_id != $user_id
    AND (u.last_name LIKE '%$search_key%' OR u.first_name LIKE '%$search_key%')";

    $r = mysqli_query($connect, $q);
    while ($row = $r->fetch_assoc()) {
        strlen($row['profile_img']) > 10 ? $p_img = $row['profile_img'] : $p_img = 'profile.jpg';
        $friend_id = $row['user_id'];
        echo '<div class="user-card d-flex flex-column gap-2">';
        echo    '<div class="user-profile d-flex gap-2">';
        echo        '<div class="profile-img">';
        echo            '<img class="w-100 h-100" src="profiles_images/' . $p_img . '" alt="">';
        echo        '</div>';
        echo        '<div class="username">';
        echo            $row['first_name'] . ' ' . $row['last_name'];
        echo        '</div>';
        echo    '</div>';
        echo    '<button class="add-friend-btn btn btn-dark d-flex justify-content-center align-items-center gap-3" id="' . $friend_id . '">';
        echo        '<span>Add friend</span>';
        echo        '<i class="fa-solid fa-user-plus"></i>';
        echo    '</button>';
        echo '</div>';
    }

}


