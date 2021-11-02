<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/login-signup-style.css">
    <title>verificatie</title>
</head>
<body>
    <div class="container">
        <form action="../../php/verification_handler.php" method="post">
            <h1>verificatie</h1>

            <input type="text" name="verification_code" placeholder="Verificatie code" id="verification_code" required>
            <input type="submit" value="submit" class="submitenabled" id="submit">
        </form>
        <div class='error displayNone' id='error'></div>
        <?php
            if (isset($_SESSION['errorMessage'])) {
                echo "<div class='error' id='error2'>" . $_SESSION['errorMessage'] . "</div>";
                unset($_SESSION['errorMessage']);
            }
        ?>
    </div>
    <script src="../../javascript/email-verification.js"></script>
</body>
</html>