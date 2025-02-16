<?php

include('db_connect.php');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];


    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
        $cmt = $_POST['comment'];
        $stmt = $connect->prepare("INSERT INTO comments VALUES (NULL,  ?, NULL, $post_id, $user_id)");

        $stmt->bind_param("s", $cmt);

        $stmt->execute();

    }


    $q = "SELECT first_name, last_name, cmt_txt, script_text, script_id, profile_img
            FROM user_table u, user_script s, comments c 
            where s.script_id =  $post_id
            and c.userId = u.user_id 
            and c.post_id = s.script_id;";

    $r = mysqli_query($connect, $q);

    if (mysqli_num_rows($r) > 0) {
        while ($row = $r->fetch_assoc()) {
            $full_name = $row['first_name'] . ' ' . $row['last_name'];

            strlen($row['profile_img']) > 10 ? $p_img = $row['profile_img'] : $p_img = 'profile.jpg';

            echo '<div class="msg-box">';
            echo '<div class="profile-img">';
            echo '<img src="profiles_images/' . $p_img . '" alt="profile-img">';
            echo '</div>';
            echo '<div class="msg">';
            echo '<p class="msg-writer-name">' . $full_name . '</p>';
            echo '<p class="msg-text">' . $row['cmt_txt'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    }
}