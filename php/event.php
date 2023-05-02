<!DOCTYPE html>
<html>
<head>
	<title>Create Event</title>
</head>
<body>
	<h1>Create Event</h1>
	<form action="create.event.php" method="POST">
		<label for="name">Event Name:</label>
		<input type="text" name="name" required><br><br>
		<label for="photoURL">Photo URL:</label>
		<input type="text" name="photoURL" required><br><br>
		<label for="details">Details:</label>
		<textarea name="details" required></textarea><br><br>
		<label for="date">Date:</label>
		<input type="date" name="date" required><br><br>
		<label for="time">Time:</label>
		<input type="time" name="time" required><br><br>
		<label for="location">Location:</label>
		<input type="text" name="location" required><br><br>
		<input type="submit" onclick="window.location.href='dashboard.php'" value="Create Event">
	</form>
</body>
</html>
