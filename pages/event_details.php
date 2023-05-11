<?php
require_once('../php/db.config.php');

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
?>
<script>
    function confirmSubmit() {
        return confirm("Are you sure you want to Delete this Event?");
    }
    
    function editEvent() {
        return "";
    }
    
    let event = <?=json_encode($event)?>;
    localStorage.setItem('event', JSON.stringify(event));
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
            border: 1px solid red;
            border-radius: 15px;
            padding: 20px;
            overflow-y: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        #popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5em;
            cursor: pointer;
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
            <button type="submit" name="guests" onclick="viewGuests()">View Guest List</button>
            <button type="submit" name="edit" onclick="editEvent()">Edit Event</button>
            <form method="POST" action="" onsubmit="return confirmSubmit()">
                <button type="submit" name="delete" class="secondaryButton">Delete Event</button>
            </form>
        </div>
        <div id="popupBackground">
        <div id="guestListPopup" style="display: none;">
            <button id="closeButton" onclick="closePopup()">&times;</button>
            <h2>Guest List</h2>
            <ul>
                <li>Guest 1</li>
                <li>Guest 2</li>
                <li>Guest 3</li>
            </ul>
        </div>
    </div>
</body>
</html>
<script>
    let popupBackground = document.getElementById('popupBackground');
    let guestListPopup = document.getElementById('guestListPopup');

    function viewGuests() {
      popupBackground.style.display = 'flex';
      guestListPopup.style.display = 'flex';
    };
    
    function closePopup() {
      popupBackground.style.display = 'none';
      guestListPopup.style.display = 'none';
    }
</script>
