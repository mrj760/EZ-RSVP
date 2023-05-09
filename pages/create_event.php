<!-- This page will allow the user to create a new event by providing 
    the event details such as the date, time, venue, and event description. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <?php
    // exit user if they are not logged in
    if (!isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == false){
        exit("You should log in to create event.");
    }
    ?>
    <div class="background">
        <h1>Create Event</h1>
        <form action="create_event.php?" method="POST">
            <?php
            require_once("../php/db.config.php");
            session_start();
            
            if (!isset($_COOKIE['email']) ||!isset($_POST['eventName']) || !isset($_POST['eventPhotoURL']) || !isset($_POST['eventDetails']) || !isset($_POST['eventDate']) || !isset($_POST['eventTime']) || !isset($_POST['eventLocation'])) {
                http_response_code(400);
                echo ($_COOKIE['email']);
                print_r($_COOKIE);
                echo json_encode(array("message" => 'You should fill up required values'));
                exit;
            }

            $EVENT = array(
                $_COOKIE['email'],
                $_POST['eventName'],
                $_POST['eventPhotoURL'],
                $_POST['eventDetails'],
                $_POST['eventDate'],
                $_POST['eventTime'],
                $_POST['eventLocation']
            );

            $SQL = "INSERT INTO events (owner, name, \"photoURL\", details, date, time, location) VALUES ($1, $2, $3, $4, $5, $6, $7)";

            $result = pg_query_params($CONNECTION, $SQL, $EVENT);

            if (!$result) {
            http_response_code(500);
            echo json_encode(array("message" => "Error occurred while creating event: " . pg_last_error($CONNECTION)));
            }

            pg_close($CONNECTION);

            header("Location: dashboard.php");
            exit();
            ?>
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
                <input type="submit" value="Create" class="button" >
                <input type="reset" value="Reset" class="secondaryButton">
            </div>
        </form>
    </div>
</body>

</html>