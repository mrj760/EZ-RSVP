<?php
require_once("../php/db.config.php");

session_start();
$_SESSION = array();
           
if isset($_POST["username"] && isset($_POST["userPassword"])) {
    $username = $_POST["username"];
    $password = sha1($_POST["userPassword"]);

    // table name
    $TableName = "users";

    // put id and password in array
    $params = array($username, $password);

    // check if id and password in table
    $sql = "SELECT * FROM $TableName WHERE email=$1 and password=$2;";
    $result = pg_prepare($CONNECTION, "", $sql);
    $result = pg_execute($CONNECTION, "", $params);
    $num_users = pg_num_rows($result);
    $_SESSION['loggedin'] = $num_users > 0; 

    pg_close($CONNECTION);
    
    // redirect to dashboard
    header("Location : user_dashboard.php");
    exit();
}

            
?>