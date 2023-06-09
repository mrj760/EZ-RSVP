<?php
require_once('../php/db.config.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: user_login.php");
    exit();
}

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

if (!$result) {
    echo ("There was an issue accessing the database. Please try again later.");
    exit();
}

$events = pg_fetch_all($result);
if (count($events) < 1) {
    echo ("The given event ID does not exist");
    exit();
}

$event = $events[0];
$owner = $event['owner'];
$isOwner = $_SESSION['email'] == $owner;
if (!$isOwner) {
    echo ("You are not the owner of this event");
    exit();
}

?>

<script>
    let event = <?= json_encode($events) ?>;
    localStorage.setItem('event', JSON.stringify(event));
</script>

<?php

if (isset($_POST['save'])) {

    if (isset($_COOKIE['numQuestions'])) {
        $numQuestions = $_COOKIE['numQuestions'];

        for ($i = 1; $i <= $numQuestions; $i++) {

            //Handles each question
            if (isset($_POST['question' . $i])) {
                $question = $_POST['question' . $i];

                if (isset($_COOKIE['question' . $i . '-type'])) {
                    $questionType = $_COOKIE['question' . $i . '-type'];
                    //Create question
                    $qParams = array($question, $questionType, $eventID);
                    $qSQL = 'INSERT INTO questions (text, type, "eventID") VALUES ($1, $2, $3) RETURNING id';
                    pg_prepare($CONNECTION, 'create_question' . $i, $qSQL);
                    $qresult = pg_execute($CONNECTION, 'create_question' . $i, $qParams);
                    $questionID = pg_fetch_all($qresult);
                    $questionID = $questionID[0]['id'];

                    if ($questionType != 'text' && isset($_COOKIE['question' . $i . '-numOptions'])) {
                        $numOptions = $_COOKIE['question' . $i . '-numOptions'] - 1;

                        for ($j = 1; $j <= $numOptions; $j++) {

                            if (isset($_POST['question' . $i . '-option' . $j])) {
                                $option = $_POST['question' . $i . '-option' . $j];
                                //Create each option
                                $oParams = array($option, $questionID);
                                $oSQL = 'INSERT INTO options (description, "questionID") VALUES ($1, $2) RETURNING id';
                                pg_prepare($CONNECTION, 'create_option' . $i . $j, $oSQL);
                                $oresult = pg_execute($CONNECTION, 'create_option' . $i . $j, $oParams);
                            } //
                            else {
                                echo "Error: Unable to pull option data, numOptions: " . $numOptions;
                            }
                        }
                    } //
                    else {
                        // echo "Error: Number of options not set";
                    }
                } //
                else {
                    echo "Error: Question type not set";
                }
            } //
            else {
                echo "Question#" . $i . " not posted in form!";
            }
        }
    } //
    else {
        echo "Error: Number of questions not set";
    }
}
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
        <form action="" method="POST">
            <div id="customQuestionsDiv"></div>

            <div id="buttons">
                <br>
                <button id="newQuestionButton" class="button" type="button">New Question</button>
                <br>
                <button id="saveButton" class="button" type="submit" name="save">Save</button>
                <br>
                <a href="event_details.php?id=<?= $eventID ?>">
                    <button id="backButton" class="secondaryButton" type="button">Back</button>
                </a>
            </div>
        </form>
    </div>
</body>

</html>