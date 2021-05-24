<?php

	require("../domain/conexao.php");//Importa a classe Conexao que utiliza o objeto PDO
	require("../domain/usuario.php");
	require("../domain/pessoa.php");
	$ud = new UsuarioDAO();
	$pd = new PessoaDAO();
	
	header("Access-Control-Allow-Origin:*");
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Max-Age: 1000');
	header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
	header("Content-type: application/json; charset=UTF-8");

	$method = $_SERVER['REQUEST_METHOD'];
	switch($method) {
        case 'GET' :
			if(isset($_GET["id"])){
				if($_GET["id"]=="0"){//Filtro, o id for igual a 0 vamos listar todas as pessoas
					echo json_encode($pd->readAll());
				} else { //Senão vamos listar somente a pessoa com o id informado
					echo json_encode($pd->read($_GET["id"]));
				}
			}
            break;
        case 'POST' :
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			if(isset($request->login)&&isset($request->senha)){
				$login = $request->login;
				$senha = $request->senha;
				$status = $ud->login($login,$senha);
				if(!is_object($status)){
					http_response_code(401);
				}
				echo json_encode($status);
			}
            break;
        case 'PUT' :
			echo '{"msg":"Chegou por PUT"}';
            break;
        case 'DELETE' :
			echo '{"msg":"Chegou por DELETE"}';
            break;
        default:
			echo '{"msg":"Chegou por OTHER"}';
            http_response_code(405);
            break;
    }

?>