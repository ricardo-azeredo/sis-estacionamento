<?php
session_start();
ob_start();
    include 'config.php';
    include 'head.php';
    include 'header.php';

    //Criando o array para add as informções
    $banco =[];


    $id = $_SESSION['id'];
    if($id) {
        $sql = $pdo->query("SELECT * FROM usuario WHERE id = $id");
        $banco = $sql->fetch(PDO::FETCH_ASSOC); 
    } else {
        header("Location: profile.php");
        exit;
    } 
   
    
?>

<div class="container">
    <h1>Perfil do Operador - <?php echo $_SESSION['nome'] ?></h1>
    <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
            <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error'])
            ?>
            </div>            
    <?php endif; ?>
    <?php if(isset($_SESSION['msg'])): ?>
        <div class="alert alert-success">
            <?php 
                echo $_SESSION['msg'];
                unset($_SESSION['msg'])
            ?>
            </div>   
     <?php endif; ?>   
    <div class="d-flex justify-content-around align-items-center">
        <div class="leftside">
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
        <div class="rightside">   

                <h1>Editar Usuário</h1>
                
                <form action="profile_action.php" method="post">
                    <input type="hidden" name="id" value="<?=$_SESSION['id'];?>" >
                    <div class="mb-3">
                        <label for="" class="form-label">
                            Nome: <br/>
                            <input type="text" class="form-control" name="name" value="<?=$banco['nome'];?>"  />
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">
                            Trocar a senha: <br/>
                            <input type="password" name="password" class="form-control" value="<?=$banco['senha'];?>" />
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">
                            Confirmar a Senha: <br/>
                            <input type="password" name="password_confirm" class="form-control" value="<?=$banco['senha'];?>">           
                        </label>
                    </div>
                    
                    <input type="submit" value="Salvar" class="btn btn-primary" />
                </form>      
        
        </div>
    </div>  
</div>    

<?php include 'footer.php'; ?>