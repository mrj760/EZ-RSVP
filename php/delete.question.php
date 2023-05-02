<?php
require_once('db.config.php');

if (!isset($_GET['questionID'])) {
    http_response_code(400);
    echo json_encode(array("message" => "questionID not set!"));
    exit;
}

$questionID = $_GET['questionID'];

$SQL = "DELETE FROM questions WHERE id = " . $questionID;
$result = pg_query($CONNECTION, $SQL);

if (!$result) {
    echo "Error deleting event: " . pg_last_error($CONNECTION);
    exit();
}

pg_close($CONNECTION);

header("Location: dashboard.php");
exit();

?>
