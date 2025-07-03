<?php
include("cabecalho.php");

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
        <!-- formulário com data e turno -->
        <form method="post">
            <hr>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Data do evento </label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="data" value="<?php echo $c_data ?>" required>
                </div>
            </div>
            <div class="row mb-3">

                <div class="col-sm-3">
                    <p>
                    <strong>Escolha o turno </strong>
                    </p>
                    <div class="form-check">
                        <input type="radio" name="turno" id="turno1" Value="1" requered>
                        <label class="form-check-label" for="turno1">
                            Das 8h às 11h30
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="turno" id="turno2" value="2">
                        <label class="form-check-label" for="turno2">
                            Das 13h às 16h30
                        </label>
                    </div>
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