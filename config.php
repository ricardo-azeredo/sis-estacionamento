<?php
$status = 'produçao';

if($status=="local") {
    //mac local
    $db_name = "estacionamento_db";
    $db_host = "localhost";
    $db_user= "root";
    $db_pass = "root";

}else {
    //em Produção
    $db_name = "ricoaz56_estacionamento_db";
    $db_host = "localhost";
    $db_user= "ricoaz56_ricoaz56";
    $db_pass = "1981Zpaneia@";
}

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host,$db_user,$db_pass);

