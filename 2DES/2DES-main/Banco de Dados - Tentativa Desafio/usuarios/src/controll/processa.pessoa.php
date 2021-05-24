<?php
    require("../domain/pessoa.php"); //Funciona como import do JAVA requer o arquivo de modelo "pessoa.php"
	$pd = new PessoaDAO(); //Objeto da classe PessoaDAO para acesso ao Banco de Dados
	
	include("configs.php"); //Inclui as variáveis de ambiente $_PUT e $_DELETE
	
	//Tratar as requisições HTTP REST (GET,POST,PUT,DELETE)
	if(!empty($_GET)){ //Se o verbo GET não estiver vazio
		//O id é auto_increment no banco de dados e inicia em 1
		if(isset($_GET["id"])){
			if($_GET["id"]=="0"){//Filtro, o id for igual a 0 vamos listar todas as pessoas
				echo json_encode($pd->readAll());
			} else { //Senão vamos listar somente a pessoa com o id informado
				echo json_encode($pd->read($_GET["id"]));
			}
		}
	}
	
	if(!empty($_POST)){ //Se o verbo POST não estiver vazio
		$pessoa = new Pessoa();//Cria um novo objeto Pessoa (modelo)
		$pessoa->setNome($_POST["nome"]);//Preenche o modelo
		$pessoa->setTelefone($_POST["telefone"]);//Preenche o modelo
		$sucesso = $pd->create($pessoa);
		if(!is_object($sucesso)){
			http_response_code(201);
		}
		echo json_encode($sucesso);
	}
	
	if(!empty($_PUT)){ //Se o verbo PUT não estiver vazio
		$fp = fopen('arq.txt', 'a');
		
		$pessoa = new Pessoa(); //Cria um novo objeto Pessoa (modelo)
		$pessoa->setIdPessoa($_PUT["id"]);//Preenche o modelo
		$pessoa->setNome($_PUT["nome"]);//Preenche o modelo
		fwrite($fp,"nada \n");
		if(isset($_PUT["telefones"])){//Se chegar telefone, preenche o modelo
			$telefones = json_decode($_PUT["telefones"]);
			$pessoa->setTelefone($telefones);//Preenche o modelo
		}
		$sucesso = $pd->update($pessoa);
		if(is_object($sucesso)){
			http_response_code(202);
		} else {
			http_response_code(400);
		}
		echo json_encode($sucesso);
		fclose($fp);
	}
	
	if(!empty($_DELETE)){ //Se o verbo DELETE não estiver vazio
		$id = $_DELETE["id"];//Recebe o id
		$sucesso = $pd->del($id);
		if(isset($sucesso["erro"])){
			http_response_code(405);
		}
		echo json_encode($sucesso);
	}
	
?>
	

