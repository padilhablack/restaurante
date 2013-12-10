<?php
require_once (dirname(__FILE__) . '/autoload.php');
protegerArquivo(basename(__FILE__));

class Horario extends Base {

    public function __construct($campos = array()) {
        parent::__construct(); // vai até o contrutor da classe banco
        $this->tabela = "horas";
        if (sizeof($campos) <= 0):// verifica se os campos estão empty
            $this->campos_valores = array(// os campos recebem nulos pois estão vazios
                "hid" => null,
                "r_a" => null,
                "hora1" => null,
                "hora2" => null,
                "horaGeral"=> null, 
       
           
            );
        else:$this->campos_valores = $campos;
        endif;
        $this->campopk = 'hid';
    }
    

}