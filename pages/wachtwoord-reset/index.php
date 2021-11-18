<?php 
    session_start();

    require_once '../../includes/signup_error_handling.php';
    require_once '../../includes/encrypt-decrypt.php';
    require_once '../../includes/hash-password.php';
    require_once '../../includes/DatabaseManager.php';
    $dbm = new DatabaseManager();

    if ( !isset($_GET['e']) || !isset($_GET['s']) ) {
        echo 'missing parameters';
        exit();
    }

    $encryptedEmail = $_GET['e'];
    $securetyKey = $_GET['s'];

    $email = encrypt_decrypt($encryptedEmail, 'decrypt');


    // validate securety key authenticity
    $userID = $dbm->getRecordsFromTable("user", "email", $email)[0]['user_id'];

    $record = $dbm->getRecordsFromTable("password_reset_code", "user_id", $userID);
    if ($record[0]['code'] !== $securetyKey || $record[0]['code'] === 'empty_field') {
        echo "dit is niet de juiste URL";
        exit();
    }
    
    // if user pressed the button. do the thing...
    if (isset($_POST['submit'])) {

        $pwd = $_POST['password-1'];
        $confirmedpwd = $_POST['password-2'];

        $result = pwdCheck($pwd, $confirmedpwd, $email);
        if ($result) {
            $_SESSION['errorMessage'] = $result;
        } else {
            // hash password and update it in database
            $hashedPwd = hashPassword($userID, $pwd);
            $dbm->updateRecordsFromTable('user', 'password', $hashedPwd, 'email', $email);

            // emtpy code in database
            $dbm->updateRecordsFromTable('password_reset_code', 'code', 'empty_field', 'user_id', $userID);

            // $scriptResult is used later in this file to check if i need to show the form or the messages saying it succesfully changed
            $scriptResult = true;
        }
    }
    else { $scriptResult = false; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
    <link rel="icon" type="image/x-icon" href="../../images/favicon.jpg">
    <title>Wachtwoord herstellen</title>
</head>
<body>
    <?php
        // make an invisible div with id "email_vak" with the email
        echo '<div style="display:none;" id="email_vak">' . $email . '</div>';
    ?>
    <div class="container">
        <?php
            if (!$scriptResult) {
                echo '<form method="post">';
                    echo ' <h1>zet een nieuwe wachtwoord</h1>';

                    echo '<input type="password" placeholder="wachtwoord" name="password-1" id="pwd">';
                    echo '<input type="password" placeholder="wachtwoord" name="password-2" id="pwd2">';

                    echo '<input type="submit" value="submit" name="submit" id="submit">';
                echo '</form>';
            }
            else
            {
                echo '<h2>wachtwoord succesvol reset</h2>';
                echo '<a href="../login/">login</a>';
            }
        ?>
        
        <?php
            // this code isnt needed but i'll still keep it
            if(isset($_SESSION["errorMessage"])) {
                echo "<div class='error'" . $_SESSION["errorMessage"] . "</div>";
                unset($_SESSION['errorMessage']);
            }
        ?>
    </div>

    <script src="../../javascript/password-reset.js"></script>
</body>
</html>