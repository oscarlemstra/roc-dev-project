<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/02_ROCvF_logo_PLAT_RGB%201.png" /> <!--needs a favicon here (roc-dev logo or software dev opleiding logo)-->
    <link rel="stylesheet" href="styles/study-progression.css">
    <title>Study Progression</title>
</head>
<body>
<div class="container">

<div class="header color-roc-orange">
    <img class="logo" alt="ROC Logo" src="images/02_ROCvF_logo_PLAT_RGB%201.png">
    <img class="hamburger" alt="hamburger" src="images/hamburger.png">
</div>

    <div class="planning">
        <h2 class="color-roc-orange-text">Planning van vandaag</h2>
        <h3>Datum: <?php //hier komt de datum van de planning. wat er nu staat is gewoon testtext ?> 27/10/2021</h3>
        <br>
        <?php //dit is het punt dat we de tickets uit de database zouden moeten halen
              //en dan het op een rijtje onderelkaar echo-en
              //dus bvbmet een foreach die elke vak als een div echo-ed
              //als er teveel ruimte is echo maar een <br> erbij of voeg wat padding/margin toe   ?>
        <p>Rekenen - H1 - 3 pnt</p><p>Databases ontwerpen - DeeBeeTrain - 6pnt</p><p>roc-dev-project - study progression - 6pnt</p>
        <a href="#"><div class="color-roc-orange planning-create-button"><p class="text-align-middle">Edit/Create Planning</p></div></a>
    </div>

    <div class="subjects">
    <!--dit is een template voor de vakcontainer
    zodra hierbij php gebruikt gaat worden raad ik aan om het op teroepen en echo-en met een foreach-->
        <div class="subject-container">
            <div class="subject-color-container color-kerntaak-frontend"></div>
            <div class="subject-container__text">
                <h2 class="subject-text-center">HTML</h2>
                <p class="subject-text-center">5 Weken<br>Programmeren<br>(Frontend)</p>
            </div>
        </div>

        <div class="subject-container">
            <div class="subject-color-container color-kerntaak-backend"></div>
            <div class="subject-container__text">
                <h2 class="subject-text-center">PHP</h2>
                <p class="subject-text-center">5 Weken<br>Programmeren<br>(Backend)</p>
            </div>
        </div>

        <div class="subject-container">
            <div class="subject-color-container color-kerntaak-keuzedeel"></div>
            <div class="subject-container__text" >
                <h2 class="subject-text-center">Verdieping Software</h2>
                <p class="subject-text-center">5 Weken<br>Programmeren<br>(Keuzedeel)</p>
            </div>
        </div>

        <div class="subject-container">
            <div class="subject-color-container color-kerntaak-regulier"></div>
            <div class="subject-container__text">
                <h2 class="subject-text-center">Nederlands</h2>
                <p class="subject-text-center">5 Weken<br>Regulier</p>
            </div>
        </div>

    </div>

    <div class="grades">
        <h2 class="color-roc-orange-text">Cijfers</h2>

        <br>
        <?php //Hier komen de cijfers van alle vakken te staan dit kan makkelijk met een foreach ?>
        <p>HTML :</p>
    </div>

</div>
</body>
</html>

