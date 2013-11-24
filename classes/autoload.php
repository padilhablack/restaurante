<?php

$pacthlocal = dirname(__FILE__);
require_once (dirname($pacthlocal) . "/funcoes.php");

function __autoload($classe) {
    $classe = str_replace('..', '', $classe);
    dirname(__FILE__) . "/$classe";
}
