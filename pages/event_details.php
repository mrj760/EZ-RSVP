<!DOCTYPE html>

<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <?php 
    // print_r($_GET['id']);
    require_once('../php/db.config.php');
    $id = $_GET['id'];
    $result = pg_query(
        $CONNECTION,
        "SELECT * FROM events WHERE id=$id" );
    $event = pg_fetch_all($result)[0];
    
    function deleteEvent(){ 
    if (!isset($_GET['event'] || $_COOKIE['loggedin'] == false)) {
        http_response_code(400);
        echo json_encode(array("message" => "eventID not set!"));
        exit;
    }
    
        $eventID = $_GET['eventID'];

        $SQL = "DELETE FROM events WHERE name = "$eventID;
        $result = pg_query($CONNECTION, $SQL);
    
        if (!$result) {
            echo "Error deleting event: " . pg_last_error($CONNECTION);
            exit();
        }
    
        pg_close($CONNECTION);
    
        header("Location: dashboard.php");
        exit();
    }
    
    ?>
    <script>
        let event = <?=json_encode($event)?>;
        console.log(event);
        localStorage.setItem('event', JSON.stringify(event));
    </script>
    <div class="background">
        <div id="eventName" class="infoDiv"></div>
        <div id="outerEventCoverPhotoDiv">
            <div id="eventCoverPhoto" class="infoDiv"></div>
        </div>
        <div id="eventDetails" class="infoDiv"></div>
        <div id="eventLocation" class="infoDiv"></div>
        <div id="eventDatetime" class="infoDiv"></div>
        <div id="buttons"></div>
        <?php
        // check user log in
        if (isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == true) { 
        ?>
        <button type="button" class="button" style="margin:auto; display:block;" onclick="">Delete Event</button>
        <?php } ?>
    </div>
</body>

</html>