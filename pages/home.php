<!DOCTYPE HTML>
<html lang="en">
<!-- This page will include a brief introduction to the site 
    and links to create an account or login. -->

<head>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>

<body>
    <div id="introDiv" class="fullscreenDiv">
        <div class="introTextContainer">
            <h1 class="leadingText">
                <bold>
                    Event Planning Made Simple. For Everyone.
                </bold>
            </h1>
        </div>

        <div id="getStartedButton" class="buttonDiv">
            <a href="user_register.php">
                <button type="button">Get Started For Free</button>
            </a>
        </div>
    </div>
    <div id="about" class="fullscreenDiv">
        <div id="textContainer2" class="introTextContainer">
            <h2>Collecting Event Information For Your Event's needs</h2>
            <p>
                EZ-RSVP aims to make your event run more smoothly by
                tracking reservations, guest logistics, and more!
            </p>
        </div>

        <div id="registerForFreeButton" class="buttonDiv">
            <a href="about.php">
                <button type="button">More About Us</button>
            </a>
        </div>
    </div>


</body>

</html>
