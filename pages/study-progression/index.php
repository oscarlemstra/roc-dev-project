<?php
session_start();

// if(!$_SESSION['logged_in']) {
//     header("location: ../login");
//     exit();
// }

require_once("../../includes/DatabaseManager.php");
$dbm = new DatabaseManager();

$userSubjects = $dbm->getRecordsFromTable("user_has_subject", "user_id", 1);

// echo "<pre>"; print_r($userSubjects); echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/02_ROCvF_logo_PLAT_RGB%201.png" /> <!--needs a favicon here (roc-dev logo or software dev opleiding logo)-->
    <link rel="stylesheet" href="../../styles/universal.css">
    <title>Study Progression</title>
</head>
<body>
    <header class="header color-roc-orange">
        <img class="logo" alt="ROC Logo" src="../../images/02_ROCvF_logo_PLAT_RGB%201.png">
        <img class="hamburger" alt="hamburger" src="../../images/hamburger.png">
        <div class="profile"></div>
    </header>
<div class="container">


    <div class="hamburger-menu color-roc-orange">
        <a class="color-roc-white-text text-center-margin" href="#">Stage</a>
        <br>
        <a class="color-roc-white-text" href="#">Studievoortgang</a>
        <br>
        <a class="color-roc-white-text" href="#">Cijfers</a>
        <br>
        <a class="color-roc-white-text" href="#">Vakken</a>
    </div>

    <div class="profile-menu">
        <a class="color-roc-white-text" href="#">Stage</a>
        <br>
        <a class="color-roc-white-text" href="#">Studievoortgang</a>
        <br>
        <a class="color-roc-white-text" href="#">Cijfers</a>
        <br>
        <a class="color-roc-white-text" href="#">Vakken</a>
    </div>
    
    <div class="planning-and-grades">


        <div class="planning">
            <h2 class="color-roc-orange-text">Planning van vandaag</h2>
            <h3>Datum: <?php //hier komt de datum van de planning. wat er nu staat is gewoon testtext ?> 27/10/2021</h3>
            <br>
            <?php //dit is het punt dat we de tickets uit de database zouden moeten halen
            //en dan het op een rijtje onderelkaar echo-en
            //dus bvbmet een foreach die elke vak als een div echo-ed
            //als er teveel ruimte is echo maar een <br> erbij of voeg wat padding/margin toe   ?>
            <p>Rekenen - H1 - 3 pnt</p><p>Databases ontwerpen - DeeBeeTrain - 6pnt</p><p>roc-dev-project - study progression - 6pnt</p>
            <a href="#"><div class="color-roc-orange planning-create-button"><span>Edit/Create Planning</span></div></a>
        </div>

        <div class="grades">
            <h2 class="color-roc-orange-text">Cijfers</h2>

            <br>
            <?php //Hier komen de cijfers van alle vakken te staan dit kan makkelijk met een foreach ?>
            <div class="grade-container">
                <p>HTML :</p>
                <p class="grade">G</p>
            </div>
            <div class="grade-container">
                <p>Java :</p>
                <p class="grade">V</p>
            </div>
            <div class="grade-container">
                <p>JavaScript :</p>
                <p class="grade">V</p>
            </div>
        </div>

    </div>

    <div class="subjects">
    <!--dit is een template voor de vakcontainer
    zodra hierbij php gebruikt gaat worden raad ik aan om het op teroepen en echo-en met een foreach-->
    <!-- <div>
        <div class="subject-container">
            <div class="subject-color-container color-kerntaak-frontend"></div>
            <div class="subject-container__text">
                <h2 class="text-center">HTML</h2>
                <br>
                <p class="text-center">5 Weken<br>Programmeren<br>(Frontend)</p>
            </div>
            <img src="../../images/tick-mark.png" alt="checkmark" class="checkmark done">
        </div>
        <div class="panel">test</div>
    </div> -->

    <?php
    function checkSecondaryType ($secondaryType) {
        if ($secondaryType) {
            return "<br>".$secondaryType;
        }
    }

    function checkIfDone($done) {
        if($done) {
            return "done";
        }
    }
    
    $count = 0;

    foreach($userSubjects as $record) {
        $subject = $dbm->getRecordsFromTable("subject", "subject_id", $record['subject_id']);
        $subjectType = $dbm->getRecordsFromTable("subject_type", "type_id", $subject[0]['type_id']);
        $count++;

        // begin 1
        echo "<div>";
            // begin 2
            echo "<div class='subject-container'>";
                echo "<div class='subject-color-container color-kerntaak-".$subjectType[0]['name']."'></div>";
                // begin 3
                echo "<div class='subject-container__text'>";
                    echo "<h2 class='text-center'>". $subject[0]['name'] ."</h2><br>";
                    echo "<p class='text-center'>". $subject[0]['hours'] ." uur<br>". $subjectType[0]['name'] . checkSecondaryType($subject[0]['secondary_type']) ."</p>";
                //end 3
                echo "</div>";
                echo "<img src='../../images/tick-mark.png' alt='checkmark' class='checkmark ". checkIfDone($record["finished"]) ."'>";
            // end 2
            echo "</div>";

            echo "<div class='panel'>test</div>";
        // end 1
        echo "</div>";
    }
    ?>
   
    </div>

    
    
</div>
<div class="progression-meter">
    <p class="progression"><?php
    ?>50%</p>
</div>
<script src="../../javascript/study-progression.js"></script>
</body>
</html>

