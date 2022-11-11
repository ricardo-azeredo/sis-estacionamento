<?php
    session_start();
    ob_start();
    require 'config.php';
    require 'head.php';
    require 'header.php';
   
?>

<div class="container">
    <h1>Cadastro de Veículo</h1>

    <form action="veiculo_action.php" method="post" class="mb-4">
        <input type="hidden" name="operador" value="<?php echo $_SESSION['nome']; ?>">
        <div class="mb-3">
            <label for="" class="form-label">
                Cliente:
                <input type="text" name="cliente" class="form-control">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                Contato:
                <input type="text" name="contato" class="form-control">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                Veículo:
                <select class="form-select" name="veiculo" aria-label="Default select example">
                    <option selected>Selecione o Veículo</option>
                    <option value="1">Moto</option>
                    <option value="2">Carro</option>
                </select>
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                Placa:
                <input type="text" name="placa" class="form-control">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                Marca:
                <input type="text" name="marca" class="form-control">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                Modelo:
                <input type="text" name="modelo" class="form-control">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                data:
                <input type="date" name="data" class="form-control">
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                Hora:
                <input type="time" name="hora" class="form-control">
            </label>
        </div>
        <input type="submit" class="btn btn-primary" name="Cadastrar" value="Cadastrar">
        <a href="index.php" class="btn btn-danger">Cancelar</a>
    </form>

</div>

<?php include 'footer.php'; ?>