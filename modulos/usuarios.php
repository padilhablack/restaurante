<?php
require_once dirname(dirname(__FILE__)) . "/funcoes.php";
protegerArquivo(basename(__FILE__));
require_once 'classes/sessao.php';
require_once 'classes/usuarios.php';
loadCSS('dataTables');
loadJS('jquery.data-table');
loadJS('jquery.validate');
loadCSS('animate');


switch ($tela):
    case 'login':
        header('Location: ' . BASEURL . "pages/login.php/");
        break;
//fim login


    case 'inicio':
        ?>
        
        <div class="rotateIn"><img src="images/logo.png" class="image_inicio"/></div>


        <?php
        break;
    case 'alunos':
        ?>
        <div> 
            <label id="titulo"><a href="?m=usuarios&t=cadastro"><h3>Novo cadastro</h3></a></label></br>
            </br> 
            <label id="titulo"><a href="?m=usuarios&t=listar"><h3>Alunos cadastrados</h3></a></label></b>
        </br> </br>
        <label id="titulo"><a href="?m=usuarios&t=horario"><h3>Horário</h3></a></label></b>
        </div>
        <img class="image_aluno" src="images/restaurante.png"/>
        <?php
        break;
// fim alunos
    case 'cadastro': // cadastro com formulario
        include 'classes/cadastro.php';
        break;
// fim cadastro 

    case 'listar':
        include 'classes/listar.php';
        break;

    case 'editar':
        include 'classes/editar.php';
        break;
    //fim de Editar

    case 'senha':
        include 'classes/senha.php';
        break;

    case 'excluir':
        include 'classes/excluir.php';
        break;


    case 'departamentos':
        ?>
        <img class="image_aluno" src="images/campo.png" />
        <label id="titulo"><a href="?m=usuarios&t=padaria"><h3 >Padaria</h3></a></label></br>
        </br>
        <label id="titulo"><a href="?m=usuarios&t=restaurante"><h3>Restaurante</h3></a></label></br>
        </br>
        <label id="titulo"><a href="?m=usuarios&t=cozinha"><h3>Cozinha</h3></a></label></br>
        <?php
        break;

    case 'padaria':
        include_once 'classes/Padaria.php';
        break;
    case 'restaurante':
        include_once 'classes/Restaurante.php';
        break;
    case 'cozinha':
   include_once 'classes/Cozinha.php';
        break;
    case 'mensagem':
        include 'pages/mensagem.php';
        ?>

        <?php
        break;
    case 'rodizios':
        ?>
        <img src="images/fundo.png" style="width: 600; height: 300; position: absolute; margin-top: 250px; margin-left: 400px;" />
        <label id="titulo"><a href="?m=usuarios&t=listaatual"><h3>Lista Atual</h3></a></label></br></br>
        <label id="titulo"><a href="?m=usuarios&t=novalista"><h3>Adicionar á Lista</h3></a></label>

        <?php
        break;

    case 'novalista':
        include 'classes/lista.php';
        break;
        ?>
    <?php
    case 'addrodizio':
        include_once 'classes/rodizio.php';
        include 'classes/AddRodizio.php';

        break;

    case'deleterodizio':
        include 'classes/exRodizio.php';
        ?>

    <?php
    case 'listaatual':
        include_once 'classes/rodizio.php';
        include 'classes/ListarRodizios.php';
        ;
        break;
        ?>
    <?php
    case 'horario':
        ?>
        <img src="images/relogio.png" style="width: 589; height: 423; position: absolute; margin-top: 50px; margin-left: 400px;" />
        <label id = "titulo"><a href = "?m=usuarios&t=marcahora"><h3>Marcar hora</h3></a></label></br></br>
        <label id = "titulo"><a href = "?m=usuarios&t=relatoriohoras"><h3>Relatório de horas</h3></a></label></br></br>

        <?php
        break;
        ;
    case 'marcahora':
        include_once 'classes/MarcaHora.php';
        break;
    case 'relatoriohoras':
        include_once 'classes/Listarhora.php';
        break;
        ?>


        <?php
        break;
    default :
        echo'<p> a tela solicitada não existe</p>';
        break;
endswitch;
?>
