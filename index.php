<!-- back end da página -->
<?php
session_start(); // icicio de session
$_SESSION['controle']='S';
include("cabecalho.php"); // arquivo de cabeçalho de página
?>

<!-- front end da página -->
<!DOCTYPE html>
<html lang="en">

<body>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="panel default class" align="center">
            <div class="panel-heading">
                <img class="rounded mx-auto d-block" class="img-responsive" src="\parque\imagens\prefeitura.png" class="img-fluid" style="height :100px" style="width:200px">
            </div>
            <br><br>
            <a id="insc" class="btn btn-primary btn-lg" href="/parque/cadastro_data_turno.php"><span class="glyphicon glyphicon-edit"></span> Clique aqui para fazer a inscrição</a>
        </div>
        <hr>
    </div>
</body>

</html>