<?php 
session_start();

$errCreateEmail = "";
$errCreatePassword = "";
$err = "";
$confirmMessage = "";
$errConfirmPassword = "";
$errConfirmEmail = "";
$errUsername = "";
$_SESSION['confirmMessage'] = "";

if(isset($_POST['signUp'])):

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

    if(!empty($_POST['createEmail']) && filter_var($_POST['createEmail'], FILTER_VALIDATE_EMAIL)):
        if($createEmail != $_POST['confirmEmail']):
            $errConfirmEmail = "that's not the same email as the first one";
        endif;
    endif;
    /*function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
    console_log($errCreatePassword);*/
    if($errCreatePassword == "" && $errCreateEmail == "" && $errConfirmEmail == "" && $errConfirmPassword == "" && $errUsername == ""):

        $query1 = "SELECT * FROM user WHERE password = '$createPassword'";
        $query2 = "SELECT * FROM user WHERE username = '$createUsername'";
        $query3 = "SELECT * FROM user WHERE email = '$createEmail'";

        $result1 = mysqli_query($link, $query1);
        $result2 = mysqli_query($link, $query2);
        $result3 = mysqli_query($link, $query3);

        if(!$result1 && !$result2 && !$result3):
            printf("error: %s\n", mysqli_error($link));
        else:
            $rows1 = mysqli_num_rows($result1);
            $rows2 = mysqli_num_rows($result2);
            $rows3 = mysqli_num_rows($result3);
            if($rows1 || $rows2 || $rows3):
                $err = "An account with this data already exist!";
            else:
                $sql = "INSERT INTO user (username, email, password) VALUES ('$createUsername', '$createEmail', '$createPassword')";
                $addItem = mysqli_query($link, $sql);
                if($addItem):
                    $confirmMessage = "Your account has been successfully created.";
                    $_SESSION['confirmMessage'] = $confirmMessage;
                    header('LOCATION: main.php');
                    exit;
                endif;
            endif;
        endif;
    endif;
endif;
?>