<?php

include('db_connect.php');
session_start();
$user_id = $_SESSION['user_id'];

if (isset($_POST['post_txt'])) {
    $post_txt = $_POST['post_txt'];
    if (isset($_FILES['img'])) {
        $img_name = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array('jpg', 'jpeg', 'png');

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'images/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
        }
    }

    if (empty($post_txt) && isset($_FILES['img'])) {
        $q = "INSERT INTO user_script VALUES (NULL, NULL, '$new_img_name', $user_id)";
        mysqli_query($connect, $q);
    }

    if (!empty($post_txt) && !isset($_FILES['img'])) {
        $stmt = $connect->prepare("INSERT INTO user_script VALUES (NULL, ?, '', $user_id)");
        $stmt->bind_param("s", $post_txt);
        $stmt->execute();    
    }

    if (!empty($post_txt) && isset($_FILES['img'])) {
        $stmt = $connect->prepare("INSERT INTO user_script VALUES (NULL, ?, '$new_img_name', $user_id)");
        $stmt->bind_param("s", $post_txt);
        $stmt->execute();        
    }
}

$q_s = "SELECT * FROM user_script us, user_table ut WHERE us.userId = ut.user_id ORDER BY script_id DESC";
$r1 = $connect->query($q_s);
if ($r1->num_rows > 0) {
    // Fetch data and store it in a variable
    // $usernames = array();
    // $script_text = array();
    // $images = array();
    while ($row = $r1->fetch_assoc()) {
        $username = $row['first_name'] . " " . $row['last_name'];
        $script_text = $row['script_text'];
        $image = $row['img'];
        $profile_img = $row['profile_img'];
        isset($profile_img) ? $p_img = $profile_img : $p_img = 'profile.jpg';
        $script_id = $row['script_id'];

        echo '<div class="user-post d-flex flex-column mb-4 p-3">';
        echo '<div class="post-det d-flex gap-3">';
        echo '<img class="user-post-img" src="profiles_images/' . $p_img . '" alt="">';
        echo '<span class="user-post-det d-flex flex-column">';
        echo $username;
        echo '</span>';
        echo '</div>';
        echo '<div class="post-body mt-3">';
        echo "<p>" . $script_text . "</p>";
        echo "<img src='images/" . $image . "' alt=''>";
        echo '</div>';
        echo '<div class="tools">';
        echo '<button class="btn"><i class="fa-regular fa-thumbs-up"></i></button>';
        echo '<button class="btn"><i class="fa-regular fa-comment" id="'.$script_id.'"></i></button>';
        echo '</div>';
        echo '</div>';

    }
}