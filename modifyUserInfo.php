<?php
session_start();
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];

include('db_connect.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    if (!empty($firstName)) {
        $q_fname = "UPDATE user_table SET first_name = '$firstName' WHERE user_id = $user_id";
        mysqli_query($connect, $q_fname);
    }
    if (!empty($lastName)) {
        $q_lname = "UPDATE user_table SET last_name = '$lastName' WHERE user_id = $user_id";
        mysqli_query($connect, $q_lname);
    }
    if (isset($_FILES['img'])) {
        $img_name = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array('jpg', 'jpeg', 'png');

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'profiles_images/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $q_pimg = "UPDATE user_table SET profile_img = '$new_img_name' WHERE user_id = $user_id";
            mysqli_query($connect, $q_pimg);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/main_style.css">

    <style>
        .change-profile {
            border-radius: 15px;
        }
    </style>

</head>

<body>
    <?php include('navbar.php') ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="change-profile container-md container-fluid mt-5 p-4 shadow-lg">
            <div class="mb-3 d-flex flex-row gap-5 align-items-center">
                <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $email ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="firstName" class="col-sm-4 col-form-label">First Name</label>
                <div class="col-sm-7 align-self-center">
                    <input type="text" class="form-control" id="firstName" name="firstName">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="lastName" class="col-sm-4 col-form-label">Last Name</label>
                <div class="col-sm-7 align-self-center">
                    <input type="text" class="form-control" id="lastName" name="lastName">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-4 col-form-label">Profile image</label>
                <div class="col-sm-6 align-self-center">
                    <input type="file" name="img">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Change profile</button>
        </div>
    </form>
    <form action="change_password.php" method="post">
        <div class="change-profile container-md container-fluid mt-5 p-4 shadow-lg mb-5">
            <div class="mb-3 row">
                <label for="c_psw" class="col-sm-4 col-form-label">Current Password</label>
                <div class="col-sm-7 align-self-center">
                    <input type="password" class="form-control" id="c_psw" name="c_psw"
                        placeholder="<?php if (isset($_GET['error']))
                            echo $_GET['error'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="n_psw" class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-7 align-self-center">
                        <input type="password" class="form-control" id="n_psw" name="n_psw">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="rn_psw" class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-7 align-self-center">
                        <input type="password" class="form-control" id="rn_psw" name="rn_psw">
                    </div>
                </div>
                <button type="submit" class="sbm_btn btn btn-primary">Change Password</button>

            </div>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            let e0, e1, e2;

            let old_psw = document.querySelector('#c_psw');
            old_psw.onkeyup = function () {
                if (old_psw.value.length < 8) {
                    old_psw.style.outline = "4px solid #FF6969";
                    e0 = false;
                } else {
                    old_psw.style.outline = "none";
                    e0 = true;
                }
            }

            let confirm_psw = document.querySelector("#rn_psw");
            confirm_psw.onkeyup = function () {
                let confirm_psw = document.querySelector("#rn_psw");
                let new_psw = document.querySelector("#n_psw");
                if (confirm_psw.value != new_psw.value) {
                    confirm_psw.style.outline = "4px solid #FF6969";
                    e1 = false;
                } else {
                    confirm_psw.style.outline = "none";
                    e1 = true;
                }
            }

            let submit_btn = document.querySelector('.sbm_btn');
            let new_psw = document.querySelector("#n_psw");

            new_psw.onkeyup = function () {
                password = new_psw.value;
                var strength = 0;
                if (password.match(/[a-z]+/)) {
                    strength += 1;
                }
                if (password.match(/[A-Z]+/)) {
                    strength += 1;
                }
                if (password.match(/[0-9]+/)) {
                    strength += 1;
                }
                if (password.match(/[$@#&!]+/)) {
                    strength += 1;
                }

                if ((password.length >= 8) && (strength >= 4)) {
                    new_psw.style.outline = "none";
                    e2 = true;
                } else {
                    new_psw.style.outline = "4px solid #FF6969";
                    e2 = false;
                }
            }

            submit_btn.onclick = function checkpassword(e) {
                if (!e0 || !e1 || !e2) {
                    e.preventDefault();
                }
            }


        </script>

    </body>

    </html>