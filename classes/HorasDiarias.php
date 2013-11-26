<?php
require_once (dirname(__FILE__) . '/autoload.php');
protegerArquivo(basename(__FILE__));

class HorasDiarias extends Base {

    public function __construct($campos = array()) {
        parent::__construct(); // vai até o contrutor da classe banco
        $this->tabela = "horas_diarias";
        if (sizeof($campos) <= 0):// verifica se os campos estão empty
            $this->campos_valores = array(// os campos recebem nulos pois estão vazios
                "id" => null,
                "ra" => null,
                "data" => null,
                "entrada" => null,
                "saida"=> null, 
                "minutos"=> null,
                "minutos2"=> null
           
            );
        else:$this->campos_valores = $campos;
        endif;
        $this->campopk = 'id';
    }
    

}