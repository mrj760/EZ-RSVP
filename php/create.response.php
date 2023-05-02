<?php
require_once('db.config.php');

// Validate request
if (!isset($_GET['optionID']) || !isset($_POST['email']) || !isset($_POST['text'])) {
    http_response_code(400);
    echo json_encode(array("message" => "Content can not be empty!"));
    exit;
}

$optionID = $_GET['optionID'];

//Create response array of required details
$RESPONSE = array(
    $optionID,
    $_POST['email'],
    $_POST['text']
);

// Prepare a SQL statement to insert the response into the database
$SQL = "INSERT INTO responses (\"optionID\", email, text) VALUES ($1, $2, $3)";

// Execute the SQL statement
$result = pg_query_params($CONNECTION, $SQL, $RESPONSE);

if (!$result) {
    http_response_code(500);
    echo json_encode(array("message" => "Error occurred while creating event: " . pg_last_error($CONNECTION)));
}

// Close the database connection
pg_close($CONNECTION);

header("Location: dashboard.php");
exit();

?>
