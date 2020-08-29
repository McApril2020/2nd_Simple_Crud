<?php
    //procedural mysql
    $connection = mysqli_connect('localhost', 'root', '', 'crud');

    if(!$connection) {
        echo 'Connection Failed: ' . mysqli_connect_error();
    }

    //mysql object oriented style
    //$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

    $name = "";
    $username = "";
    $email = "";
    $update = false;
    $id = 0;




    
