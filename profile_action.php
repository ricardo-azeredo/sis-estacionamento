<?php
    session_start();
    ob_start();
    require 'config.php';

    $id = filter_input(INPUT_POST, 'id');
    $name = filter_input(INPUT_POST, 'name');
    $password = filter_input(INPUT_POST,'password'); 
    $password_confirm = filter_input(INPUT_POST,'password_confirm'); 

    if($id && $name) {
        $sql = $pdo->prepare("UPDATE usuario SET nome =:name WHERE id = :id");
            $sql->bindValue(':name',$name); 
            $sql->bindValue(':id',$id); 
            $sql->execute();
            $_SESSION['msg'] = "Nome do Usuário Atualizado com Sucesso!";
            
            header("Location: profile.php");
            exit;

    } else if($id && $password && $password_confirm) {
        if($password === $password_confirm){

            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = $pdo->prepare("UPDATE usuario SET senha =:password WHERE id = :id");
            $sql->bindValue(':password',$password_hash); 
            $sql->bindValue(':id',$id); 
            $sql->execute();

             
            $_SESSION['msg'] = "Senha Atualizada com Sucesso!";
            header("Location: profile.php");
            exit;
        }else {
            $_SESSION['error'] = "Erro: as senhas não iguais.";
            header("Location: profile.php");
            exit;
        }
    }
    

  




