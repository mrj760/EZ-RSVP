<!-- This page will allow users to log in to their account. 
Also contains a link to the registration page. -->
<?php
require_once('../php/db.config.php');
session_set_cookie_params(259200);
session_start();

if (isset($_SESSION['email'])) {
    unset($_SESSION['email']);
    setcookie('loggedin', 0);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <div class="background">
        <h1>Login</h1>
        <form action-="user_login.php?" method="POST">
            <?php
            // Check is unnecessary. If this condition is met above then email is unset.
            // if (isset($_SESSION['email'])) {
            //     header("Location: user_dashboard.php");
            //     exit();
            // }

            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $result = pg_prepare(
                    $CONNECTION,
                    "check_credentials",
                    "SELECT username, email, password FROM users WHERE username=$1 OR email=$1"
                );
                $params = array($username);
                $result = pg_execute($CONNECTION, "check_credentials", $params);
                pg_close();

                if (!$result) {
                    http_response_code(400);
                    echo json_encode(array("message" => "User creation failed!"));
                    exit;
                }

                $numUsers = pg_num_rows($result);
                $userExists = $numUsers > 0;

                if ($userExists) {

                    $row = pg_fetch_row($result);

                    $passwordCorrect = password_verify($password, $row[2]);

                    if ($passwordCorrect) {
                        setcookie("loggedin", 1, time() + 259200);
                        $_SESSION['email'] = $row[1];
                        header("Location: user_dashboard.php");
                        exit();
                    } else {
                        $login_error = "There was an error with your login credentials.";
                    }
                } else {
                    $login_error = "There was an error with your login credentials.";
                }
            } else {
                $username = "";
                $login_error = "";
            }
            ?>
            <!--Username-->
            <label for="username">Username</label>
            <br>
            <input type="name" id="username" name="username" placeholder="Enter Username or Email" value="<?= $username ?>" required autofocus>
            <br>
            <!--User Password-->
            <label for="userPassword">Password</label>
            <br>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            <br>
            <!--Sign In Button, move to user dashboard-->
            <p id="loginError">
                <?= $login_error ?>
            </p>
            <input type="submit" value="Login" class="button">
            <br>
            <a href="#">Forgot Password</a>
            <br>
            <a href="user_register.php">Don't have an account? Signup here</a>
        </form>
    </div>
</body>

</html>