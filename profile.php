<?php
session_start();
ob_start();
    include 'config.php';
    include 'head.php';
    include 'header.php';
    $id = $_SESSION['id'];
    $sql = $pdo->query("SELECT * FROM usuario WHERE id = $id");
    $banco = $sql->fetch(PDO::FETCH_ASSOC); 
?>

<div class="container">
    <h1>Perfil do Operador - <?php echo $_SESSION['nome'] ?></h1>
        <div class="avatar">
            <img src="profile/<?=$banco['avatar']; ?>" alt="">
        </div>
        <div class="mudar">
            
            <form action="recebedor.php" method="post" enctype="multipart/form-data" />
            <div class="mb-3">
                <label for="formFile" class="form-label">Trocar Avatar</label>
                <input class="form-control" type="file" name="arquivo">
            </div>
            <input type="submit" class="btn btn-primary" value="Enviar">
            <a href="index.php" class="btn btn-danger">Voltar</a>
            </form>
        </div>

    </div>