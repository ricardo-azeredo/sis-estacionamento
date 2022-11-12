<?php
session_start();
ob_start();
require 'config.php';
require 'head.php';
require 'header.php';

$info = [];
$id  = filter_input(INPUT_GET, 'id');
echo $id;

 //Verifica se tem id.
//  if($id) {
//     $lista = $pdo->query("SELECT e.id, e.data, e.hora, cl.cliente, cl.contato, v.tipo ,v.placa,v.modelo, e.status, u.nome as opearador FROM estacionamento as e inner join clientes as cl on e.cliente_id = cl.id inner join veiculos as v on cl.id = v.cliente_id inner join usuario as u on e.operador_id = u.id Where e.id = $id");  
    
    
//     //Verifica se id é válido.
//     if($lista->rowCount() > 0 ) {
//         //o método fecth vai pegar o primeiro resultado.
//         $info = $lista->fetch(PDO::FETCH_ASSOC);
    
//     } 
// } else {
//     header("Location: index.php");
//     exit;
// }

?>