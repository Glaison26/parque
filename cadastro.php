<?php
session_start(); // icicio de session
if (!isset($_SESSION['controle'])) {
    die('Acesso não autorizado!!!');
}
if ($_SESSION['controle'] != 'S') {
    die('Acesso não autorizado!!!');
}
include("cabecalho.php");
include("conexao.php");
include("lib_gop.php");
// declarações de variaveis de entrada
$c_nome_responsavel = "";
$c_nome_crianca = "";
$c_cpf_crianca = "";
$c_cpf_responsavel = "";
$c_data_nasc = "";
$c_telefone = "";
$msg_erro = "";  // variável de erro de consistencia
// inicio do metodo post para consistir e gravar os dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    do {
        if ($_SESSION['controle'] != 'S') {
            die('Operação não autorizada, entre novamente na aplicação!!!');
        }
        $c_nome_responsavel = rtrim($_POST['nome_responsavel']);
        $c_nome_crianca = rtrim($_POST['nome_crianca']);
        $c_cpf_crianca = $_POST['cpf_crianca'];
        $c_cpf_responsavel = $_POST['cpf_responsavel'];
        $c_data_nasc = $_POST['data_nas'];
        $c_telefone = $_POST['telefone'];
        // consistencia do cpf do responsável
        if (!validaCPF($c_cpf_responsavel)) {
            $msg_erro = "CPF do responsável Inválido!!!";
            break;
        }
        // consistencia do cpf da criança
        if (!validaCPF($c_cpf_crianca)) {
            $msg_erro = "CPF da Criança Inválido!!!";
            break;
        }
        // consiste cpf da criança deve ser diferente do responsável
        if ($c_cpf_crianca == $c_cpf_responsavel) {
            $msg_erro = "CPF do responsável deve ser diferente ao da criança!!!";
            break;
        }
        // verifico se criança já consta no banco de dados atrvés do cpf
        $c_sql = "select count(*) as quantidade from criancas where criancas.cpf_crianca = '$c_cpf_crianca'";
        //echo $c_sql;
        $result = $conection->query($c_sql);
        $c_linha = $result->fetch_assoc();
        $i_qtd = $c_linha['quantidade'];
        if ($i_qtd > 0) {
            // sql para pegar data e turno da criança já cadastrada
            $c_sql = "select criancas.data, criancas.turno from criancas where criancas.cpf_crianca = $c_cpf_crianca";
            $result = $conection->query($c_sql);
            $c_linha = $result->fetch_assoc();

            $c_data = date("d-m-Y", strtotime(str_replace('/', '-', $c_linha['data'])));
            if ($c_linha['turno'] == '1')
                $c_turno = "Das 8h às 11h30";
            else
                $c_turno = " Das 13h às 16h30";
            $msg_erro = "Criança já tem cadastro realizado no dia " . $c_data . " turno de " . $c_turno;
            break;
        }
        // verifico se já existe um nome cadstrado
        $c_sql = "select count(*) as quantidade from criancas where criancas.nome_crianca = '$c_nome_crianca'";
        //echo $c_sql;
        $result = $conection->query($c_sql);
        $c_linha = $result->fetch_assoc();
        $i_qtd = $c_linha['quantidade'];
        if ($i_qtd > 0) {
            // sql para pegar data e turno da criança já cadastrada
            $c_sql = "select criancas.data, criancas.turno from criancas where criancas.nome_crianca = '$c_nome_crianca'";
            $result = $conection->query($c_sql);
            $c_linha = $result->fetch_assoc();

            $c_data = date("d-m-Y", strtotime(str_replace('/', '-', $c_linha['data'])));
            if ($c_linha['turno'] == '1')
                $c_turno = "Das 8h às 11h30";
            else
                $c_turno = " Das 13h às 16h30";
            $msg_erro = "Criança com este nome já tem cadastro realizado no dia " . $c_data . " turno de " . $c_turno;
            break;
        }

        // consistencia de idade somente com idade superior a 3 anos
        $dataNascimento = $_POST['data_nas'];
        $date = new DateTime($dataNascimento);
        $interval = $date->diff(new DateTime(date('Y-m-d')));
        $i_idade = $interval->format('%Y');

        if ($i_idade < 3) {
            $msg_erro = "Criança deve ter acima de 3 anos de idade";
            break;
        }
        // monto inserção do registro via sql
        $d_data = $_SESSION['data'];
        $c_turno = $_SESSION['turno'];
        $c_cpf_crianca = str_replace('.','',$c_cpf_crianca);
        $c_cpf_crianca = str_replace('-','',$c_cpf_crianca);
        $c_cpf_responsavel = str_replace('.','',$c_cpf_responsavel);
        $c_cpf_responsavel = str_replace('-','',$c_cpf_responsavel);
        $c_sql = "insert into criancas (datanasc, nome_crianca,cpf_crianca, nome_responsavel, cpf_responsavel,data,turno,telefone)
        value ('$c_data_nasc', '$c_nome_crianca', '$c_cpf_crianca', '$c_nome_responsavel','$c_cpf_responsavel','$d_data','$c_turno', '$c_telefone')";
        echo $c_sql;
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {  // erro de acesso a tabela
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        header('location: /parque/finalizar.php');
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        const handlePhone = (event) => {
            let input = event.target
            input.value = phoneMask(input.value)
        }

        const phoneMask = (value) => {
            if (!value) return ""
            value = value.replace(/\D/g, '')
            value = value.replace(/(\d{2})(\d)/, "($1) $2")
            value = value.replace(/(\d)(\d{4})$/, "$1-$2")
            return value
        }
    </script>

</head>

<body>
    <div class="container -my5">


        <div class="alert alert-success">
            <strong>Digite a data <b>entre os dias 28 de julho ao dia 1 de agosto</b> e o turno desejado para inscrição no evento férias no parque </strong>
        </div>
        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-danger' role='alert'>
                <h4>Atenção :" . " " . $msg_erro . ". Cadastro não realizado!!!</h4>
            </div>
                ";
        }
        ?>

        <!-- formulário com cadastro da criança -->
        <form method="post">
            <hr>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nome completo da Criança </label>
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
                <label class="col-sm-2 col-form-label">Nome completo da mãe ou responsável </label>
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
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">CPF da criança</label>
                <div class="col-sm-2">
                    <input type="text" maxlength="14" class="form-control" name="cpf_crianca" value="<?php echo $c_cpf_crianca ?>" placeholder="somente números" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Telefone</label>
                <div class="col-sm-2">
                    <input type="tel" onkeyup="handlePhone(event)" maxlength="25" class="form-control" name="telefone" placeholder="(99) 9999-9999" value="<?php echo $c_telefone ?>" required>
                </div>
            </div>

            <!-- Salvar informações  -->
            <hr>
            <div class="container-fluid" class="col-sm-0">

                <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                <a class='btn btn-danger' href='/parque/index.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>

            </div>
        </form>
    </div>

</body>

</html>