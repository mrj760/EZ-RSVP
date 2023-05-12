<?php
require_once('../php/db.config.php');

$eventID = 30;
$params = array($eventID);
$SQL = "SELECT * FROM events WHERE id=$1";
pg_prepare($CONNECTION, 'get_event', $SQL);
$result = pg_execute($CONNECTION, 'get_event', $params);
$event = pg_fetch_all($result);
?>
<script>
    let event = <?=json_encode($event)?>;
    localStorage.setItem('event', JSON.stringify(event));
</script>
<?php
if (isset($_POST['save'])) {
    if (isset($_COOKIE['numQuestions'])) {
        $numQuestions = $_COOKIE['numQuestions'];
        echo "NumQ: " . $numQuestions; //remove later
        for ($i = 1; $i <= $numQuestions; $i++) {
            //Handles each question
            if (isset($_POST['question'.$i])) {
                $question = $_POST['question'.$i];
                echo "Question#".$i." Value: ".$question;
                if (isset($_COOKIE['question'.$i.'-type'])) {
                    $questionType = $_COOKIE['question'.$i.'-type'];
                    echo "Question".$i."-type: ".$questionType;
                }
                if (isset($_COOKIE['question'.$i.'-numOptions'])) {
                    $numOptions = $_COOKIE['question'.$i.'-numOptions'];
                    echo "NumO: " . $numOptions;
                    for ($j = 1; $j <= $numOptions; $j++) {
                        if (isset($_POST['question'.$i.'-option'.$j])) {
                            $option = $_POST['question'.$i.'-option'.$j];
                            echo "Question".$i."-Option".$j." Value: ".$option;
                        }
                    }
                } else {
                    echo "Error: Number of options not set";
                }
            } else {
                echo "Question#".$i." not posted in form!";
            }
        }
    } else {
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
                <button id="backButton" class="secondaryButton" type="button">Back</button>
            </div>
        </form>
    </div>
</body>

</html>
