<?php 
session_start();
$username = $_SESSION['username'];
if(isset($_POST['logOut'])){
    header('LOCATION: app.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie-edge"/>
        <link rel="stylesheet" href="loged.css?v=<?php echo time(); ?>"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <title>Logged into Account</title>
    </head>
<body>
    <div class="userAcc">
        <form method="post" action="loged.php">
            <div class="user-avatar">
                <i class="fa fa-user icon fa-2x" aria-hidden="true"></i>
                <span style="color: #fff; font-size: 16pt; margin-right: 15px;"><?php echo $username; ?></span>
            </div>
            <button
                type="submit"
                name="logOut"
                class="logOutBtn"
            >
                LOG OUT
            </button>
        </form>
</body>
</html>