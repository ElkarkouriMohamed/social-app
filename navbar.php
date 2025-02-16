<?php

include('getUsername.php');
include('db_connect.php');

$q = "SELECT profile_img FROM user_table WHERE user_id = $user_id";
$r = mysqli_query($connect, $q);
while ($row = $r->fetch_assoc()) {
    $profile_img = $row['profile_img'];
}

?>

<div class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="profile d-flex gap-3">
            <div class="dropdown">
                <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="profile-img"
                        src="profiles_images/<?= strlen($profile_img) > 10 ? $profile_img : 'profile.jpg' ?>" alt="">
                </button>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item py-2" href="login1.php">Home</a></li>
                    <li><a class="dropdown-item py-2" href="modifyUserInfo.php">Account</a></li>
                    <li><a class="dropdown-item py-2" href="index.php">Log out</a></li>
                </ul>
            </div>
            <div class="profile-det d-flex flex-column">
                <span>
                    <?php echo $full_name; ?>
                </span>
                <span>
                    <?= $email ?>
                </span>
            </div>
            <div class="friend_request d-flex align-items-center ms-2">
                <i class="fa-solid fa-bell fa-2x"></i>
            </div>
            <div class="messages d-flex align-items-center ms-2">
                <i class="fa-brands fa-facebook-messenger fa-2x"></i>
            </div>
        </div>

        <form class="d-flex" role="search">
            <input class="search form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </form>
    </div>
</div>