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

            if (isset($_COOKIE['email']) && isset($_POST['eventname']) && isset($_POST['eventphoto']) && isset($_POST['eventdetails']) && isset($_POST['eventdate']) && isset($_POST['eventtime']) && isset($_POST['eventlocation'])){
                $EVENT = array(
                    $_COOKIE['email'],
                    $_POST['eventname'],
                    $_POST['eventphoto'],
                    $_POST['eventdetails'],
                    $_POST['eventdate'],
                    $_POST['eventtime'],
                    $_POST['eventlocation']
                );
                
                $SQL = "INSERT INTO events (owner, name, \"photoURL\", details, date, time, location) VALUES ($1, $2, $3, $4, $5, $6, $7)";

                $result = pg_query_params($CONNECTION, $SQL, $EVENT);
    
                if (!$result) {
                http_response_code(500);
                echo json_encode(array("message" => "Error occurred while creating event: " . pg_last_error($CONNECTION)));
                }
    
                pg_close($CONNECTION);
    
                // header("Location: dashboard.php");
                exit();
            } else {
                $Event = array("","","","","","","");
            }
            ?>
            <div>
                <label class="default">Event name:<br>
                    <input id="eventname" type="text" name="eventname" required="required">
                </label>
            </div>
            <div>
                <label class="default">Location:<br>
                    <input id="eventlocation" type="text" name="eventlocation" required="required">
                </label>
            </div>
            <div>
                <label class="default">Event Photo URL:<br>
                    <input id="eventphoto" type="text" name="eventphoto" required="required">
                </label>
            </div>
            <div>
                <label class="default">Date:<br>
                    <input id="eventdate" type="date" name="eventdate" required="required">
                </label>
            </div>
            <div>
                <label class="default">Time:<br>
                    <input id="eventtime" type="text" name="eventtime" required="required">
                </label>
            </div>
            <div>
                <label class="">Event Details
                    <br>
                    <textarea id="eventdetails" name="eventdetails" wrap="hard" rows="3" cols="30" required="required"></textarea>
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