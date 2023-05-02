<?php

if (!isset($_GET['optionID'])) {
    http_response_code(400);
    echo json_encode(array("message" => "No event ID passed!"));
    exit;
}

$optionID = $_GET['optionID'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Response Form</title>
</head>
<body>
	<h1>Create Response Form</h1>
	<form method="POST" action="create.response.php?optionID=<?php echo $optionID; ?>">
		<label for="email">Email:</label><br>
		<input type="text" id="email" name="email" required><br>

		<label for="text">Respone Text:</label><br>
		<input type="text" id="text" name="text" required><br>

		<input type="submit" value="Create Response">
	</form>
</body>
</html>
