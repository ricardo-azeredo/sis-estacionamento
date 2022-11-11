<?php
session_start();
ob_start();
require 'config.php';
require 'head.php';
require 'header.php';


?>

<div class="container">
    <h1>Editar Usuário</h1>
    
    <form action="Editar_action.php" method="post">
        <input type="hidden" name="id" value="<?=$info['id'];?>" />
        <div class="mb-3">
            <label for="" class="form-label">
                Nome: <br/>
                <input type="text" name="name" value="<?=$info['nome'];?>" class="form-control" />
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                E-mail: <br/>
                <input type="email" name="email" value="<?=$info['email'];?>" class="form-control"/>
            </label>
        </div>
        
        <input type="submit" value="Salvar" class="btn btn-primary" />
    </form>

</div>

<?php include 'footer.php'; ?>