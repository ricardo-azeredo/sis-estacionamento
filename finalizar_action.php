<?php
session_start();
ob_start();
require 'config.php';
require 'head.php';
require 'header.php';

$info = [];
$status = [];
$id  = filter_input(INPUT_GET, 'id');


 //Verifica se tem id.
 if($id) {
    $lista = $pdo->query("SELECT e.id, e.data, e.hora, cl.cliente, cl.contato, v.tipo ,v.placa,v.modelo, e.status, u.nome as opearador FROM estacionamento as e inner join clientes as cl on e.cliente_id = cl.id inner join veiculos as v on cl.id = v.cliente_id inner join usuario as u on e.operador_id = u.id Where e.id = $id");  
    
    
    //Verifica se id é válido.
    if($lista->rowCount() > 0 ) {
       
        $info = $lista->fetch(PDO::FETCH_ASSOC);
        
        $total_pagar = 0;
        
        $data_inicial = $info['data'];
        $dia_inicial = new DateTime($data_inicial);
        $hoje = new DateTime();
        
        $diaria = date_diff($hoje, $dia_inicial)->format("%d");
        $horas = date_diff($hoje, $dia_inicial)->format("%h");
       

        if($diaria > 0) {
            $preco_diaria = 20.00;
            $total_pagar = $preco_diaria * $diaria;            
        } else if($horas < 1) {
            $total_pagar = 8.00;             
        } else {
            $total_pagar = $horas * 8.00;            
        }

        $sql = $pdo->prepare("UPDATE estacionamento SET status = :status WHERE cliente_id = :id");
        $sql->bindValue(':status', 1);
        $sql->bindValue(':id', $id);
        $sql->execute();

        $_SESSION['msg'] = "Serviço Finalizado com Sucesso.";
        
        $result = $pdo->query("SELECT status FROM estacionamento where cliente_id = $id");
        $status = $result->fetch(PDO::FETCH_ASSOC);
        
    } 
} else {
   header("Location: detalhes.php");
   exit;
}

?>
<div class="container px-4 text-center">
    <div class="mb-2">
        <h1>Finalizando o Serviço: </h1>
        <hr>
    </div>
    <div class="row gx-5 ">
        <div class="col ">
            <div class="p-3 border bg-light">
                <h4>Cliente: <?=$info['cliente'];?></h4>
                <h4>Contato: <?=$info['contato'];?></h4>
                <h4>Veículo: <?php if($info['tipo']==1){
                    echo "Moto";  
                } else if($info['tipo']==2) {
                    echo "Carro";                       
                } ?></h4>
                <h4>Placa: <?=$info['placa'];?></h4>
                <h4>Modelo: <?=$info['modelo'];?></h4>
                <h4>Situação: <?php if($status['status']==0){
                    echo '<span class="badge bg-danger">Na vaga</span>';
                } else {
                    echo '<span class="badge bg-success">Finalizado</span>';
                }
                ?></h4>
            </div>
        </div>
        <div class="col">
            <div class="p-3 border bg-light">
                <h4>Data de Entrada: <?=date("d/m/Y",strtotime($info['data']));?></h4>
                <h4>Hora de Entrada: <?=$info['hora'];?></h4>
                <h4>Data de Saída: <?=date("d/m/Y");?></h4>
                <h4>Hora de Saída: <?=date("h:m:s"); ?></h4>
                <h4>Tempo :
                    <?php if($diaria >= 1){
                        echo $diaria." dia(s)";
                    } else {
                        echo $horas." Horas";
                    }
                    ?> 
                </h4>
                <h4>Total: R$ <?=$total_pagar; ?></h4>

            </div>

        </div>    
    </div>
    <div class="botoes mt-3">
        <a class="btn btn-success" href="index.php">Fechar</a>       
        <a class="btn btn-danger" href="detalhes.php?id=<?=$info['id']; ?>">Voltar</a>
    </div> 

    
</div>

<?php include 'footer.php'; ?>