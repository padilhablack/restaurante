

<form id="form rodizio">
    <label for="nome">Nome:</label>
    <input type="text" name="nome"/>
    <label for="nome">Data:</label>
    <input type="datetime" name="data" value="<?php ?>"/>
    <input type="submit" value="criar"/>
</form>

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
                <th>RA</th><th>Nome</th><th>Bolsa</th><th>Data</th><th>Adicionar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user = new funcionario();
            $user->seleciona($user);

            while ($res = $user->retornaDados()):
                echo '<tr>';
                printf('<td class="center">%s</td>', $res->ra);
                printf('<td class="center">%s%s</td>', $res->nome, $res->sobrenome);
                printf('<td class="center">%s</td>', $res->bolsa);
                printf('<td class="center">%s</td>', date("d/m/y", strtotime($res->dataCad)));
                printf('<td class="center"><a  href="?m=usuarios&t=addrodizio&ra=%s" " title="Adicionar ao rodízio"><img src="images/add"/></a> ', $res->ra, $res->ra, $res->ra, $res->ra
                );

                echo '</tr>';
            endwhile;
            ?> 
        </tbody>
    </table>




