<?php

incializa();

function incializa() {
    if (file_exists(dirname(__FILE__) . '/config.php')):// pega o caminho absoluto
        require_once(dirname(__FILE__) . '/config.php'); // se existir ele dá um require senao ele dá um die
    else:
        die(utf8_decode("O arquivo de configuração não foi instalado, contate o administrador"));
    endif;
    require_once (BASEPATH . ClASSESPATH . 'autoload.php'); // faz requisição dessas classes
}

// funcao de inicialização

function loadCSS($arquivo = null, $media = 'screen', $import = FALSE) {
    if ($arquivo != null):
        if ($import == true):
            echo '<style type="text/css">@import url("' . BASEURL . CSSPATH . $arquivo . '.css");</style>';
        else:
            echo '<link rel="stylesheet" type="text/css" href="' . BASEURL . CSSPATH . $arquivo . '.css" media="' . $media . '"/>';
        endif;

    endif;
}

// carrega java script
function loadJS($arquivo = null, $remoto = FALSE) {
    if ($arquivo != null):
        if ($remoto == FALSE):// se remoto for false
            $arquivo = BASEURL . JSPATH . $arquivo . '.js';
            echo '<script type="text/javascript" src="' . $arquivo . '"></script>' . "\n";
        endif;
    endif;
}

//carrega módulos

function loadModulo($modulo = null, $tela = null) {// recebe qual o modulo e a tela a carregar 
    if ($modulo == null || $tela == null):
        echo '<p> Erro na função <strong>' . __FUNCTION__ . '</string>:faltam parametros para execução</p>';
    else:
        if (file_exists(MODULOSPATH . "$modulo.php")):// se exitir no modulo retorna o modulo
            include_once (MODULOSPATH . "$modulo.php");
        else:
            echo '<ph>Modulo inexistente neste sistema</p>';
        endif;
    endif;
}

function protegerArquivo($nomeArquivo, $header = 'index') {
    $url = $_SERVER["PHP_SELF"];
    if (preg_match("/$nomeArquivo/i", "$url")):// verifica se exite o nome do arquivo na url       
        aviso("Faça login!");
        redireciona($header);
    endif;
}

function redireciona($url = '') {
    header('Location: ' . BASEURL . $url);
}

function codificasenha($senha) {
    return md5($senha);
}

function verificaLogin() {
    $sessao - new sessao();
    if ($sessao->getNvars() <= 0 || $sessao->getVar('logado') != true):
        redireciona('?erro=3');
    endif;
}

function aviso($mensagem) {
    echo"<script language = 'javascript'> alert('$mensagem'); </script>";
    echo("<meta charset='utf-8'/><script language = 'javascript'> location.href = 'index.php'; </script>");
}

function exibirMensagem($msg = null, $tipo = null) {
    if ($msg != null):
        switch ($tipo):
            case 'erro':
                echo '<div class="erro">' . $msg . '</div>';
                break;
            case 'alerta':
                echo '<div class="alerta">' . $msg . '</div>';
                break;
            case 'pergunta':
                echo '<div class="pergunta">' . $msg . '</div>';
                break;
            default :
                echo '<div class="sucesso ">' . $msg . '</div>';
                break;
        endswitch;
    endif;
}

function isAdmin() {
    @$sessao = new sessao();
    if (isset($_SESSION['ra'])) {
        $user = new funcionario(array(
            'admin' => null,
        ));
        $iduser = $_SESSION['ra'];
        $user->extras_select = "WHERE ra = $iduser";
        $user->seleciona($user);
        $res = $user->retornaDados();

        if (strtolower($res->admin) == 's'):
            return TRUE;
        else:
            return FALSE;
        endif;

     
    }
}
