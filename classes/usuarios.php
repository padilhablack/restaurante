<?php

require_once dirname(dirname(__FILE__)) . "/funcoes.php";
protegerArquivo(basename(__FILE__));
require_once 'base.php';
require_once 'sessao.php';

class funcionario extends Base {

    public function __construct($campos = array()) {
        parent::__construct(); // vai até o contrutor da classe banco
        $this->tabela = "funcionario";
        if (sizeof($campos) <= 0):// verifica se os campos estão empty
            $this->campos_valores = array(// os campos recebem nulos pois estão vazios
                "nome" => null,
                "sobrenome" => null,
                "telefone" => null,
                "ramal" => null,
                "curso" => null,
                "email" => null,
                "senha" => null,
                "ativo" => null,
                "admin" => null,
                "ra" => null,
            );
        else:$this->campos_valores = $campos;
        endif;
        $this->campopk = "ra";
    }

    public function doLogin($objeto) {
        $objeto->extras_select = "Where ra ='" . $objeto->getValor('ra') . "' AND senha ='" . codificasenha($objeto->getValor('senha')) . "' AND ativo='s'";
        $this->seleciona($objeto);
        $sessao = new sessao();
        if ($sessao->getNvars() <= 0 || $sessao->getVar('logado') != TRUE):
            if ($this->linhasAfetadas == 1):
                $userLogado = $objeto->retornaDados();
                $sessao->setVar('nome', $userLogado->nome);
                $sessao->setVar('ra', $userLogado->ra);
                $sessao->setVar('admnistrador', $userLogado->admin);
                $sessao->setVar('status', $userLogado->ativo);
                $sessao->setVar('logado', TRUE);
                $sessao->setVar('ip', $_SERVER['REMOTE_ADDR']);
                return true;
            else:
                return false;
            endif;
        endif;
    }

    public function doLogout() {
        $sessao = new sessao();
        $sessao->destroi();
        session_start();
        $_SESSION['erro'] = '1';
        redireciona('pages/login.php');
    }

    public function existeRegistro($campo = null, $valor = null) {
        if ($campo != null && $valor != null):
            is_numeric($valor) ? $valor = $valor : $valor = "'" . $valor . "'";
            $this->extras_select = "WHERE $campo=$valor";
            $this->seleciona($this);
            if ($this->linhasAfetadas > 0):
                return true;
            else:
                return false;
            endif;
        else:
            $this->trataerro(__FILE__, __FUNCTION__,NULL, 'Faltam paramentos para a execução', True);
        endif;
       
        
    }

}

?>