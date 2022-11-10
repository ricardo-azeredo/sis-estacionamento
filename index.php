<?php
    session_start();
    ob_start();
    require 'config.php';
    require 'head.php';

    if((!isset($_SESSION['id'])) && (!isset($_SESSION['nome']))){
        $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário fazer o login!</p>";
        header("Location: login.php");
        exit;
    } 




?>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="profile">
            <a href="profile.php" class="btn btn-primary">Perfil do Operador</a>
        </div>
        
    </div>

<?php include 'footer.php'; ?>