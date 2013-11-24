<?php
require_once (dirname(__FILE__) . '/autoload.php');
protegerArquivo(basename(__FILE__));

class Rodizio extends Base {

    public function __construct($campos = array()) {
        parent::__construct(); // vai até o contrutor da classe banco
        $this->tabela = "rodizio";
        if (sizeof($campos) <= 0):// verifica se os campos estão empty
            $this->campos_valores = array(// os campos recebem nulos pois estão vazios
                "id" => null,
                "nome" => null,
                "data" => null,
                "alunos" => null,
           
            );
        else:$this->campos_valores = $campos;
        endif;
        $this->campopk = 'id';
    }
    
}


