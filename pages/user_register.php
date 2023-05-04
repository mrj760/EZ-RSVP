<!-- This page will allow new users to create an account by providing 
their name, email address, and a password. 
Also contains a link to the login page. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?=filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?=filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <div class="background">
        <h1>Signup</h1>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

            <?php
            require_once("../php/db.config.php");
            session_start();
            $_SESSION = array();
            ?>
            <!--Username-->
            <label for="username" class="lable">Username</label>
            <br>
            <?php
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
            $_SESSION['username'] = "";
            $email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
            $_SESSION['email'] = "";
            ?>
            <input type="name" id="username" name="username" placeholder="Enter Username" value="<?php echo $username; ?>" required autofocus>
            <?php
            $usernameError = isset($_SESSION['usernameTaken']) && $_SESSION['usernameTaken'] ? "Username taken... Retry" : "";
            $_SESSION['usernameTaken'] = false;
            ?>
            <p id="usernameError"><?php echo $usernameError; ?></p>
            <!--Email-->
            <label for="email">Email</label>
            <br>
            <input type="email" id="email" name="email" placeholder="Enter Email" value="<?php echo $email; ?>" required>
            <?php
            $emailError = isset($_SESSION['emailTaken']) && $_SESSION['emailTaken'] ? "Email taken... Retry" : "";
            $_SESSION['emailTaken'] = false;
            ?>
            <p id="emailError"><?php echo $emailError; ?></p>
            <!--User Password-->
            <label for="userPassword">Password</label>
            <br>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            <br>

            <!--Sign Up Button, move to user dashboard-->
            <input type="submit" value="Signup" class="button" />
            <br>
            <a href="user_login.php">Already have an account? Login here</a>
            <br>

            <?php

            if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {

                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = sha1($_POST["password"]);

                $result = pg_prepare(
                    $CONNECTION,
                    "check_username",
                    "SELECT * FROM users WHERE username=$1"
                );
                $params = array($username);
                $result = pg_execute($CONNECTION, "check_username", $params);
                $num_users = pg_num_rows($result);
                $_SESSION['usernameTaken'] = $num_users > 0;

                $result = pg_prepare(
                    $CONNECTION,
                    "check_email",
                    "SELECT * FROM users WHERE email=$1"
                );
                $params = array($email);
                $result = pg_execute($CONNECTION, "check_email", $params);
                $num_users = pg_num_rows($result);
                $_SESSION['emailTaken'] = $num_users > 0;


                if ($_SESSION['usernameTaken'] || $_SESSION['emailTaken']) {
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['email'] = $_POST['email'];
                    pg_close();
                    header('Location: user_register.php');
                } else {
                    $result = pg_prepare(
                        $CONNECTION,
                        "create_user",
                        "INSERT INTO users VALUES ($1, $2, $3, NOW(), NOW())"
                    );
                    $params = array($username, $email, $password);
                    $result = pg_execute($CONNECTION, "create_user", $params);
                    pg_close();
                    if (!$result) {
                        http_response_code(400);
                        echo json_encode(array("message" => "User creation failed!"));
                        exit;
                    } else {
                        header("Location: user_dashboard.php");
                    }
                }
            }
            ?>

        </form>
    </div>
</body>
</html>
