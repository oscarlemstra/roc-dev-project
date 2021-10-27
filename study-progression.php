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
    <!--dit is een template voor de vakcontainer-->
        <div class="subject-container"><div class="subject-color-container color-kerntaak-frontend"></div><h2 class="subject-text-center">HTML</h2></div>
        <div class="subject-container"></div>

    </div>

</div>
</body>
</html>

