<?php
    require 'config.php';

   
    $id = filter_input(INPUT_POST, 'id');
    $cliente = filter_input(INPUT_POST, 'cliente'); 
    $contato = filter_input(INPUT_POST, 'contato'); 
    $tipo = filter_input(INPUT_POST, 'veiculo'); 
    $placa = filter_input(INPUT_POST, 'placa'); 
    $marca = filter_input(INPUT_POST, 'marca'); 
    $modelo = filter_input(INPUT_POST, 'modelo'); 
    $data = filter_input(INPUT_POST, 'data'); 
    $hora = filter_input(INPUT_POST, 'hora'); 
    
    //verificar se o id, o nome e o email são válidos
    
    if($id && $cliente && $contato && $tipo && $placa && $marca && $modelo) {

        $clientes = $pdo->prepare("UPDATE clientes SET cliente = :cliente, contato = :contato WHERE id = :id");
        $clientes->bindValue(':cliente',"$cliente"); 
        $clientes->bindValue(':contato',$contato);
        $clientes->bindValue(':id',$id); 
        $clientes->execute();    
    
    
        $veiculos = $pdo->prepare("UPDATE veiculos SET tipo =:tipo, marca = :marca, modelo =:modelo, placa = :placa  WHERE cliente_id = :id");
        $veiculos->bindValue(':tipo',$tipo); 
        $veiculos->bindValue(':marca',$marca);
        $veiculos->bindValue(':modelo',$modelo);
        $veiculos->bindValue(':placa',$placa);
        $veiculos->bindValue(':id',$id); 
        $veiculos->execute();

        $parking = $pdo->prepare("UPDATE estacionamento SET data =:data, hora = :hora WHERE cliente_id = :id");
        $parking->bindValue(':data',$data); 
        $parking->bindValue(':hora',$hora);
        $parking->bindValue(':id',$id); 
        $parking->execute();

        header("Location:index.php");
        exit;

    } else {
        //caso contrário, vai retorna para página adicionar.php e não registra.
        header('Location: editar.php'); 
        exit;
    }