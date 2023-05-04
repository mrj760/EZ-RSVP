<?php require_once('db.config.php');

// Start php session to pull local data from prior php pages
session_start();

// Validate request
if (!isset($_SESSION['userID']) ||!isset($_POST['name']) || !isset($_POST['photoURL']) || !isset($_POST['details']) || !isset($_POST['date']) || !isset($_POST['time']) || !isset($_POST['location'])) {
    http_response_code(400);
    echo json_encode(array("message" => "Content can not be empty!"));
    exit;
}

//Create event array of required details
$EVENT = array(
    $_SESSION['userID'],
    $_POST['name'],
    $_POST['photoURL'],
    $_POST['details'],
    $_POST['date'],
    $_POST['time'],
    $_POST['location']
);

// Prepare a SQL statement to insert the event into the database
$SQL = "INSERT INTO events (owner, name, \"photoURL\", details, date, time, location) VALUES ($1, $2, $3, $4, $5, $6, $7)";

// Execute the SQL statement
$result = pg_query_params($CONNECTION, $SQL, $EVENT);

if (!$result) {
    http_response_code(500);
    echo json_encode(array("message" => "Error occurred while creating event: " . pg_last_error($CONNECTION)));
}

// Close the database connection
pg_close($CONNECTION);

header("Location: dashboard.php");
exit();

?>
