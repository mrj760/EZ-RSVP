<?php
require_once("../php/db.config.php");

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(array("message" => "eventID not set!"));
    exit;
}

$eventID = $_GET['id'];
$params = array($eventID);
$SQL = "SELECT * FROM events WHERE id=$1";
pg_prepare($CONNECTION, 'get_event', $SQL);
$result = pg_execute($CONNECTION, 'get_event', $params);

if(!$result){
    echo "Failed to pull event from db with ID: " . $eventID;
    exit;
}

$SQLquestions = "SELECT * FROM questions WHERE \"eventID\" = $1";
$SQLoptions = "SELECT * FROM options WHERE \"questionID\" IN (SELECT id FROM questions WHERE \"eventID\" = $1)";
pg_prepare($CONNECTION, 'get_questions', $SQLquestions);
pg_prepare($CONNECTION, 'get_options', $SQLoptions);
$resultQuestions = pg_execute($CONNECTION, 'get_questions', $params);
$resultOptions = pg_execute($CONNECTION, 'get_options', $params);

$event = pg_fetch_all($result);
$event = $event[0];
$questions = pg_fetch_all($resultQuestions);
$options = pg_fetch_all($resultOptions);

$eventname = $event['name'];
var_dump($questions);
?>
<script>
    // put the event, questions & options in local storage
    let event = <?= json_encode($event)?>;
    let questions = <?= json_encode($questions)?>;
    let options = <?= json_encode($options)?>;
    localStorage.setItem('event', JSON.stringify(event));
    localStorage.setItem('questions', JSON.stringify(questions));
    localStorage.setItem('options', JSON.stringify(options));
</script>
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
            <h1>RSVP for: <?= $eventname ?> </h1>
            <form action="" method="POST">

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
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// now we get the name and email from form
if (isset($_POST['name']) && isset($_POST['email'])){

   $GUEST = array(
    $eventID,
    $_POST['name'],
    $_POST['email']
   );

    $sql = "INSERT INTO guests (eventid, guestname, guestemail) VALUES ($1, $2, $3) RETURNING id";
    $result = pg_query_params($CONNECTION, $sql, $GUEST);

    // error: failed to create guest
    if (!$result){
        http_response_code(400);
        echo json_encode(array("message" => "Failed to create Guest!"));
        exit;
    } else {
        $guest = pg_fetch_assoc($result);
        $guestID = $guest['id'];
    }

    //Check for text questions and create option
    foreach ($questions as $q) {
        $questionID = $q['id'];
        $questionType = $q['type'];
        if ($questionType == 'text') {
            //Create new option for response
            $optionParams = array($questionID, "For text responses");
            $SQLnewOption = "INSERT INTO options (\"questionID\", description) VALUES ($1, $2) RETURNING id";
            $optionResult = pg_query_params($CONNECTION, $SQLnewOption, $optionParams);

            if (!$optionResult){
                http_response_code(400);
                echo json_encode(array("message" => "Failed to create Option!"));
                exit;
            } else {
                $newOption = pg_fetch_assoc($optionResult);
                $newOptionID = $newOption['id'];
            }

            if (isset($_POST[$questionID])) {
                $responseParams = array($guestID, $questionID, $newOptionID, $_POST[$questionID]);
                $SQLresponse = "INSERT INTO responses (guestid, questionid, optionid, text) VALUES ($1, $2, $3, $4)";
                $responseResult = pg_query_params($CONNECTION, $SQLresponse, $responseParams);
            }
        } else { 
            //Create Responses
            if (isset($_POST[$questionID])) { 
                $value = $_POST[$questionID];
                $parts = explode('-', $value);
                $optionID = $parts[0];
                $optionType = $parts[1];
                if ($optionType == 'radio') {
                    $responseParams = array($guestID, $questionID, $optionID);
                    $SQLresponse = "INSERT INTO responses (guestid, questionid, optionid) VALUES ($1, $2, $3)";
                    $responseResult = pg_query_params($CONNECTION, $SQLresponse, $responseParams);
                } else {
                    foreach ($value as $v) {
                        $responseParams = array($guestID, $questionID, );
                        $SQLresponse = "INSERT INTO responses (guestid, questionid, optionid) VALUES ($1, $2, $3)";
                        $responseResult = pg_query_params($CONNECTION, $SQLresponse, $responseParams);
                    }
                }
            }
        }
    }

    pg_close($CONNECTION);
    // success: redirect to confirmation page
    header("Location: rsvp_confirmation.php");
    exit();
}
}
?>
