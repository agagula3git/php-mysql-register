<?php
/*session_start();*/

$lowercase = "#[a-z]+#";
$uppercase= "#[A-Z]+#";
$number = "#[0-9]+#";
$specialChars = "#[^a-zA-Z0-9]+#";
$errEmail = "";
$errPassword = "";
$_SESSION['email'] = "";

if(isset($_POST['logIn'])){
    /*$logged = false;*/
    $passValidate = (preg_match($lowercase, $_POST['password']) && preg_match($uppercase, $_POST['password']) 
                && preg_match($number, $_POST['password']) && preg_match($specialChars, $_POST['password']) && strlen($_POST['password'])>=8);
    if(empty($_POST['email'])):
        $errEmail = "email is required";
    elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):
        $errEmail = "the input is not a valid email address";
    else:
        $email = $_POST['email'];
        $errEmail = "";
    endif;

    if(empty($_POST['password'])):
        $errPassword = "password is required";
    elseif(!$passValidate):
        $errPassword = "password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
    else:
        $password = $_POST['password'];
        $errPassword =  "";
    endif;

    if($errPassword === "" && $errEmail === ""):
        $query = "SELECT * FROM user WHERE password = '$password' AND email = '$email'";
        $result = mysqli_query($link,$query);
        /*$sql1 = mysqli_query($link,"SELECT * FROM user WHERE email=".$email);*/
        if(false === $result):
            printf("error: %s\n", mysqli_error($link));
            $errEmail = "The email or username you’ve entered doesn’t match any account";
        else:
            $rows = mysqli_num_rows($result);
            if($rows):
                while($row = mysqli_fetch_row($result)):
                $_SESSION['username'] = $row[0];
                $_SESSION['email'] = $row[1];
                endwhile;
                mysqli_close($link);
                header('LOCATION: userPage.php');
            endif;
        endif;
    endif;
    }
?>