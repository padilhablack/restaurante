<?php
require_once './usuarios.php';
require_once './rodizio.php';
require './Horario.php';

//$jonas = new funcionario();
//$jonas->setValor('nome', 'Pedrao');
//$jonas->setValor('ra', '45336');
//$jonas->valorpk = $jonas->getValor('ra');



//$rodizio = new Rodizio();
//$rodizio->setValor('id', '2');
//$rodizio->setValor('nome', 'Fevereiro');


//$rodizio->setValor('alunos',($jonas->getValor('ra')));

//$jonas->inserir($jonas);
//$rodizio->inserir($rodizio);
//echo '<pre>';
//print_r($jonas);
//echo '<pre>';

   // $novo = new Rodizio();
   /// $novo->tabela = $nome;

$aluno = new funcionario();
$aluno->setValor('ra','1234');
$aluno->setValor('nome', 'Fernando Rocha');

$hora = new Horario(array(
    'hid'=> '2',
    'r_a'=> '1234',
    'hora1'=> '8',
    'hora2'=> '12', 
    'horageral' => '200',
    'minutos'=>'00',
    'minutos2'=>'00'
));

$aluno->inserir($aluno);
$hora->inserir($hora);



?>