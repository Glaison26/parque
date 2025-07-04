
<?php
session_start();

//echo "<h1>Gerar Excel - csv</h1>";
// conexão dom o banco de dados
include("../conexao.php");
// Aceitar csv ou texto 
header('Content-Type: text/csv; charset=utf-8');
$parametro = $_GET['id'];


// Nome arquivo

header('Content-Disposition: attachment; filename=inscritos.csv');


// Gravar no buffer
$resultado = fopen("php://output", 'w');

//mb_convert_encoding('Endereço', "ISO-8859-1", "UTF-8")

// Criar o cabeçalho do Excel - Usar a função mb_convert_encoding para converter carateres especiais'
// faço a Leitura da tabela com sql
if ($parametro == '1') {
    $c_sql = "SELECT criancas.id, criancas.nome_crianca,criancas.`data`, criancas.turno, criancas.datanasc,
                                criancas.cpf_crianca, criancas.nome_responsavel, criancas.cpf_responsavel, criancas.telefone,
                                case
                                when criancas.turno ='1' then 'Das 8h às 11h30'
                                when criancas.turno ='2' then 'Das 13h às 16h30'
                                END AS desc_turno
                                FROM criancas
                                ORDER BY criancas.`data`";
    $result = $conection->query($c_sql);
    $cabecalho = [
        'Id',
        'Nome Criança',
        'Data',
        'Período',
        'Data Nascimento',
        'cpf criança',
        'Responsável',
        'cpf Responsável',

    ];
}


$cabecalho = mb_convert_encoding($cabecalho, "ISO-8859-1", "UTF-8");
// Abrir o arquivo
//$arquivo = fopen('file.csv', 'w');

// Escrever o cabeçalho no arquivo
fputcsv($resultado, $cabecalho, ';');
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql!!" . $conection->connect_error);
}

// Array de dados
// insiro os registro do banco de dados na tabela 
while ($c_linha = $result->fetch_assoc()) {
    fputcsv($resultado, mb_convert_encoding($c_linha, "ISO-8859-1", "UTF-8"), ';');
}
// Fechar arquivo
fclose($resultado);
