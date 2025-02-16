<?php
    include('db_connect.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $psw = $_POST['password'];
        $hash_psw = password_hash($psw, PASSWORD_DEFAULT);
        $q = "INSERT INTO user_table VALUES (NULL, '$firstName', '$lastName', '$email', '$hash_psw', NULL)";
        mysqli_query($connect, $q);

        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <title>Document</title>
    <style>
        * {
            font-family: 'Roboto';
            font-style: normal;
        }
        form {
            width: 450px;
            display: flex;
            flex-direction: column;
            background-color: #DBE2EF;
            border-radius: 10px;
            padding-inline: 20px;
            padding-top: 40px;
            padding-bottom: 30px;
            box-sizing: border-box;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        @media only screen and (max-width: 456px) {
            form {
                width: 100%;
                height: initial;
            }
        }
        input:not(:last-child){
            margin-bottom: 35px;
            padding: 18px;
            border: none;
            outline: none;
            border-radius: 5px;
        }
        input:last-child {
            padding: 10px;
            border: none;
            outline: none;
            border-radius: 5px;
            background-color: #3F72AF;
            color: white;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
        }
        input:last-child:hover {
            background-color: #112D4E;
        }
        input:nth-child(2) {
            margin-bottom: 25px;
        }
        span {
            padding-left: 18px;
            color: #EF4040;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="firstName" placeholder="First Name" required>
        <input type="text" name="lastName" placeholder="Last Name" required>
        <span></span>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" id="psw" required>
        <input type="submit" value="sign up">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        document.forms[0].onsubmit = function (e) {
            let psw = document.getElementById('psw');
            statu = true;
            if (psw.value.length < 8) {
                statu = false;
                psw.setAttribute('placeholder', 'Password must be more than 8 char');
                psw.value = '';
            }
            if (!statu) {
                e.preventDefault();
            }
        }

        $(document).ready(function () {
            $("#email").keyup(function () {
                $.ajax({
                    url: 'check_email.php',
                    type: 'post',
                    data: {email: $(this).val()},
                    success: function (result) {
                    $("span").html(result);
                }
                })
            })

            $("input:last-child").click(function (e) {
                if ($("span").text().length > 0) {
                    e.preventDefault();
                }
            })
        })


    </script>
</body>
</html>