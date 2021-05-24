<?php

	$urlFront="http://localhost/usuarios";
	header("Access-Control-Allow-Origin:".$urlFront);
	header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE");

	//No PHP somente as constantes $_GET e $_POST já existem por padrão
	//Os vetores/constantes DELETE e PUT precisam ser criados 
	$_DELETE = array();
	$_PUT = array();
	if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE')) {
		parse_str(file_get_contents('php://input'), $_DELETE);
	}
	if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT')) {
		parse_str(file_get_contents('php://input'), $_PUT);
	}