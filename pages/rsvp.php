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

            <h1>RSVP for: &ltEvent Name&gt </h1>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <?php
            require_once("../php/db.config.php");
            session_start();

           $eventid = 30;

            if (isset($_POST['name']) && isset($_POST['email'])){

               $GUEST = array(
                $eventid,
                $_POST['name'],
                $_POST['email']
               );


                $sql = "INSERT INTO guests (eventid, guestname, guestemail) VALUES ($1, $2, $3)";

                $result = pg_query_params($CONNECTION, $sql, $GUEST);

                // error: fail to respond
                if (!$result){
                    http_reponse_code(400);
                    echo json_encode(array("message" => "Response failed!"));
                    exit;
                }
                
                pg_close($CONNECTION);

                // success: redirect to confirmation page
                header("Location : rsvp_confirmation.php");
                exit();
            }

            ?>

            <label for="name">Name</label><br>
            <input id="nameTextBox" class="textBox" type="text" name="name" title="name" placeholder="John Smith" />
            <br>
            <label for="email">Email</label><br>
            <input id="emailTextBox" class="textBox" type="text" name="email" title="email" placeholder="JohnSmith@mail.com" />

            <div id="additionalDetails"></div>

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