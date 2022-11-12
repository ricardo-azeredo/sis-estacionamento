<?php
    session_start();
    ob_start();
    require 'head.php';
    require 'config.php';

    if(isset($_SESSION['nome'])){
        header('location: index.php');
        exit;
    }

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($dados['SendLogin'])){

        $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
        $sql->bindParam(':email', $dados['email'], PDO::PARAM_STR);
        $sql->execute();

        if(($sql) && ($sql->rowCount() != 0)){
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);

            if(password_verify($dados['password'], $resultado['senha'])){
                $_SESSION['id'] = $resultado['id'];
                $_SESSION['nome'] = $resultado['nome'];
                header('Location: index.php');
                exit;
            } else {
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
        }

        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            //Destroi a mensagem para não imprimir na tela novamente
            unset($_SESSION['msg']);
        }
    }
?>

<div class="d-flex justify-content-between align-items-center">
    <div class="leftlogin">
        <img src="./images/estacionamento.jpg" alt="">
    </div>
    <div class="rightlogin">
        <div class="loginArea">            
    
            <form action="" method="post">
                <h1>Login</h1>
                <div class="mb-3">
                    <label for="" class="form-label">
                        Email: <br/>
                        <input
                         type="email" 
                         name="email" 
                         class="form-control" 
                         value="<?php if(isset($dados['email'])){ echo $dados['email']; } ?>"
                        >
                    </label>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">
                        Senha: <br/>
                        <input type="password" name="password" class="form-control">
                    </label>
                </div>
        
                <input type="submit" value="Salvar" name="SendLogin" class="btn btn-primary" />
                <h3><a type="button" class="btn btn-link" href="cadastrar.php">Inscrever</a></h3>
            </form>

        </div>

    </div>

</div>


    
<?php include 'footer.php'; ?>