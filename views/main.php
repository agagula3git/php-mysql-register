<?php 
session_start();
    include ('../db.php');
    include('../login.php');
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie-edge"/>
        <link 
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
            crossorigin="anonymous"
        > 
        <link rel="stylesheet" href="main.css?v=<?php echo time(); ?>"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <title>Membership system</title>
    </head>
<body>
    <!--<span id="success-message"><?php echo $confirmMessage; ?>-->
    <div class="signUp">
        <span class="head">Sign In</span>
        <form method="post" action="main.php" autocomplete="off">
            <div class="inputEl">
                <input type="text" id="email" name="email" placeholder="Email">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <div id="errEmail" class="error-text">
                    <?php echo $errEmail ?>
                </div>
            </div>
            <div class="inputEl">
                <input type="password" id="password" name="password" placeholder="Password">
                <i class="fa fa-lock icon" aria-hidden="true"></i>
                <div id="errPassword" class="error-text">
                    <?php echo $errPassword;?>
                </div>
            </div>
            <button type="submit" name="logIn" class="logIn">LOG IN</button>
            <div class="f1">
                <div class="f1-i">
                    <input type="checkbox" name="remember" value="remembMe" class="checkBox" <?php if(isset($_POST['remember'])): echo 'checked'; endif;?>/>
                    <label for="remember">Remember Me</label>
                </div>
                <a href="#">Forgot Password?</a>
            </div>
            <div class="f2">
                <span>Need new account?</span>
                <button type="button" name="signUp" class="signUpBtn">
                    <a href='registration.php' style="text-decoration: none; color: #fff">Sign Up</a>
                </button>
            </div>
        </form>
    </div>    
</body>
</html>