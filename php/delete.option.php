<?php
require_once('db.config.php');

if (!isset($_GET['optionID'])) {
    http_response_code(400);
    echo json_encode(array("message" => "optionID not set!"));
    exit;
}

$optionID = $_GET['optionID'];

$SQL = "DELETE FROM options WHERE id = " . $optionID;
$result = pg_query($CONNECTION, $SQL);

if (!$result) {
    echo "Error deleting event: " . pg_last_error($CONNECTION);
    exit();
}

pg_close($CONNECTION);

header("Location: dashboard.php");
exit();

?>
