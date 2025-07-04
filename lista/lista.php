<!-- back end da lista de cadastrados -->
<?php
session_start();
include("../cabecalho.php");
// conexão dom o banco de dados
include("../conexao.php");

?>

<!DOCTYPE html>
<html lang="en">
<!-- script para chamar exclusão -->
<script language="Javascript">
    function confirmacao(id) {
        var resposta = confirm("Deseja remover esse registro?");
        if (resposta == true) {
            window.location.href = "/parque/lista/lista_excluir.php?id=" + id;
        }
    }
</script>
<!-- script para formatação da tabela -->
<script>
    $(document).ready(function() {
        $('.tablista').DataTable({
            // 
            "iDisplayLength": -1,
            "order": [1, 'asc'],
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [8]
            }, {
                'aTargets': [0],
                "visible": true
            }],
            "oLanguage": {
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sLengthMenu": "_MENU_ resultados por página",
                "sInfoFiltered": " - filtrado de _MAX_ registros",
                "oPaginate": {
                    "spagingType": "full_number",
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",

                    "sLast": "Último"
                },
                "sSearch": "Pesquisar",
                "sLengthMenu": 'Mostrar <select>' +
                    '<option value="5">5</option>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="40">40</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> Registros'
            }
        });

    });
</script>

<!--  front end da aplicação -->

<body>
    <div class="container-fluid">

        <!-- aba trabalhadores suas-->
        <div role="tabpanel" class="tab-pane" id="suas">
            <a class='btn btn btn-sm' class="btn btn-primary" href='\parque\lista\gera_xls.php?id=2'><img src='\parque\imagens\excell.png' alt='' width='25' height='25'> Gerar Planilha</a>
            <div style="padding-top:15px;padding-left:20px;">
                <table class="table table display table-active tablista">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Período</th>
                            <th scope="col">Nome Criança</th>
                            <th scope="col">Data Nasc.</th>
                            <th scope="col">Idade</th>
                            <th scope="col">CPF Criança</th>
                            <th scope="col">Responsável</th>
                            <th scope="col">CPF Resposável</th>
                            <th scope="col">Telefone</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // faço a Leitura da tabela com sql
                        $c_sql = "SELECT criancas.id, criancas.nome_crianca,criancas.`data`, criancas.turno, criancas.datanasc,
                                criancas.cpf_crianca, criancas.nome_responsavel, criancas.cpf_responsavel, criancas.telefone,
                                case
                                when criancas.turno ='1' then 'Das 8h às 11h30'
                                when criancas.turno ='2' then 'Das 13h às 16h30'
                                END AS desc_turno
                                FROM criancas
                                ORDER BY criancas.`data`";
                        $result = $conection->query($c_sql);
                        // verifico se a query foi correto
                        if (!$result) {
                            die("Erro ao Executar Sql!!" . $conection->connect_error);
                        }

                        // insiro os registro do banco de dados na tabela 
                        while ($c_linha = $result->fetch_assoc()) {
                            $c_data_evento = date("d-m-Y", strtotime(str_replace('/', '-', $c_linha['data'])));
                            $c_data_nasc = date("d-m-Y", strtotime(str_replace('/', '-', $c_linha['datanasc'])));
                            // calculo de idade
                            $dataNascimento = $c_linha['datanasc'];
                            $date = new DateTime($dataNascimento);
                            $interval = $date->diff(new DateTime(date('Y-m-d')));
                            $i_idade = $interval->format('%Y Anos');
                            echo "
                                <tr>
                                    <td>$c_data_evento</td>
                                    <td>$c_linha[desc_turno]</td>
                                    <td>$c_linha[nome_crianca]</td>
                                    <td>$c_data_nasc</td>
                                    <td>$i_idade</td>
                                    <td>$c_linha[cpf_crianca]</td>
                                    <td>$c_linha[nome_responsavel]</td>
                                    <td>$c_linha[cpf_responsavel]</td>
                                    <td>$c_linha[telefone]</td>
                                    <td>
                                       <a class='btn' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span></a>
                                    </td>

                                </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>

</html>