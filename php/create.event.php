<?php require_once('db.config.php');

// Start php session to pull local data from prior php pages
session_start();

// Validate request
if (!isset($_COOKIE['email']) ||!isset($_POST['eventName']) || !isset($_POST['eventPhotoURL']) || !isset($_POST['eventDetails']) || !isset($_POST['eventDate']) || !isset($_POST['eventTime']) || !isset($_POST['eventLocation'])) {
    http_response_code(400);
    echo ($_COOKIE['username']);
    print_r($_COOKIE);
    echo json_encode(array("message" => 'You should fill up required values'));
    exit;
}

//Create event array of required details
$EVENT = array(
    $_COOKIE['email'],
    $_POST['eventName'],
    $_POST['eventPhotoURL'],
    $_POST['eventDetails'],
    $_POST['eventDate'],
    $_POST['eventTime'],
    $_POST['eventLocation']
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
