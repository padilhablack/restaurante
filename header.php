<?php
require_once ("funcoes.php");
protegerArquivo(basename(__FILE__));
?>
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

<body id="geral">
  
    <img class="logo" src="images/logo.png"/>
    <label id="welcome"><?php echo $_SESSION['nome'];?></label>
        <div id="menu-wrapper">

            <div id="menu">
                <ul>
                    <li><a href="?m=usuarios&t=inicio">Inicio</a></li>
                    <!--...<li class="parent">
                        <a href="?m=usuarios&t=algo"><span></span>
                            <ul class="submenu">
                                <li></li>
                                <li>aqui</li>
                            </ul>
                        </a>
                    </li> -->

                    <li><a href="?m=usuarios&t=alunos">Alunos</a></li>
                    <li><a href="?m=usuarios&t=departamentos">Departamentos</a></li>
                    <li><a href="?m=usuarios&t=rodizios">Rodizios</a></li>
                    <li><a href="?m=usuarios&t=mensagem">Mensagem</a></li>
                    <li><a href="classes/logout.php">Sair</a></li>

                </ul>
            </div>
            <!-- end #menu -->
        </div>

</body>
