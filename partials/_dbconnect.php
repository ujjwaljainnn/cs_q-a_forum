<?php
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $database = "idiscuss";

    $con = mysqli_connect($serverName, $username, $password, $database);

    //Die if connection fail
    if(!$con){
        die("Sorry, connection failed :( due to: " . mysqli_connect_error());
    }
?>