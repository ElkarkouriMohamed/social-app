<?php

session_start();
$email = $_SESSION['email'];

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/main_style.css">
</head>

<body>

    <?php include 'navbar.php' ?>

    <div class="main-content container d-flex flex-md-row-reverse flex-column">
        <div class="publish ps-md-4 mt-5">
            <div class="input-group mb-3">
                <textarea class="form-control" aria-label="With textarea"
                    placeholder="Write what in your mind!"></textarea>
            </div>
            <div class="input-group">
                <input type="file" class="file-input form-control" id="inputGroupFile04"
                    aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <button class="publish-post btn btn-outline-secondary" type="button"
                    id="inputGroupFileAddon04">Post</button>
            </div>
        </div>

        <div class="posts pt-4"></div>
    </div>

    <div class="comments container-fluid">
        <div class="top">
            <span></span>
            <div class="close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="body">

        </div>
        <div class="addComments">
            <div class="">
                <input type="text" class="send_msg">
            </div>
            <span>
                <i class="fa-solid fa-paper-plane"></i>
            </span>
        </div>
    </div>
    <div class="users-search d-none rounded-3 d-flex flex-column gap-3">
    </div>
    <div class="black-opacity"></div>
    <div class="friend-requests d-none d-flex flex-column gap-2"></div>
    <div class="messages-box d-flex d-none">
        <div class="contacts d-flex flex-column">

        </div>
        <div class="body">
            <div class="message-body gap-2"></div>
            <div class="addMessages">
                <div>
                    <input type="text" class="send_msg">
                </div>
                <span>
                    <i class="fa-solid fa-paper-plane"></i>
                </span>
            </div>
        </div>

    </div>
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>