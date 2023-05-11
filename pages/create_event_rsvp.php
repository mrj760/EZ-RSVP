<script>
    let event = JSON.parse(localStorage.getItem('event'));
    console.log(event);
    document.cookie = "selectedEvent" + JSON.stringify(event);
</script>
<?php
require_once('../php/db.config.php');

$selectedEvent = $_COOKIE['selectedEvent'];
$event = json_decode($selectedEvent);
echo "Event ID: " . $event.id;
?>

<!DOCTYPE html>
<html lang="en">
<!-- This page is a form that the event creator can customize 
        to collect information that may be important for the event. -->

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>

    <div class="background">
        <h1>
            Collect Information to Serve Your Event's Attendees.
        </h1>

        <h1 id="eventName"></h1>
        <br>
        <label for="email">
            Email:<br>
            <input type="email" name="email" placeholder="johnsmith@email.com" disabled>
        </label>
        <br>
        <label for="name">
            Full Name:<br>
            <input type="name" name="name" placeholder="John Smith" disabled>
        </label>
        <br>

        <div id="customQuestionsDiv"></div>

        <div id="buttons">
            <br>
            <button id="newQuestionButton" class="button" type="button">New Question</button>
            <br>
            <button id="saveButton" class="button" type="button">Save</button>
            <button id="backButton" class="secondaryButton" type="button">Back</button>
        </div>
    </div>
</body>

</html>
