<?php
require_once('../php/db.config.php');
session_start();
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
    if (!isset($_SESSION['email']))
    {
        header("Location: user_login.php");
    }

    pg_prepare(
        $CONNECTION,
        "get_events",
        "SELECT * FROM events WHERE owner=$1"
    );
    $params = array($_SESSION['email']);
    $result = pg_execute($CONNECTION, "get_events", $params);
    // Check if the request was successful
    if (!$result) {
        http_response_code(500);
        echo json_encode(array("message" => "Error occurred while retrieving events: " . pg_last_error($CONNECTION)));
        exit;
    }
    $events = pg_fetch_all($result);
    pg_close($CONNECTION);
    ?>
    <script type="text/javascript">
        let events = <?= json_encode($events)?>;
        localStorage.setItem('events', JSON.stringify(events));
    </script>
    <br>
    <h1 id="greeting"><?= 'Hello ' . $_SESSION['email'] . '!' ?></h1>
    <a href="./rsvp.php"><button type="button" class="button">RSVP</button></a>
    <a href="./create_event.php"><button type="button" class="button">Create Event</button></a>
    <!-- <a href="./create_event_rsvp.php"><button type="button" class="button">Create Event RSVP</button></a> -->

    <div id="userEventsDiv"></div>

</body>

</html>
