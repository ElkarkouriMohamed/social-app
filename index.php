<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <title>Login page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="parent">
        <div class="loginput">
            <p>Login in your account</p>
            <div class="input">
                <form action="check_user.php" method="post" autocomplete="off">
                    <div class="email_input">
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="password_input">
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="loginbutton">
                        <div><?php if (isset($_GET['error'])) echo $_GET['error'] ?></div>
                        <input type="submit" value="Login">
                    </div>
                </form>
            </div>
            
            <div class="p">
                <a href="#forget">forget password?</a>
            </div>
        </div>
        <div class="signup">
            <h2>HELLO</h2>
            <p>creat your new account</p>
            <div class="link">
                <a href="sign_up.php">Sign up</a>
            </div>
        </div>
    </div>
    
</body>
</html>