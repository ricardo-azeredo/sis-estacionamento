<?php
     $id = $_SESSION['id'];
     $sql = $pdo->query("SELECT * FROM usuario WHERE id = $id");
     $banco = $sql->fetch(PDO::FETCH_ASSOC); 

     date_default_timezone_set("America/Sao_Paulo");

?>
<header>        
    <div class="logo">
        <h2><a href="index.php">Sistema de Estacionamento</a></h2>
    </div>
    <div class="nav-right">
        <img class="avatar-header" src="profile/<?=$banco['avatar']; ?>" alt="">
        <?php echo $banco['nome'] ?>
        <a href="sair.php">Sair</a>
    </div>        
</header>