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
 if($id) {
    $lista = $pdo->query("SELECT e.id, e.data, e.hora, cl.cliente, cl.contato, v.tipo ,v.placa,v.modelo, e.status, u.nome as opearador FROM estacionamento as e inner join clientes as cl on e.cliente_id = cl.id inner join veiculos as v on cl.id = v.cliente_id inner join usuario as u on e.operador_id = u.id Where e.id = $id");  
    
    
    //Verifica se id é válido.
    if($lista->rowCount() > 0 ) {
        //o método fecth vai pegar o primeiro resultado.
        $info = $lista->fetch(PDO::FETCH_ASSOC);
    
    } 
} else {
    header("Location: index.php");
    exit;
}

?>

<div class="container">
    <div class="mb-2">
        <h1>Destalhes do veículo: </h1>
    </div>
    <div class="mt-2">
        <h5>Data: <?=$info['data'];?></h5>
        <h5>Hora: <?=$info['hora'];?></h5>
        <h5>Cliente: <?=$info['cliente'];?></h5>
        <h5>Contato: <?=$info['contato'];?></h5>
        <h5>Veículo: <?=$info['tipo'];?></h5>
        <h5>Placa: <?=$info['placa'];?></h5>
        <h5>Modelo: <?=$info['modelo'];?></h5>
        <h5>Situação: <?php if($info['status']==0){
            echo "Na vaga";
        } else {
            echo "Finalizado";
        }
        ?></h5>
    </div>
   
    
</div>

<?php include 'footer.php'; ?>