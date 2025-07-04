<?php // controle de acesso ao formulário
session_start();


if (!isset($_GET["id"])) {
    header('location: /parque/lista/lista.php');
    exit;
}
$c_id = "";
$c_id = $_GET["id"];
// conexão dom o banco de dados
include("../conexao.php");
// Exclusão do registro
$c_sql = "delete from criancas where id=$c_id";
echo $c_sql;
echo $c_id;
$result = $conection->query($c_sql);

header('location: /parque/lista/lista.php');