<?php require_once ("./funcoes.php"); ?>
<html>
    <head>
        <title>Painel administrativo</title>
        <meta charset="UTF-8">
        <?php
        loadCSS('reset');
        loadCSS('style');
        loadJS('jquery');
        loadJS('geral');
        ?>
    </head>
    <body>
        <?php
        loadModulo('usuarios', 'login');
        ?>
    </body>
</html>
