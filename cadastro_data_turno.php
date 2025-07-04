<!-- back end da aplicação -->
<?php
session_start(); // icicio de session
include("cabecalho.php");
include("conexao.php");
$msg_erro = "";  // variável de erro de consistencia
// metodo post para submit da proxima pagina
// consistencia de número de vagas e data

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    do {
        $dt_informada = date("Y-m-d", strtotime(str_replace('/', '-',  $_POST['data'])));;
        $dt_inicio =  date('Y-m-d', strtotime('2025-07-28'));
        $dt_fim = date('Y-m-d', strtotime('2025-08-01'));
        // checagem de intervalo de data do evento 
        if (($dt_informada < $dt_inicio) || ($dt_informada > $dt_fim)) {
            $msg_erro = 'Inscrições somente serão permitidas no período do dia 28 de julho a 1o. de agosto de 2025!!!';
            break;
        }
        // checo o numero de cadastrador na data com o mesmo turno no máximo 100 inscrições por dia / turno
        // sql para apurar
        $c_turno = $_POST['turno'];
        $c_sql = "SELECT COUNT(*) AS quantidade FROM criancas 
                 WHERE criancas.`data`='$dt_informada' AND turno ='$c_turno'";
        $result = $conection->query($c_sql);
        $c_linha = $result->fetch_assoc();
        $i_qtd = $c_linha['quantidade'];
        // checo a quantidade apurada
        if ($i_qtd >= 100) {
            $msg_erro = 'Desculpe, não há mais vagas para a data e turno selecionado. Tente outra data ou turno!!!';
            break;
        }
        // capturo turno e data selecionada nas variáveis globais
        $_SESSION['turno'] = $c_turno;
        $_SESSION['data'] = $dt_informada;
        header('location: /parque/cadastro.php'); // aqui direciono para captura de foto da logo da OSC "0"
    } while (false);
}

?>

<!-- Front end da aplicação -->
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
                <h4>$msg_erro</h4>
            </div>
                ";
        }
        ?>

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
                        <strong>Escolha o período </strong>
                    </p>
                    <div class="form-check">
                        <input type="radio" name="turno" id="turno1" Value="1" required>
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