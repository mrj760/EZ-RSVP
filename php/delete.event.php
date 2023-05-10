<?php
require_once('db.config.php');


if (!isset($_GET['event'] || $_COOKIE['loggedin'] == false)) {
    http_response_code(400);
    echo json_encode(array("message" => "eventID not set!"));
    exit;
}

// $eventID = $_GET['eventID'];

$event = $_GET['event'];

$SQL = "DELETE FROM events WHERE name = "$event['name'];
$result = pg_query($CONNECTION, $SQL);

if (!$result) {
    echo "Error deleting event: " . pg_last_error($CONNECTION);
    exit();
}

pg_close($CONNECTION);

header("Location: dashboard.php");
exit();

?>
