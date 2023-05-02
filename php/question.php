<?php

if (!isset($_GET['eventID'])) {
    http_response_code(400);
    echo json_encode(array("message" => "No event ID passed!"));
    exit;
}

$eventID = $_GET['eventID'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Question Form</title>
</head>
<body>
	<h1>Create Question Form</h1>
	<form method="POST" action="create.question.php?eventID=<?php echo $eventID; ?>">
		<label for="text">Question Text:</label><br>
		<input type="text" id="text" name="text" required><br>

		<label for="type">Question Type:</label><br>
		<input type="text" id="type" name="type" required><br>

		<input type="submit" value="Create Question">
	</form>
</body>
</html>
