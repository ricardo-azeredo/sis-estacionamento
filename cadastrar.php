<?php
    session_start();
    ob_start();
    require 'head.php';
?>
<div class="d-flex justify-content-between align-items-center">
    <div class="leftlogin">
        <img src="./images/estacionamento.jpg" alt="">
    </div>
    <div class="rightlogin">
        <?php if(isset($_SESSION['msg'])): ?>
                <div class="alert alert-danger">
                <?php 
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg'])
                ?>
                </div>
        <?php endif; ?>
         <div class="loginArea">
             <form action="cadastrar_login.php" method="post">
                <h1>Adicionar Usuário</h1>
                <div class="mb-3">
                    <label for="" class="form-label">
                        Nome: <br/>
                        <input type="text" name="name" class="form-control">
                    </label>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">
                        E-mail: <br/>
                        <input type="email" name="email" class="form-control">
                    </label>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">
                        Senha: <br/>
                        <input type="password" name="password" class="form-control">
                    </label>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">
                        Confirmar a Senha: <br/>
                        <input type="password" name="password_confirm" class="form-control">
                    </label>
                </div>
                
                <input type="submit" value="Adicionar" class="btn btn-primary"/>
        
             </form>   
         </div>  

    </div>
    

</div>

<?php require 'footer.php'; ?>