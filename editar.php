<?php
    session_start();
    ob_start();
    require 'config.php';
    require 'head.php';
    require 'header.php';

    $info = [];

    $id = filter_input(INPUT_GET,'id');

    $lista = $pdo->query("SELECT cl.id, e.data, e.hora, cl.cliente, cl.contato, v.tipo ,v.placa,v.marca,v.modelo, e.status, u.nome as opearador FROM estacionamento as e inner join clientes as cl on e.cliente_id = cl.id inner join veiculos as v on cl.id = v.cliente_id inner join usuario as u on e.operador_id = u.id Where e.id = $id");     

      
    //Verifica se id é válido.
    if($lista->rowCount() > 0 ) {
        //o método fecth vai pegar o primeiro resultado.
        $info = $lista->fetch(PDO::FETCH_ASSOC);
       
    } else {
        header("Location: index.php");
        exit;
    }

      
?>

<div class="container">
    <h1>Editar de Veículo</h1>

    <form action="editar_action.php" method="post" class="mb-4">
        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
        <div class="mb-3">
            <label for="" class="form-label">
                Cliente:
                <input type="text" name="cliente" class="form-control" value="<?=$info['cliente'];?>">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                Contato:
                <input type="text" name="contato" class="form-control" value="<?=$info['contato'];?>">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                Veículo:
                <select class="form-select" name="veiculo" aria-label="Default select example">
                    <option value="<?=$info['tipo'];?>" >
                    <?php if ($info['tipo'] == 1){
                        echo "Moto";
                    }else {
                        echo "Carro";
                    }
                    ?>
                    </option>                    
                </select>
            </label>
        </div>
        <div class="mb-3">
            <label class="form-label">
                Placa:
                <input type="text" name="placa" class="form-control" value="<?=$info['placa'];?>">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label" >
                Marca:
                <input type="text" name="marca" class="form-control" value="<?=$info['marca'];?>">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label" >
                Modelo:
                <input type="text" name="modelo" class="form-control" value="<?=$info['modelo'];?>">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                data:
                <input type="date" name="data" class="form-control" value="<?=$info['data'];?>">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                Hora:
                <input type="time" name="hora" class="form-control" value="<?=$info['hora'];?>">
            </label>
        </div>
        <input type="submit" class="btn btn-primary" name="Salvar" value="Salvar">
        <a href="index.php" class="btn btn-danger">Cancelar</a>
    </form>

</div>

<?php include 'footer.php'; ?>