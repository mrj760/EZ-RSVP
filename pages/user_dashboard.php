<?php
require_once('../php/db.config.php');

// Start php session to store local data to be passed to next php pages
session_start();

if (!isset($_COOKIE['email'] || $_COOKIE['loggedin']) || $_COOKIE['loggedin'] == false) {
        header("Location: user_login.php");
    }

// Send a GET request to retrieve all events for user
$SQL = "SELECT * FROM events WHERE owner = '" . $_COOKIE['email'] . "'";
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
<html lang="en">

<head>
    <title>Event Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <?php
    require_once('../php/db.config.php');

    
    pg_prepare(
        $CONNECTION,
        "get_events",
        "SELECT * FROM events WHERE owner=$1"
    );
    $params = array($_COOKIE['email']);
    $result = pg_execute($CONNECTION, "get_events", $params);
    $events = pg_fetch_all($result);
    ?>
    <script type="text/javascript">
        let events = <?= json_encode($events)?>;
        localStorage.setItem('events', events);
    </script>
    <br>
    <h1 id="greeting"><?= 'Hello ' . $_COOKIE['username'] . '!' ?></h1>
    <a href="./rsvp.php"><button type="button" class="button">RSVP</button></a>
    <a href="./create_event.php"><button type="button" class="button">Create Event</button></a>
    <a href="./create_event_rsvp.php"><button type="button" class="button">Create Event RSVP</button></a>

    <div id="userEventsDiv">
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
    </div>

</body>

</html>
