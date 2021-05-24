<?php
	if(empty($_POST)){
		echo "Opa";
	} else {		
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		$de = null;
		$para = $_POST["email"];
		$assunto = $_POST["assunto"];
        $menssagem = "<h3>".$_POST["titulo"]."</h3><hr/><p>".$_POST["mensagem"].".</p>";
		$cabecalho = 'De:'. $de."\r\n";
		$cabecalho .= 'Content-type: text/html;' . '\r\n';
        if(mail($para, $assunto, $menssagem, $cabecalho)){
			echo "Dados enviados para o e-mail: ". $_POST["email"]." com sucesso.";
		}
	}
?>