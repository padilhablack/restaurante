<?php
include_once 'classes/HorasDiarias.php';
include_once 'classes/Horario.php';
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
        $hora = new Horario();
        $hora->seleciona($hora);
        $reshora = $hora->retornaDados();

        $user = new funcionario();
        $user->seleciona($user);
        $res = $user->retornaDados();
        
        $horageral = new Horario();
        $horageral->seleciona($horageral);
        $reshorageral = $horageral->retornaDados();

        $diarias = new HorasDiarias();
        $diarias->seleciona($diarias);
        $resdiaria = $diarias->retornaDados();
     
         
        

        while ($res = $user->retornaDados() && $reshora = $hora->retornaDados() && $resdiaria = $diarias->retornaDados() ):
            $resultdiaria = $reshora->entrada - $reshora->saida;
            
            //condição da hora
            
            echo '<tr>';
            printf('<td class="center">%s</td>', $res->ra);
            printf('<td class="center">%s</td>', $res->nome);
            printf('<td class="center">%s</td>', date("d/m/y", strtotime($res->data)));
            printf('<td class="center">%s</td>', $reshora->entrada);
            printf('<td class="center">%s</td>', $reshora->saida);
            printf('<td class="center">%s</td>', $resultdiaria);
            printf('<td class="center"><a  href="?m=usuarios&t=deleterodizio&ra=%s" " title="Adicionar ao rodízio"><img src="images/delete"/></a> ', $res->alunos
            );
            echo '</tr>';
        endwhile;
        ?> 
    </tbody>
</table>
