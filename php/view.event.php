<?php
require_once('db.config.php');

if (!isset($_GET['eventID'])) {
    http_response_code(400);
    echo json_encode(array("message" => "No event ID passed!"));
    exit;
}

$eventID = $_GET['eventID'];
$SQLevent = "SELECT * FROM events WHERE id = " . $eventID;
$SQLquestions = "SELECT * FROM questions WHERE \"eventID\" = " . $eventID;
$SQLoptions = "SELECT * FROM options WHERE \"questionID\" IN (SELECT id FROM questions WHERE \"eventID\" = " . $eventID . ")";
$SQLresponses = "SELECT * FROM responses WHERE \"optionID\" IN (SELECT id FROM options WHERE \"questionID\" IN (SELECT id FROM questions WHERE \"eventID\" = " . $eventID . "))";

$eventResults = pg_query($CONNECTION, $SQLevent);
$questionResults = pg_query($CONNECTION, $SQLquestions);
$optionResults = pg_query($CONNECTION, $SQLoptions);
$responseResults = pg_query($CONNECTION, $SQLresponses);

$eventData = pg_fetch_all($eventResults);
$questionData = pg_fetch_all($questionResults);
$optionData = pg_fetch_all($optionResults);
$responseData = pg_fetch_all($responseResults);

// Display the event data
echo "<img src='https://i.imgur.com/5jL7UUO.jpeg' alt='event image'>";
echo "<h1>Event: " . $eventData[0]['name'] . "</h1>";
echo "<p><b>Details:</b> " . $eventData[0]['details'] . "</p>";
echo "<p><b>Date:</b> " . $eventData[0]['date'] . "</p>";
echo "<p><b>Time:</b> " . $eventData[0]['time'] . "</p>";
echo "<p><b>Location:</b> " . $eventData[0]['location'] . "</p>";
echo "<br>";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Event View</title>
</head>
<body>
    <button onclick="window.location.href='question.php?eventID=<?php echo $eventID; ?>'">Create Question</button>
    <br>
	
    <h2>Questions</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Text</th>
            <th>Type</th>
        </tr>
        <?php foreach ($questionData as $question): ?>
            <tr>
                <td><?php echo $question['id']; ?></td>
                <td><?php echo $question['text']; ?></td>
                <td><?php echo $question['type']; ?></td>
		<td><a href="option.php?questionID=<?php echo $question['id']; ?>">Create Option</a></td>
		<td><a href="update.question.php?questionID=<?php echo $question['id']; ?>">Update</a></td>
		<td><a href="delete.question.php?questionID=<?php echo $question['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <h2>Options</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Text</th>
            <th>QuestionID</th>
        </tr>
        <?php foreach ($optionData as $option): ?>
            <tr>
                <td><?php echo $option['id']; ?></td>
                <td><?php echo $option['text']; ?></td>
                <td><?php echo $option['questionID']; ?></td>
		<td><a href="response.php?optionID=<?php echo $option['id']; ?>">Create Response</a></td>
		<td><a href="update.option.php?optionID=<?php echo $option['id']; ?>">Update</a></td>
		<td><a href="delete.option.php?optionID=<?php echo $option['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <h2>Responses</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Text</th>
            <th>OptionID</th>
        </tr>
        <?php foreach ($responseData as $response): ?>
            <tr>
                <td><?php echo $response['id']; ?></td>
                <td><?php echo $response['email']; ?></td>
                <td><?php echo $response['text']; ?></td>
                <td><?php echo $response['optionID']; ?></td>
		<td><a href="update.response.php?responseID=<?php echo $response['id']; ?>">Update</a></td>
		<td><a href="delete.response.php?responseID=<?php echo $response['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
