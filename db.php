<?php
    $link = mysqli_connect("localhost", "root", "agagula3");
    mysqli_select_db($link, "userdb");

    if(!$link):
        if(!mysqli_select_db($link, "userdb")):
            exit("Database <userdb> does not exist!");
        else:
            exit("Can't connect to local MySQL server!");
        endif;
    endif;
?>

