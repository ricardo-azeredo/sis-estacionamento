<?php
session_start();
ob_start();
require 'config.php';
require 'head.php';
require 'header.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    
if(!empty($dados['Cadastrar'])){
    $user_id = $_SESSION['id'];

    //Cadastrar na tabela Clientes
    $cliente = $pdo->prepare("INSERT INTO clientes (cliente, contato) VALUES (:cliente,:contato)");
    $cliente->bindValue(':cliente', $dados['cliente']);
    $cliente->bindValue(':contato',$dados['contato']);
    $cliente->execute();

    $clienteQuery = $pdo->query("SELECT id FROM clientes where cliente = '".$dados['cliente']."'");
  
    if($clienteQuery->rowCount() > 0){
        $clientId = $clienteQuery->fetch(PDO::FETCH_ASSOC);
        print_r($clientId['id']);
        //Cadastrar na tabela Veículo
        $veiculo = $pdo->prepare("INSERT INTO veiculos(tipo,marca, modelo, placa, cliente_id) VALUES (:tipo, :marca, :modelo, :placa, :cliente_id )");
        $veiculo->bindValue(':tipo', $dados['veiculo']);
        $veiculo->bindValue(':marca', $dados['marca']);
        $veiculo->bindValue(':modelo', $dados['modelo']);
        $veiculo->bindValue(':placa', $dados['placa']);
        $veiculo->bindValue(':cliente_id', $clientId['id']);
        $veiculo->execute();


        $estacionamento = $pdo->prepare("INSERT INTO estacionamento (operador_id, cliente_id, data, hora) VALUES (:operador_id, :cliente_id, :data, :hora)");
        $estacionamento->bindValue(':operador_id', $user_id);
        $estacionamento->bindValue(':cliente_id', $clientId['id']);
        $estacionamento->bindValue(':data', $dados['data']);
        $estacionamento->bindValue(':hora', $dados['hora']);
        $estacionamento->execute();

        header("Location: index.php");
        exit;
    } else {
        echo "Query não teve retorno";
    }

} else{
    echo "Não tem dados para enviar";
}