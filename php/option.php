<?php

if (!isset($_GET['questionID'])) {
    http_response_code(400);
    echo json_encode(array("message" => "No event ID passed!"));
    exit;
}

$questionID = $_GET['questionID'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Option Form</title>
</head>
<body>
	<h1>Create Option Form</h1>
	<form method="POST" action="create.option.php?questionID=<?php echo $questionID; ?>">
		<label for="text">Option Text:</label><br>
		<input type="text" id="text" name="text" required><br>

		<input type="submit" value="Create Option">
	</form>
</body>
</html>
