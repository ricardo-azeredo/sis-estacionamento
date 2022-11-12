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
        <hr>
    </div>
    <div class="mt-2">
        <h4>Data: <?=date("d/m/Y",strtotime($info['data']));?></h4>
        <h4>Hora: <?=$info['hora'];?></h4>
        <h4>Cliente: <?=$info['cliente'];?></h4>
        <h4>Contato: <?=$info['contato'];?></h4>
        <h4>Veículo: <?php if($info['tipo']==1){
             echo "Moto";  
        } else if($info['tipo']==2) {
            echo "Carro";                       
        } ?></h4>
        <h4>Placa: <?=$info['placa'];?></h4>
        <h4>Modelo: <?=$info['modelo'];?></h4>
        <h4>Situação: <?php if($info['status']==0){
            echo '<span class="badge bg-danger">Na vaga</span>';
        } else {
            echo '<span class="badge bg-success">Finalizado</span>';
        }
        ?></h4>
    </div>
    <div class="botoes mt-3">
        <a class="btn btn-primary" href="finalizar_action.php?id=<?=$info['id']; ?>">Finalizar</a>
        <a class="btn btn-success" href="editar.php?id=<?=$info['id']; ?>">Editar</a>
        <a class="btn btn-danger" href="index.php">Voltar</a>
    </div> 

    
</div>

<?php include 'footer.php'; ?>