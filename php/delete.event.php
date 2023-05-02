<?php
require_once('db.config.php');

if (!isset($_GET['eventID'])) {
    http_response_code(400);
    echo json_encode(array("message" => "eventID not set!"));
    exit;
}

$eventID = $_GET['eventID'];

$SQL = "DELETE FROM events WHERE id = " . $eventID;
$result = pg_query($CONNECTION, $SQL);

if (!$result) {
    echo "Error deleting event: " . pg_last_error($CONNECTION);
    exit();
}

pg_close($CONNECTION);

header("Location: dashboard.php");
exit();

?>
