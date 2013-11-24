<?php

require_once dirname(dirname(__FILE__)) . "/funcoes.php";
protegerArquivo(basename(__FILE__));

class sessao {

    protected $id; // id da secao
    protected $nvars; // numero de variaveis que a sessao tem

    public function __construct($inicia = true) {
        if ($inicia == true): // inicia a sessao
            $this->start(); 
        endif;
    }

    public function start() {
        session_start(); 
        $this->id = session_id();// seta o id na secao
        $this->setNvars();//seta o numero de variaves na secao
    }

    public function setNvars() {
        $this->nvars = sizeof($_SESSION);//seta o numero de variaveis
    }

    public function getNvars() {
        return $this->nvars;
    }

    public function setVar($var, $valor) {
        $_SESSION[$var] = $valor;
        $this->setNvars();
    }

    public function unsetVar($var) {
        unset($_SESSION[$var]);
        $this->setNvars();
    }

    public function getVar($var) {
        if (isset($_SESSION[$var])):
            return $_SESSION[$var];
        else:
            return NULL;
        endif;
    }

    public function destroi($inicia = false) {
        session_unset();
        session_destroy();
        $this->setNvars();
        if ($inicia == true):
            $this->start();
        endif;
    }

    public function printAll() {
        foreach ($_SESSION as $k => $v):
            printf("%s = %s<br />", $k, $v);
        endforeach;
    }

}

?>