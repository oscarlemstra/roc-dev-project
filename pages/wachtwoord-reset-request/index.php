<?php 
    session_start();
    
    require_once '../../includes/email_send.php';
    require_once '../../includes/DatabaseManager.php';
    $dbm = new DatabaseManager();


    // VALIDATE EMAIL
    // check if email exists
    if ($_POST['email'] === '') {
        $_SESSION['errorMessage'] = 'email is niet ingevuld';
        header('location: ../login');
        exit();
    }

    // filter email to check if it has a valid email format
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errorMessage'] = 'dit is geen email';
        header('location: ../login');
        exit();
    }

    // check if account with thie email exists
    if (!$dbm->getRecordsFromTable("user", "email", $_POST['email'])) {
        $_SESSION['errorMessage'] = 'deze email heeft geen account';
        header('location: ../login');
        exit();
    }


    // generate random string to use as securety Key at password reset page
    $securetyString = RandomString(64);
    
    // send email. if it fails notify user and end the script
    if (!sendEmail_PasswordReset($_POST['email'], $securetyString, $dbm)) {
        echo '⚠ iets is gefaald. neem alstublieft contact op met de site eigenaar ⚠';
        exit();
    }
    
    // if email didnt fail:
    //   check if password_reset_code already has a entry for the user
    //     if no: make one
    //     if yes: update record
    $userRecord = $dbm->getRecordsFromTable('user', 'email', $email);
    $userId = $userRecord[0]['user_id'];

    $row = $dbm->getRecordsFromTable('password_reset_code', 'user_id', $userId);

    if ($row) {
        $dbm->updateRecordsFromTable('password_reset_code', 'code', $securetyString, 'user_id', $userId);
    } else {
        $array = array(
            'user_id' => $userId,
            'code' => $securetyString
        );
        $dbm->insertRecordToTable('password_reset_code', $array);
    }


    // function to generate a random string with any length
    function RandomString($limit) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $limit; $i++) {
            $randstring .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/login-signup-style.css">
    <link rel="icon" type="image/x-icon" href="../../images/favicon.jpg">
    <title>Wachtwoord reseten</title>
</head>
<body>
    <div class="container">
        <form method="post">
            <h2>Wachtwoord Reset</h2>
            <p>een email is gestuurd naar <?php echo $_POST['email']; ?>. <br/>volg de instructies op de email en log daarna weer in</p>
            <a href="">opnieuw stuuren</a><br>
            <a href="../login/">login</a>
        </form>
        <?php
            // this code isnt needed but i'll still keep it
            if(isset($_SESSION["errorMessage"])) {
                echo "<div class='error'" . $_SESSION["errorMessage"] . "</div>";
                unset($_SESSION['errorMessage']);
            }
        ?>
    </div>
</body>
</html>