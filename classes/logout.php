<?php

require_once 'usuarios.php';
include_once './sessao.php';

$sessao = new sessao();
$sessao->destroi(); 
redireciona('index.php');


