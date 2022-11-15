<?php

    //mac local
    $db_name = "estacionamento_db";
    $db_host = "localhost";
    $db_user= "root";
    $db_pass = "root";



$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host,$db_user,$db_pass);

