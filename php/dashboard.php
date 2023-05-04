<?php
require_once('db.config.php');

// Start php session to store local data to be passed to next php pages
session_start();

// Send a GET request to retrieve all events for user
$SQL = "SELECT * FROM events WHERE owner = '" . $_SESSION['userID'] . "'";
$result = pg_query($CONNECTION, $SQL);

// Check if the request was successful
if (!$result) {
    http_response_code(500);
    echo json_encode(array("message" => "Error occurred while retrieving events: " . pg_last_error($CONNECTION)));
    exit;
}

// Fetch all events as an array
$events = pg_fetch_all($result);

// Close the database connection
pg_close($CONNECTION);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Dashboard</title>
</head>
<body>
    <h1>Event Dashboard</h1>
    <h3>Sample Dashboard for User: testUser2@ez-rsvp.com</h3>
    <button onclick="window.location.href='event.php'">Test Event Creation</button>
	<br>
    <table border="1">
        <tr>
            <th>Owner</th>
            <th>Name</th>
            <th>Details</th>
            <th>Date</th>
            <th>Time</th>
            <th>Location</th>
            <th>Photo URL</th>
	    <th>View</th>	
        </tr>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?php echo $event['owner']; ?></td>
                <td><?php echo $event['name']; ?></td>
                <td><?php echo $event['details']; ?></td>
                <td><?php echo $event['date']; ?></td>
                <td><?php echo $event['time']; ?></td>
                <td><?php echo $event['location']; ?></td>
                <td><?php echo $event['photoURL']; ?></td>
		<td><a href="view.event.php?eventID=<?php echo $event['id']; ?>">View</a></td>
		<td><a href="delete.event.php?eventID=<?php echo $event['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
