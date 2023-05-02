<?php
require_once('db.config.php');

// Validate request
if (!isset($_GET['questionID']) || !isset($_POST['text'])) {
    http_response_code(400);
    echo json_encode(array("message" => "Content can not be empty!"));
    exit;
}

$questionID = $_GET['questionID'];

//Create option array of required details
$OPTION = array(
    $questionID,
    $_POST['text']
);

// Prepare a SQL statement to insert the option into the database
$SQL = "INSERT INTO options (\"questionID\", text) VALUES ($1, $2)";

// Execute the SQL statement
$result = pg_query_params($CONNECTION, $SQL, $OPTION);

if (!$result) {
    http_response_code(500);
    echo json_encode(array("message" => "Error occurred while creating event: " . pg_last_error($CONNECTION)));
}

// Close the database connection
pg_close($CONNECTION);

header("Location: dashboard.php");
exit();

?>
