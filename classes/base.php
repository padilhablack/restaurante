<?php

require_once (dirname(__FILE__) . '/autoload.php');
protegerArquivo(basename(__FILE__));
require_once 'Banco.php';

abstract class Base extends Banco {

    //propriedades
    public $tabela = null;//tabela do banco
    public $campos_valores = array();//banco
    public $campopk = null;// id do campo
    public $valorpk = null;// id do valor do campo
    public $extras_select = null;// todos os valores

    //metodos

    public function addCampo($campo = null, $valor = null) {
        if ($campo != null):// se campo nao estiver vazio
            $this->campos_valores[$campo] = $valor; // banco recebe a tabela
        endif;
    }

//fim addCampo

    public function delCampo($campo = null) {
        if (array_key_exists($campo, $this->campos_valores)):// se o campo existir na tabela
            unset($this->campos_valores[$campo]);// deleta o campo
        endif;
    }

//delCampo
    public function setValor($campo = null, $valor = null) {
        if ($campo != null && $valor != null):// se campo e valor nao estiverem vazios
            $this->campos_valores[$campo] = $valor; //tabela recebe valor
        endif;
    }

    //setValor

    public function getValor($campo = null) {
        if ($campo != null && array_key_exists($campo, $this->campos_valores)):
            return $this->campos_valores[$campo];
        else :
            return false;
        endif;
    }

    //getValor

    public function setEmail($campo = null, $valor = null) {
        if ((substr_count($valor, "@") == 1) && substr_count($valor, ".") == 1):
            $this->campos_valores[$campo] = $valor;
        endif;
    }

    
}
