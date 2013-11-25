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
            </br> </br> </br>
            <label id="titulo"><a href="?m=usuarios&t=listar"><h3>Alunos cadastrados</h3></a></label></b>
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
        echo 'Alunos Cadastrados<br/>';
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
    case 'mensagem':
        include 'pages/mensagem.php';
        ?>

        <?php
        break;
    case 'rodizios':
        ?>


        <a href="?m=usuarios&t=listaatual"><?php echo 'lista atual' ?></a>
        <a href="?m=usuarios&t=novalista">nova lista</a>

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
        ;
        break;
        ?>

    <?php
    case 'listaatual':
        include_once 'classes/rodizio.php';
        include 'classes/ListarRodizios.php';
        ;
        break;
        ?>
        <?php
        break;
    default :
        echo'<p> a tela solicitada não existe</p>';
        break;
endswitch;
?>
