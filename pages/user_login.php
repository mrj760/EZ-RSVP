<!-- This page will allow users to log in to their account. 
Also contains a link to the registration page. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <?php
    if (isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == true) {
        unset($_COOKIE['loggedin']);
        setcookie('loggedin', null, -1);
        unset($_COOKIE['username']);
        setcookie('username', null, -1);
    }
    ?>
    <div class="background">
        <h1>Login</h1>
        <form action-="" method="POST">
            <!--Username-->
            <label for="username">Username</label>
            <br>
            <input type="name" id="username" name="username" placeholder="Enter Username" required autofocus>
            <br>
            <!--User Password-->
            <label for="userPassword">Password</label>
            <br>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            <br>
            <!--Sign In Button, move to user dashboard-->
            <input type="submit" value="Login" class="button" href="user_dashboard.html">
            <br>
            <a href="#">Forgot Password</a>
            <br>
            <a href="user_register.html">Don't have an account? Signup here</a>
        </form>
    </div>
</body>

</html>