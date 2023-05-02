<?php
require_once('db.config.php');

if (!isset($_GET['responseID'])) {
    http_response_code(400);
    echo json_encode(array("message" => "responseID not set!"));
    exit;
}

$responseID = $_GET['responseID'];

$SQL = "DELETE FROM responses WHERE id = " . $responseID;
$result = pg_query($CONNECTION, $SQL);

if (!$result) {
    echo "Error deleting event: " . pg_last_error($CONNECTION);
    exit();
}

pg_close($CONNECTION);

header("Location: dashboard.php");
exit();

?>
