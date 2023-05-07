<?php
// manual to destory the session
session_start();
session_destroy();

// redirect to the login page
header("location:user_login.php");
?>
