<?php 
session_start();

$lowercase = "#[a-z]+#";
$uppercase= "#[A-Z]+#";
$number = "#[0-9]+#";
$specialChars = "#[^a-zA-Z0-9]+#";
$errCreateEmail = "";
$errCreatePassword = "";
$err = "";
$confirmMessage = "";
$errConfirmPassword = "";
$errConfirmEmail = "";
$errUsername = "";
$_SESSION['confirmMessage'] = "";

if(isset($_POST['signUp'])):
    $passValidate = (preg_match($lowercase,$_POST['createPassword']))  && (preg_match($uppercase, $_POST['createPassword'])) && 
                    (preg_match($number, $_POST['createPassword'])) && (preg_match($specialChars, $_POST['createPassword']));

    if(empty($_POST['createEmail'])):
        $errCreateEmail = "email is required";
    elseif(!filter_var($_POST['createEmail'], FILTER_VALIDATE_EMAIL)):
        $errCreateEmail = "the input is not a valid email address";
    else:
        $createEmail = $_POST['createEmail'];
        $errCreateEmail = "";
    endif;

    if(empty($_POST['createUsername'])):
        $errUsername = "username is required";
    elseif(preg_match($specialChars, $_POST['createUsername'])):
        $errUsername = "this field must not contain special characters";
    elseif(strlen($_POST['createUsername'])<5 ):
        $errUsername = "username should be longer than 4";
    elseif(strlen($_POST['createUsername'])>16):
        $errUsername = "username should be no longet than 16";
    else:
        $createUsername = $_POST['createUsername'];
        $errUsername = "";
    endif;

    if(empty($_POST['createPassword'])):
        $errCreatePassword = "password is required";
    elseif(!$passValidate):
        $errCreatePassword = "password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
    else:
        $createPassword = $_POST['createPassword'];
        $errCreatePassword =  "";
    endif;

    if(!empty($_POST['createPassword']) && $passValidate):
        if($createPassword != $_POST['confirmPassword']):
            $errConfirmPassword = "that's not the same password as the first one";
        endif;
    endif;

    if(!empty($_POST['createEmail']) && filter_var($_POST['createEmail'], FILTER_VALIDATE_EMAIL)):
        if($createEmail != $_POST['confirmEmail']):
            $errConfirmEmail = "that's not the same email as the first one";
        endif;
    endif;

    if($errCreatePassword = "" && $errCreateEmail = "" && $createEmail == $_POST['confirmEmail'] && $createPassword == $_POST['confirmEmail']):
        $query1 = "SELECT * FROM user WHERE password =".$createPassword;
        $query2 = "SELECT * FROM user WHERE username =".$createUsername;
        $query3 = "SELECT * FROM user WHERE email =".$createEmail;
        $result1 = mysqli_query($link, $query1);
        $result2 = mysqli_query($link, $query2);
        $result3 = mysqli_query($link, $query3);
        if($result1 || $result2 || $result3):
            $err = "An account with this data already exist!";
        else:
            $sql = "INSERT INTO user (username, email, password) VALUES ('$createUsername', '$createEmail', '$createPassword')";
            $addItem = mysqli_query($link, $sql);
            if($addItem):
                $confirmMessage = "Your account has been successfully created.";
                $_SESSION['confirmMessage'] = $confirmMessage;
                header('LOCATION: app.php');
            endif;
        endif;
    endif;
endif;
?>