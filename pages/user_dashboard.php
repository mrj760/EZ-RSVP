<!-- This page will display a list of events created by the user, 
    along with options to create new events or edit/delete existing ones. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <a href="./rsvp.php"><button type="button" class="button">RSVP</button></a>
    <a href="./create_event.php"><button type="button" class="button">Create Event</button></a>
    <a href="./create_event_rsvp.php"><button type="button" class="button">Create Event RSVP</button></a>

    <div id="userEventsDiv"></div>

</body>

</html>