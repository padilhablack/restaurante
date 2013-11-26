<?php
include_once 'classes/HorasDiarias.php';
include_once 'classes/Horario.php';

if (isset($_GET['ra'])):
    $ra = $_GET['ra'];
    ?>
    <script type="text/javascript" >
        $(document).ready(function() {
            $('#list').dataTable({
                "oLanguage": {
                    "sLengthMenu": "Display _MENU_ records per page",
                    "sZeroRecords": "Nenhum resultado",
                    "sInfo": "Mostrando de _START_ á _END_ de _TOTAL_ dados cadastrados",
                    "sInfoEmpty": "Showing 0 to 0 of 0 records",
                    "sInfoFiltered": "(Filtrado de _MAX_ registros no total)",
                    "sSearch": "Pesquisar"
                },
                "sScrollY": "400px",
                "bPaginate": false,
                "aaSorting": [[0, 'asc']]
            });
        });
    </script>

    <table class="usuarios" id="list" cellpading="0" cellspacing="0"> 
        <thead>
            <tr>
                <th>RA</th><th>Nome</th><th>Data</th><th>Entrada</th><th>Saída</th><th>Diária</th><th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $diarias = new HorasDiarias();
            $diarias->seleciona($diarias);

            $ra = $_GET['ra'];
            $userbd = new funcionario();
            $userbd->extras_select = " WHERE ra=$ra";
            $userbd->seleciona($userbd);
            $resdiaria = $userbd->retornaDados();

            while ($resdiaria = $userbd->retornaDados()):

                //condição da hora
                echo '<tr>';
                printf('<td class="center">%s</td>', $resdiaria->ra);
                printf('<td class="center">%s</td>', $resdiaria->nome);
                printf('<td class="center">%s</td>', date("d/m/y", strtotime($resdiaria->data)));
                printf('<td class="center">%s</td>', $resdiaria->entrada);
                printf('<td class="center">%s</td>', $resdiaria->saida);
                printf('<td class="center">%s</td>', $resultdiaria);
                echo '</tr>';
            endwhile;
        else:
            exibirMensagem('Aluno não encontrado', 'erro');
        endif;
        ?> 
    </tbody>
</table>

