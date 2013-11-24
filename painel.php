<?php
require_once './classes/sessao.php';
require 'funcoes.php';
$sessao = new sessao();

loadCSS();

$login = (isset($_SESSION['nome'])) ? $_SESSION['nome'] : "";
$descricao = (isset($_SESSION['ra'])) ? $_SESSION['ra'] : "";

$modulo = (isset($_GET['m'])) ? $_GET['m'] : "";
$tela = (isset($_GET['t'])) ? $_GET['t'] : "";

if (isset($login) && ($descricao)) { // verifica se sessão existe
    ?>
       
    <?php include_once 'header.php';
    ?>
    <div id="content">
        <?php

        if ($modulo && $tela ):
            loadModulo($modulo, $tela);
        endif;
        ?>

    </div>
    <?php include_once 'footer.php'; ?>

    <?php
} else {
    aviso("Faça Login!");
}
?>