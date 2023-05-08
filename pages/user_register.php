<!-- This page will allow new users to create an account by providing 
their name, email address, and a password. 
Also contains a link to the login page. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <div class="background">
        <h1>Signup</h1>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

            <?php
            require_once("../php/db.config.php");
            session_start();

            if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {

                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                $result = pg_prepare(
                    $CONNECTION,
                    "check_username",
                    "SELECT * FROM users WHERE username=$1"
                );
                $params = array($username);
                $result = pg_execute($CONNECTION, "check_username", $params);
                $numUsers = pg_num_rows($result);
                $usernameTaken = $numUsers > 0;

                $result = pg_prepare(
                    $CONNECTION,
                    "check_email",
                    "SELECT * FROM users WHERE email=$1"
                );
                $params = array($email);
                $result = pg_execute($CONNECTION, "check_email", $params);
                $numUsers = pg_num_rows($result);
                $emailTaken = $numUsers > 0;

                if ($usernameTaken || $emailTaken) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    pg_close();
                    // header('Location: user_register.php');
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
                        setcookie("loggedin", true, time() + (86400) * 30);
                        setcookie("username", $username, time() + (86400) * 30);
                        header("Location: user_dashboard.php");
                    }
                }
            }
            else {
                $username = "";
                $email = "";
                $usernameTaken = false;
                $emailTaken = false;
            }
            ?>

            <!--Username-->
            <label for="username" class="lable">Username</label>
            <br>
            <input type="name" id="username" name="username" placeholder="Enter Username" value="<?= $username; ?>" required autofocus>
            <p id="usernameError"><?= $usernameTaken ? "Username taken... Retry" : ""; ?></p>

            <!--Email-->
            <label for="email">Email</label>
            <br>
            <input type="email" id="email" name="email" placeholder="Enter Email" value="<?= $email; ?>" required>
            <p id="emailError"><?= $emailTaken ? "Email taken... Retry" : ""; ?></p>

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
        </form>
    </div>
</body>

</html>