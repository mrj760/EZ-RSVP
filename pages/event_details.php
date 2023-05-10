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
    </div>
    <div>
        <?php
        // check user log in
        if (isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == true) { 
        ?>
        <script>
            function delete_event(){
                if (confirm("Are you sure to delete event?")){
                    window.location = "../delete.event.php?eventname=<?=json_encode($event)?>";
                }
            }
        </script>
        <button type="button" class="button" onclick="delete_event();">Delete Event</button>
        <?php } ?>
        
    </div>
</body>

</html>