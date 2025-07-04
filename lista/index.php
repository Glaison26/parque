<?php
session_start();
include("../cabecalho.php"); // arquivo de cabeçalho de página
$c_senha = "";
$msg_erro = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    do {
        $c_senha = $_POST['senha'];
        if ($c_senha == 'parque@2025')
            header('location: /parque/lista/lista.php');
        else {
            $msg_erro = "Senha informada inválida!!";
            break;
        }
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">


<body>
    <div class="container -my5">
        <div class="container">
            <div class="alert alert-success">
                <strong> Prefeitura Municipal de Sabará - Pagina Inicial da plataforma.</strong>
            </div>
            <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-danger' role='alert'>
                <h4>$msg_erro</h4>
            </div>
                ";
        }
        ?>
            <form method="post">

                <div class="row mb-2">
                    <label class="col-sm-2 col-form-label">Senha de Entrada</label>
                    <div class="col-sm-2">
                        <input type="password" maxlength="20" class="form-control" name="senha" value="<?php echo $c_senha ?>" required>
                    </div>
                    <div class="container -my5" class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
                        <br>
                        <button type="submit" class="btn btn-primary"><img src="\parque\imagens\login.png" alt="" width="30" height="20"></span> Fazer login</button>
                        <hr>
                    </div>
                    <div class="panel default class" class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                        <div class="panel-heading">
                            <img class="rounded mx-auto d-block" class="img-responsive" src="\parque\imagens\prefeitura.png" class="img-fluid" style="height :100px" style="width:100px">
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

</body>

</html>