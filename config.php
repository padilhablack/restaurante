<?php

//diretorio do sistema

define("BASEPATH", dirname(__FILE__) . "/"); // diretorio do sistema via localização
define("BASEURL", "http://restaurante.local/");
define("ADMURL", BASEURL . "painel.php"); //direto do painel
define("ClASSESPATH", "classes/"); // diretorio das classes
define("MODULOSPATH", "modulos/"); //diretoraio dos modulos
define("CSSPATH", "css/"); //diretorio dos css
define("JSPATH", "js/"); // dretorio dos java scripts
//banco de dados
define("DBHOST", "localhost"); // nome da conexao do banco
define("DBUSER", "root"); // nome do usuario do banco
define("DBPASS", "popup"); // senha do banco
define("DBNAME", "Restaurante"); // nome do banco de dados


$constantes = array('BASEPATH', 'BASEURL','ADMURL', 'BASEURL','ClASSESPATH','MODULOSPATH','CSSPATH','JSPATH', 'DBHOST', 'DBUSER', 'DBPASS', 'DBNAME');
