<?php
require_once('db.config.php');

// Validate request
if (!isset($_POST['username']) ||!isset($_POST['email']) || !isset($_POST['password'])) {
    http_response_code(400);
    echo json_encode(array("message" => "All User fields must be input!"));
    exit;
}

//Create event array of required details
$SIGNUP = array(
    $_POST['username'],
    $_POST['email'],
    $_POST['password']
);

// Prepare a SQL statement to insert the event into the database
$SQL = "CREATE INTO users (username, email, password) VALUES ($1, $2, $3)";

// Execute the SQL statement
$result = pg_query_params($CONNECTION, $SQL, $SIGNUP);

if (!$result) {
    http_response_code(500);
    echo json_encode(array("message" => "Error occurred while creating user: " . pg_last_error($CONNECTION)));
    pg_close($CONNECTION);
    exit;
} else {
    // Start php session to pull local data from prior php pages
    session_start();
    $_SESSION['userID'] = $_POST['email'];
  
    pg_close($CONNECTION);
   
    header("Location: dashboard.php");
    exit();
}  

?>
