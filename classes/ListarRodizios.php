<?php
?>
 <script type="text/javascript" >
        $(document).ready(function() {
            $('#list').dataTable({
                "oLanguage": {
                    "sLengthMenu": "Display _MENU_ records per page",
                    "sZeroRecords": "Nothing found - sorry",
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
                <th>RA</th><th>Nome</th><th>Data</th><th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $user = new Rodizio();
            $user->seleciona($user);

            while ($res = $user->retornaDados()):
                echo '<tr>';
                printf('<td class="center">%s</td>', $res->alunos);
                printf('<td class="center">%s</td>', $res->nome);
                printf('<td class="center">%s</td>', date("d/m/y", strtotime($res->data)));
                printf('<td class="center"><a  href="?m=usuarios&t=deleterodizio&ra=%s" " title="Adicionar ao rodízio"><img src="images/delete"/></a> ',$res->alunos
                );
                echo '</tr>';
            endwhile;
            ?> 
        </tbody>
    </table>
