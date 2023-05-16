<!DOCTYPE HTML>
<!-- This page is a form created by the event creator 
    to collect information necessary for the event. 
    Details will include name and email address of guest, 
    with optional further details specified by event organizer -->

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>

    <div class="center">
        <!-- Add additional details here via JS.
            These are details laid out by the event creator. -->
        <div id="inputContainer" class="background">
            <?php
            require_once("../php/db.config.php");

            if (!isset($_GET['id'])) {
                http_response_code(400);
                echo json_encode(array("message" => "eventID not set!"));
                exit;
            }
            $eventID = $_GET['id'];

            $params = array($eventid);
            $sql = "SELECT * FROM events WHERE id=$1";
            pg_prepare($CONNECTION, 'check_owner', $sql);
            $result = pg_execute($CONNECTION, 'check_owner', $params);

            if(!$result){
                echo "Fail to get event id.";
                exit();
            }

             // fetch event name
             $eventid = pg_fetch_all($result);

             if(count($result) < 1) {
                echo("The given event ID does not exist");
                exit();
             }

             $event = $result[0];
             $owner = $event['owner'];
             $isOwner = $_SESSION['email'] == $owner;
             if (!isOwner) {
                echo ("You are not the owner of this event");
                exit();
             }
            ?>

            <script type="text/javascript">
            let event = <?= json_encode($events) ?>;
            localStorage.setItem('event', JSON.stringify(event));
            </script>

            <h1>RSVP for: <?= $event['name']?> </h1>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <?php

            // now we get the name and email from form
            if (isset($_POST['name']) && isset($_POST['email'])){

               $GUEST = array(
                $event,
                $_POST['name'],
                $_POST['email']
               );

                $sql = "INSERT INTO guests (eventid, guestname, guestemail) VALUES ($1, $2, $3)";
                $result = pg_query_params($CONNECTION, $sql, $GUEST);
                pg_close($CONNECTION);

                // error: fail to respond
                if (!$result){
                    http_response_code(400);
                    echo json_encode(array("message" => "Response failed!"));
                    exit;
                }

                // success: redirect to confirmation page
                header("Location: rsvp_confirmation.php");
                exit();
            }

            ?>

            <label for="name">Name</label><br>
            <input id="nameTextBox" class="textBox" type="text" name="name" title="name" placeholder="John Smith" />
            <br>
            <label for="email">Email</label><br>
            <input id="emailTextBox" class="textBox" type="text" name="email" title="email" placeholder="JohnSmith@mail.com" />

            <div id="additionalQuestions"></div>

            <canvas id="captcha"></canvas>
            <br>
            <br>
            <label for="captcha">Captcha</label>
            <br>
            <input id="captchaTextBox" class="textBox" type="text" name="captcha" title="text" placeholder="Enter CAPTCHA" />

            <div id="buttons">

                <button id="submitButton" class="secondaryButton" type="button">Submit Captcha</button>
                <button id="refreshButton" class="secondaryButton" type="button">Refresh Captcha</button>
                <br>
                <input type="submit" value="Confirm" class="button">
            </div>

            <div id="captchaOutput"></div>

        </div>
    </form>

    </div>

</body>