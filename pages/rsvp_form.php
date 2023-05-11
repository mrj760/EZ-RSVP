
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Event RSVP Form</title>
    <link rel="stylesheet" type="text/css" href="../style/_global.css?<?= filesize('../style/_global.css'); ?>" />
    <script src="../script/_global.js?<?= filesize('../script/_global.js'); ?>"></script>
</head>
<!--we are using cookies, not cookies with session!-->
<body>
    <?php //when the event is clicked, this page is viewed.  Need to pass in event ID to pull
    //questions from table but how?  What is event ID?  Evnts are stored in local storage as well
    //which is retrieved by js.  So how to get it from all that??!-->
    
    //<!-- id is as a name-value pair passed through this: linkToEventDetails.href = './event_details.php?id=' + events[i].id; !-->

    require_once('../php/db.config.php');

    $id = $_GET['id']; //get value passed from url and store in variable

    pg_prepare(
        $CONNECTION,
        "get_questions",
        "SELECT * FROM questions WHERE eventID=$1"
    );

    $params = [$id];
    $result = pg_execute($CONNECTION, "get_questions", $params);
    // Check if the request was successful
    if (!$result) {
        http_response_code(500);
        echo json_encode(array("message" => "Error occurred while retrieving questions: " . pg_last_error($CONNECTION)));
        exit;
    }
    $questions = pg_fetch_all($result);
    pg_close($CONNECTION);

    //ok, so now we should have fetched all pre-existinf questions from the table
    ?>

    <!-- html for displaying everything!  Need a form to submit created questions--actually no-->
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
            <button onclick="window.location.href='question.php?eventID=<?php echo $eventID; ?>'">Create Question</button>
            <button id="newQuestionButton" class="button" type="button">New Question</button>
            <br>
            <button id="saveButton" class="button" type="button">Save</button>
            <button id="backButton" class="secondaryButton" type="button">Back</button>
        </div>
    </div>

</body>

</html>