<?php
require_once('../php/db.config.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: user_login.php");
    exit();
} 

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
$event = pg_fetch_all($result);

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
        window.location.assign("create_event.php?id=" + <?=$eventID?>);
    }
    
    let event = <?=json_encode($event)?>;
    let guests = <?=json_encode($guests)?>;
    localStorage.setItem('event', JSON.stringify(event));
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
    <style>        
        #popupBackground {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        #guestListPopup {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40%;
            height: 65%;
            background-color: white;
            border: 2px solid orange;
            border-radius: 15px;
            padding: 20px;
            overflow-y: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #closeButton {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5em;
            cursor: pointer;
        }
        
        #guestHeader {
            text-align: center;
        }
        
    </style>
</head>

<body>
    <div class="background">
        <div id="eventCoverPhoto" class="infoDiv"></div>
        <div id="eventName" class="infoDiv"></div>
        <div id="eventLocation" class="infoDiv"></div>
        <div id="eventDatetime" class="infoDiv"></div>
        <div id="eventDetails" class="infoDiv"></div>
        <div id="buttons" style="text-align: center;">
            <!-- View Guests Button -->
            <button id="guestListButton" class="button" type="button" name="guests">View Guest List</button>
            <a href="./create_event_rsvp.php?id=<?=$eventID?>"><button id="createRSVPButton" class="button" type="button" name="createRSVP">Create Event RSVP</button></a>
            <!-- Edit Button -->
            <script>
                function edit(eventID) {
                    location.href = 'create_event.php?id=' + eventID;
                }
            </script>
            <button id="editButton" class="button" type="button" name="edit" onclick="edit(<?=$eventID?>);">Edit Event</button>
            <!-- Delete Button -->
            <form method="POST" action="" onsubmit="return confirmSubmit()">
                <button id="deleteButton" class="secondaryButton" type="submit" name="delete">Delete Event</button>
            </form>
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
