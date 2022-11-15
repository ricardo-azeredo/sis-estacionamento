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
    $db_name = "estacionamento_db";
    $db_host = "localhost";
    $db_user= "usuario";
    $db_pass = "senha";
}

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host,$db_user,$db_pass);

