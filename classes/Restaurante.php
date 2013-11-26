<?php
protegerArquivo(basename(__FILE__));
@$sessao = new sessao;
if (isAdmin() == true):
    ?>
    <script type="text/javascript" >
        $(document).ready(function() {
            $('#list').dataTable({
                "oLanguage": {
                    "sLengthMenu": "Display _MENU_ records per page",
                    "sZeroRecords": "Nada encontrado.",
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
                <th>RA</th><th>Nome</th><th>Ramal</th><th>Curso</th><th>Bolsa</th><th>Email</th><th>Status</th><th>Setor</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $userbd = new funcionario();
            $userbd->extras_select = " WHERE setor = 'Restaurante'";
             $userbd->seleciona($userbd);
    

            while ($resbd = $userbd->retornaDados()):
                echo '<tr>';
                printf('<td class="center">%s</td>', $resbd->ra);
                printf('<td class="center">%s %s</td>', $resbd->nome, $resbd->sobrenome);
                printf('<td class="center">%s</td>', $resbd->ramal);
                printf('<td class="center">%s</td>', $resbd->curso);
                printf('<td class="center">%s</td>', $resbd->bolsa);
                printf('<td class="center">%s</td>', $resbd->email);
                printf('<td class="center">%s/%s</td>', strtoupper($resbd->ativo), strtoupper($resbd->admin));
                printf('<td class="center">%s</td>',$resbd->setor);
                printf('<td class="center"><a href="?m=usuarios&t=cadastro" title="Novo Cadastro"><img src="images/add"/></a> '
                        . '<a href="?m=usuarios&t=editar&ra=%s" title="Editar"><img src="images/editar"/></a>  '
                        . '<a href="?m=usuarios&t=senha&ra=%s" title="Mudar senha"><img src="images/pass"/></a>  '
                        . '<a href="?m=usuarios&t=excluir&ra=%s" title="Excluir Cadastro"><img src="images/delete"/></a> </td>', $resbd->ra, $resbd->ra, $resbd->ra, $resbd->ra
                );

                echo '</tr>';
            endwhile;
            ?> 
        </tbody>
    </table>

    <?php
else:
    exibirMensagem('</br>Voce não tem permissão para acessar a pagina</br><a href="#" onclick="history.back()">Voltar</a>', 'erro');
 endif;