<?php
	if(empty($_GET)){
		echo "Nemhuma informação a ser processada.";
	} else {		
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		$de = "null";
		$para = $_GET["email"];
		$assunto = $_GET["assunto"];
        $menssagem = "<h3>".$_GET["titulo"]."</h3><hr/><p>".$_GET["mensagem"].".</p>";
		$cabecalho = 'De:'. $de."\r\n";
		$cabecalho .= 'Content-type: text/html;' . '\r\n';
        if(mail($para, $assunto, $menssagem, $cabecalho)){
			echo "Dados enviados para o e-mail: ". $_GET["email"]." com sucesso.";
		}
	}
?>