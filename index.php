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

    $cliente = filter_input(INPUT_GET, 'cliente');
    $veiculo = filter_input(INPUT_GET, 'veiculo');
    $placa = filter_input(INPUT_GET, 'placa');

    $lista = $pdo->query("SELECT e.data, e.hora, cl.cliente, cl.contato, v.tipo ,v.placa,v.modelo, u.nome as opearador FROM estacionamento as e inner join clientes as cl on e.cliente_id = cl.id inner join veiculos as v on cl.id = v.cliente_id inner join usuario as u on e.operador_id = u.id Where cl.cliente like '%$cliente%' and v.tipo like '%$veiculo%' and placa like '%$placa%'");


?>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="profile mb-3">
            <a href="profile.php" class="btn btn-primary">Perfil do Operador</a>
            <a href="cadastrar_veiculo.php" class="btn btn-primary">Cadastrar veículo</a>
        </div>

        <div class="mb-3">
            <form action="" method="get">
                <label for="">
                    Pesquisar:
                </label>   
                <div class="d-flex">
                    <input class="form-control" type="search" name="cliente" placeholder="buscar por cliente...">
                    <input class="form-control" type="search" name="veiculo" placeholder="buscar por veículo...">
                    <input class="form-control" type="search" name="placa" placeholder="buscar por placa...">
                    <input class="btn btn-primary" type="submit" value="Buscar">
                </div> 
                
            </form>
            <table class="table mt-3">
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Contato</th>
                    <th>Veículo</th>
                    <th>Placa</th>
                    <th>Modelo</th>
                    <th>Operador</th>
                </tr>
            <?php foreach($lista as $pessoa): ?>
                <tr>
                    <td><?=$pessoa[0]?></td>
                    <td><?=$pessoa[1]?></td>
                    <td><?=$pessoa[2]?></td>
                    <td><?=$pessoa[3]?></td>
                    <td><?php 
                        if($pessoa[4]==1){
                             echo "Moto";  
                        } else if($pessoa[4]==2) {
                            echo "Carro";                       
                        }                            
                        ?>                    
                    </td>
                    
                    <td><?=$pessoa[5]?></td>
                    <td><?=$pessoa[6]?></td>
                    <td><?=$pessoa[7]?></td>
                </tr>
                <?php endforeach; ?>
            </table>

        </div>
        
    </div>

   

<?php include 'footer.php'; ?>