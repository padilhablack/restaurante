<?php

require_once (dirname(__FILE__) . '/autoload.php');
protegerArquivo(basename(__FILE__));

abstract class Banco {

    public $servidor = DBHOST;
    public $usuario = DBUSER;
    public $senha = DBPASS;
    public $nomeBanco = DBNAME;
    public $conexao = NULL;
    public $dataSet = NULL;
    public $linhasAfetadas = -1;

    public function __construct() {
        $this->conecta();
    }

    public function __destruct() {
        if ($this->conexao != null) {
            mysql_close($this->conexao);
        }
    }

    public function conecta() {
        $this->conexao = mysql_connect($this->servidor, $this->usuario, $this->senha, TRUE) or die($this->trataerro(__FILE__, __FUNCTION__, mysql_errno(), mysql_errno(), false));
        mysql_select_db($this->nomeBanco);
        mysql_query("SET NAMES 'UTF-8'");
        mysql_query("SET character_set_connection=utf8");
        mysql_query("SET character_set_client=utf8");
        mysql_query("SET character_set_results=utf8");
    }

//conecta

    public function inserir($objeto) {
        // insere qual o campo que do banco
        $sql = "INSERT INTO " . $objeto->tabela . "( ";
        for ($i = 0; $i < count($objeto->campos_valores); $i++):
            $sql .= key($objeto->campos_valores);
            if ($i < count($objeto->campos_valores) - 1):
                $sql.=", ";
            else:
                $sql.=") ";
            endif;
            next($objeto->campos_valores);
        endfor;
        reset($objeto->campos_valores);
        $sql.="VALUES (";
        for ($i = 0; $i < count($objeto->campos_valores); $i++):
            $sql .= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                    $objeto->campos_valores[key($objeto->campos_valores)] :
                    "'" . $objeto->campos_valores[key($objeto->campos_valores)] . "'";
            if ($i < count($objeto->campos_valores) - 1):
                $sql.=", ";
            else:
                $sql.=") ";
            endif;
            next($objeto->campos_valores);
        endfor;
        return $this->executaSQL($sql);
    }

//inserir no banco
    public function atualizar($objeto) {
// Atualisa dados em cada campo
        $sql = "UPDATE " . $objeto->tabela . " SET ";
        for ($i = 0; $i < count($objeto->campos_valores); $i++):
            $sql .= key($objeto->campos_valores) . "=";
            $sql .= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                    $objeto->campos_valores[key($objeto->campos_valores)] :
                    "'" . $objeto->campos_valores[key($objeto->campos_valores)] . "'";
            if ($i < count($objeto->campos_valores) - 1):
                $sql.=", ";
            else:
                $sql.=" ";
            endif;
            next($objeto->campos_valores);
        endfor;
        $sql.="WHERE " . $objeto->campopk . "=";
        $sql.= is_numeric($objeto->valorpk) ? $objeto->valorpk : "'" . $objeto->valorpk . "'";
        return $this->executaSQL($sql);
    }

    public function seleciona($objeto) {
        $sql = "select * from " . $objeto->tabela;
        if ($objeto->extras_select != null):
            $sql.= " " . $objeto->extras_select;

        endif;
        return $this->executaSQL($sql);
    }

    public function deletar($objeto) {
        $sql = " DELETE FROM " . $objeto->tabela;
        $sql.= " WHERE " . $objeto->campopk . "=";
        $sql.= is_numeric($objeto->valorpk) ? $objeto->valorpk : "'" . $objeto->valorpk . "'";
        return $this->executaSQL($sql);
    }

    public function executaSQL($sql = null) {
        if ($sql != null):
            $query = mysql_query($sql) or $this->trataerro(__FILE__, __FUNCTION__);
            $this->linhasAfetadas = (mysql_affected_rows($this->conexao));

            //verifica se os 6 caracteres são a palavra select
            if (substr(trim(strtolower($sql)), 0, 6) == 'select'):
                $this->dataSet = $query; //recebe tudo da query 
                return $query; //retorna para o usuario
            else:
                return $this->linhasAfetadas;
            endif;


        else:
            $this->trataerro(__FILE__, __FUNCTION__, __NULL__, 'comandos mysql não informados na rotina', false);

        endif;
    }

    //executa SQL

    public function retornaDados($tipo = null) {
        switch (strtolower($tipo)):
            case "array":
                return mysql_fetch_array($this->dataSet);
                break;

            case "assoc":
                return mysql_fetch_assoc($this->dataSet);
                break;

            case "object":
                return mysql_fetch_object($this->dataSet);

            default:
                return mysql_fetch_object($this->dataSet);
        endswitch;
    }

// retorna dados

    public function trataerro($arquivo = null, $rotina = null, $numerro = null, $msnerro = null, $geraException = false) {
        if ($arquivo == null) {
            $arquivo = "não informado";
        }
        if ($rotina == null) {
            $rotina = "não informada";
        }
        if ($numerro == null) {
            $numerro = mysql_errno($this->conexao);
        }
        if ($msnerro == null) {
            $msnerro = mysql_error($this->conexao);
        }

        $resultado = 'Ocorreu um erro com os seguintes detalhsdes</br>
                      <strong>Arquivo</strong>' . $arquivo . '<br/>' .
                '<strong>Rotina</strong>' . $rotina . '<br/>' .
                '<strong>Código</strong>' . $numerro . '<br/>' .
                '<strong>Mensagem</strong>' . $msnerro . '<br/>';

        if ($geraException == false) {
            echo ($resultado);
        } else {
            die($resultado);
        }
    }

    public function join($tabela1 = null, $tabela2 = null, $para=null) {
        //select nome,ra,hora1,minutos),hora2, minutos2,horaGeral from funcionario inner join horas on horas.r_a=funcionario.ra;
                        
                
    }

}

// fim classe Banco
