<?php
require_once('../php/db.config.php');
session_start();

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(array("message" => "eventID not set!"));
    exit;
}
$eventID = $_GET['id'];
$params = array($eventID);
$SQL = "SELECT * FROM events WHERE id=$1";
pg_prepare($CONNECTION, 'get_event', $SQL);
$result = pg_execute($CONNECTION, 'get_event', $params);

if (!$result) {
    echo ("There was an issue accessing the database. Please try again later.");
    exit();
}

$events = pg_fetch_all($result);
if (count($events) < 1) {
    echo ("The given event does not exist");
    exit();
}

if (!isset($_SESSION['email'])) {
    $isOwner = false;
} else {
    $isOwner = $_SESSION['email'] == $events[0]['owner'];
}

$SQL = "SELECT * FROM guests WHERE eventID=$1";
pg_prepare($CONNECTION, 'get_guests', $SQL);
$guestResult = pg_execute($CONNECTION, 'get_guests', $params);
$guests = pg_fetch_all($guestResult);
?>
<script>
    function confirmSubmit() {
        return confirm("Are you sure you want to Delete this Event?");
    }

    function editEvent() {
        window.location.assign("create_event.php?id=" + <?= $eventID ?>);
    }

    let events = <?= json_encode($events) ?>;
    let guests = <?= json_encode($guests) ?>;
    localStorage.setItem('event', JSON.stringify(events));
    localStorage.setItem('guests', JSON.stringify(guests));
</script>
<?php
if (isset($_POST['delete'])) {

    $SQL = "DELETE FROM events WHERE id = $1";
    pg_prepare($CONNECTION, 'delete_event', $SQL);
    $result = pg_execute($CONNECTION, 'delete_event', $params);

    if (!$result) {
        echo "Error deleting event: " . pg_last_error($CONNECTION);
        exit();
    }

    pg_close($CONNECTION);

    header("Location: user_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>

    <script>
        function edit(eventID) {
            location.href = 'create_event.php?id=' + eventID;
        }
    </script>
    <div class="background">
        <div id="eventCoverPhoto" class="infoDiv"></div>
        <div id="eventName" class="infoDiv"></div>
        <div id="eventLocation" class="infoDiv"></div>
        <div id="eventDatetime" class="infoDiv"></div>
        <div id="eventDetails" class="infoDiv"></div>
        <div id="buttons" style="text-align: center;">
            <?php if ($isOwner) { ?>
                <button id="guestListButton" class="button" type="button" name="guests">View Guest List</button>
                <a href="./create_event_rsvp.php?id=<?= $eventID ?>"><button id="createRSVPButton" class="button" type="button" name="createRSVP">Create Event RSVP</button></a>
                <button id="editButton" class="button" type="button" name="edit" onclick="edit(<?= $eventID ?>);">Edit Event</button>
                <form method="POST" action"./rsvp.php?id=<?=$eventID?>">
                    <button id="rsvpButton" class="button" type="button" name="rsvp">Temp RSVP</button>
                </form>
                <form method="POST" action="" onsubmit="return confirmSubmit()">
                    <button id="deleteButton" class="secondaryButton" type="submit" name="delete">Delete Event</button>
                </form>
            <?php } else { ?>
                <a href="rsvp.php?id=<?= $eventID ?>" >
                    <button id="rsvpButton" class="button" type="button" name="rsvp">RSVP</button>
                </a>
            <?php }
            ?>
        </div>
        <div id="popupBackground">
            <div id="guestListPopup">
                <span id="closeButton">&times;</span>
                <h2 id="guestHeader">Guest List</h2>
                <ul id="guestList" class="list-group">

                </ul>
            </div>
        </div>
    </div>
</body>

</html>
