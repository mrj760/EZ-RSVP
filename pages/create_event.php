<!-- This page will allow the user to create a new event by providing 
    the event details such as the date, time, venue, and event description. -->
<?php
require_once('../php/db.config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <?php
    // exit user if they are not logged in
    if (!isset($_SESSION['email'])) {
        header("Location: user_login.php");
        exit();
    }

    $isOwner = false;
    $eventID = $_GET['id'] ?? 'foo';
    $event = null;
    if ($eventID != 'foo') {
        pg_prepare(
            $CONNECTION,
            "check_owner",
            'SELECT * FROM events WHERE ID=$1'
        );
        $params = array($eventID);
        $result = pg_execute($CONNECTION, 'check_owner', $params);
        if (!$result) {
            echo ("There was an issue accessing the database. Please try again later.");
            exit();
        }
        $result = pg_fetch_all($result);
        if (count($result) < 1) {
            echo ("The given event ID does not exist");
            exit();
        }
        $event = $result[0];
        $owner = $event['owner'];
        $isOwner = $_SESSION['email'] == $owner;
        if (!$isOwner) {
            echo ("You are not the owner of this event");
            exit();
        }
        echo $event['name'];
    }

    ?>
    <div class="background">
        <h1>Create Event</h1>
        <form action="create_event.php?" method="POST">
            <?php

            if (
                isset($_SESSION['email']) && isset($_POST['eventname']) && isset($_POST['eventphoto']) && isset($_POST['eventdetails']) &&
                isset($_POST['eventdate']) && isset($_POST['eventtime']) && isset($_POST['eventlocation'])
            ) {
                $EVENT = array(
                    $_SESSION['email'],
                    $_POST['eventname'],
                    $_POST['eventphoto'],
                    $_POST['eventdetails'],
                    $_POST['eventdate'],
                    $_POST['eventtime'],
                    $_POST['eventlocation']
                );

                // Insert new event
                if ($event == null) {

                    pg_prepare(
                        $CONNECTION,
                        'insert_event',
                        "INSERT INTO events (owner, name, \"photoURL\", details, date, time, location) VALUES ($1, $2, $3, $4, $5, $6, $7)"
                    );

                    $result = pg_execute($CONNECTION, 'insert_event', $EVENT);

                    if (!$result) {
                        http_response_code(500);
                        echo json_encode(array("message" => "Error occurred while creating event: " . pg_last_error($CONNECTION)));
                    }
                    pg_close($CONNECTION);
                    header("Location: user_dashboard.php");
                    exit();
                }
                // Update existing event
                else {
                    pg_prepare(
                        $CONNECTION,
                        'update_event',
                        "UPDATE events set (name, photoURL, details, date, time, location) = ($1,$2,$3,$4,$5,$6) WHERE id=$7"
                    );
                    $params = array($EVENT[1], $EVENT[2], $EVENT[3], $EVENT[4], $EVENT[5], $EVENT[6], $eventID);
                    $result = pg_execute($CONNECTION, 'update_event', $params);
                    pg_close($CONNECTION);
                }
            }
            ?>
            <div>
                <label class="default">Event name:<br>
                    <input id="eventname" type="text" name="eventname" value="<?=$event['name'] ?? ''?>" required="required">
                </label>
            </div>
            <div>
                <label class="default">Location:<br>
                    <input id="eventlocation" type="text" name="eventlocation" value="<?=$event['location'] ?? ''?>" required="required">
                </label>
            </div>
            <div>
                <label class="default">Event Photo URL:<br>
                    <input id="eventphoto" type="text" name="eventphoto" value="<?=$event['photoURL'] ?? ''?>" required="required">
                </label>
            </div>
            <div>
                <label class="default">Date:<br>
                    <input id="eventdate" type="date" name="eventdate" value="<?=$event['date'] ?? ''?>" required="required">
                </label>
            </div>
            <div>
                <label class="default">Time:<br>
                    <input id="eventtime" type="text" name="eventtime" value="<?=$event['time'] ?? ''?>" required="required">
                </label>
            </div>
            <div>
                <label class="">Event Details<br>
                    <textarea id="eventdetails" name="eventdetails" wrap="hard" rows="3" cols="30" required="required"><?=$event['details'] ?? ''?></textarea>
                </label>
            </div>
            <div id="buttons">
                <input type="submit" value="Save" class="button">
                <input type="reset" value="Reset" class="secondaryButton">
            </div>
        </form>
    </div>
</body>

</html>