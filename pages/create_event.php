<!-- This page will allow the user to create a new event by providing 
    the event details such as the date, time, venue, and event description. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <div class="background">
        <h1>Create Event</h1>
        <form action="../php/create.event.php" method="POST">
            <div>
                <label class="default">Event name:<br>
                    <input id="eventName" type="text" name="eventName" required="required">
                </label>
            </div>
            <div>
                <label class="default">Location:<br>
                    <input id="eventLocation" type="text" name="eventLocation" required="required">
                </label>
            </div>
            <div>
                <label class="default">Event Photo URL:<br>
                    <input id="eventPhotoURL" type="text" name="eventPhotoURL" required="required">
                </label>
            </div>
            <div>
                <label class="default">Date:<br>
                    <input id="eventDate" type="date" name="eventDate" required="required">
                </label>
            </div>
            <div>
                <label class="default">Time:<br>
                    <input id="eventTime" type="text" name="eventTime" required="required">
                </label>
            </div>
            <div>
                <label class="">Event Details
                    <br>
                    <textarea id="eventDetails" name="eventDetails" wrap="hard" rows="3" cols="30" required="required"></textarea>
                </label>
            </div>
            <div id="buttons">
                <input type="submit" value="Create" class="button" onclick="saveCreatedEvent()">
                <input type="reset" value="Reset" class="secondaryButton">
            </div>
        </form>
    </div>
</body>

</html>