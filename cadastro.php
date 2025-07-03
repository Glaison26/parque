<?php
include("cabecalho.php");
include("conexao.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="container -my5">


        <div class="alert alert-success">
            <strong>Digite a data <b>entre os dias 28 de julho ao dia 1o. de agosto</b> e o turno desejado para inscrição no evento férias no parque </strong>
        </div>
        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-danger' role='alert'>
                <h4>Menssagem  do sistema :$msg_erro</h4>
            </div>
                ";
        }
        ?>

        <!-- formulário com cadastro da criança -->
        <form method="post">
            <hr>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nome da Criança </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nome_crianca" value="<?php echo $c_nome_crianca ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Data de Nacimento</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="data_nas" value="<?php echo $c_data_nasc ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nome do mãe ou responsável </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nome_responsavel" value="<?php echo $c_nome_responsavel ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">CPF da mãe ou responsável</label>
                <div class="col-sm-2">
                    <input type="text" maxlength="14" class="form-control" name="cpf_responsavel" value="<?php echo $c_cpf_responsavel ?>" placeholder="somente números" required>
                </div>
            </div>

            <!-- continuar ou voltar -->
            <hr>
            <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-menu-right'></span> Continuar</button>
            <a class='btn btn-secondary' href='/parque/index.php'><span class='glyphicon glyphicon-menu-left'></span> Voltar</a>
        </form>
    </div>

</body>

</html>