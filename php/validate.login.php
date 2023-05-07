<?php
require_once("../php/db.config.php");

session_start();
$_SESSION = array();
           
if isset($_POST["username"] && isset($_POST["userPassword"])) {
    $username = $_POST["username"];
    $password = sha1($_POST["userPassword"]);

    $TableName = "users";
    $params = array($username, $password);

    $sql = "SELECT * FROM $TableName WHERE email=$1 and password=$2;";
    $result = pg_prepare($CONNECTION, "", $sql);
    $result = pg_execute($CONNECTION, "", $params);
}

            
?>