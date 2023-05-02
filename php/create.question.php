<?php
require_once('db.config.php');

// Validate request
if (!isset($_GET['eventID']) || !isset($_POST['text']) || !isset($_POST['type'])) {
    http_response_code(400);
    echo json_encode(array("message" => "Content can not be empty!"));
    exit;
}

$eventID = $_GET['eventID'];

//Create question array of required details
$QUESTION = array(
    $eventID,
    $_POST['text'],
    $_POST['type']
);

// Prepare a SQL statement to insert the question into the database
$SQL = "INSERT INTO questions (\"eventID\", text, type) VALUES ($1, $2, $3)";

// Execute the SQL statement
$result = pg_query_params($CONNECTION, $SQL, $QUESTION);

if (!$result) {
    http_response_code(500);
    echo json_encode(array("message" => "Error occurred while creating event: " . pg_last_error($CONNECTION)));
}

// Close the database connection
pg_close($CONNECTION);

header("Location: dashboard.php");
exit();

?>
