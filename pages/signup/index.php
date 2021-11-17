<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
    <title>registreren</title>
</head>
<body>
    <div class="container">
        <form action="../../php/signup_handler.php" method="post" id="form">
            <h1>Account registreren</h1>
            <a href="../login">Inloggen</a>

            <div class="flex-parent">
                <div class="flex-item">
                    <input type="email" name="email" placeholder="Email" id="email" required>

                    <input type="text" name="first_name" placeholder="Voornaam" id="first_name" required>
                    <input type="text" name="tussenvoegsel" placeholder="Tussenvoegsels" id="tussenvoegsel">
                    <input type="text" name="last_name" placeholder="Achternaam" id="last_name" required>
                </div>
                <div class="flex-item">
                    <input type="text" name="student_nr" placeholder="Student nummer" id="student_nr" required>
                    <input type="text" name="class" placeholder="Klas" id="class" required>

                    <input type="password" name="password" placeholder="Wachtwoord" id="pwd" required>
                    <input type="password" name="confirmPassword" placeholder="Herhaal Wachtwoord" id="pwd2" required>
                </div>
            </div>

            <input type="submit" value="Maak account" class="submitenabled" id="submit">
        </form>
        <?php
            if (isset($_SESSION['errorMessage'])) {
                echo "<div class='error' id='error'>" . $_SESSION['errorMessage'] . "</div>";
                unset($_SESSION['errorMessage']);
            }
        ?>
    </div>
    <script src="../../javascript/signup.js"></script>
</body>
</html>