 
<?php
require_once (dirname(dirname(__FILE__)) . "/funcoes.php");
require_once (BASEPATH . ClASSESPATH . "usuarios.php");

$logar = (isset($_POST['logar'])) ? $_POST['logar'] : "";
$ra = (isset($_POST['ra'])) ? $_POST['ra'] : "";
$senha = (isset($_POST['senha'])) ? $_POST['senha'] : "";
if (isset($_POST['logar'])):
    $user = new funcionario();
    $user->setValor('ra', $_POST['ra']);
    $user->setValor('senha', $_POST['senha']);
    if ($user->doLogin($user)):
        redireciona('painel.php?m=usuarios&t=inicio');
    else:
        aviso("Usuario ou seha indefinidos");
    endif;
endif;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
        <?php
        loadCSS('style');
        loadJS('jquery');
        loadJS('geral');
        loadJS('jquery-validate');
        loadJS('jquery-validate-messages');
        ?>


    </head>
    <body bgcolor="#233b48">
        <div class="flip"><img class="logo_start" src="/images/logo.png"/></div>
        <label class="logo_nome">Restaurante UNASP-EC</br>
        </label>
        <div id="login" >
            <div class="usarform">
                <form action="login.php" method ="POST">
                    <label for="ra">RA: </label><input type="text"  class="txt " name ="ra" value=""/>
                    <label for="senha">Senha: </label><input type="password"  class="txt" name="senha" value=""/></br>
                    <input type="submit" name="logar" class ="submit" value="Login"/>
                </form>            
            </div>
        </div>
</html>

