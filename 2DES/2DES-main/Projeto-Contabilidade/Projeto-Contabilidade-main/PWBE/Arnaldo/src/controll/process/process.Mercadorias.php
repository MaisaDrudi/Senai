<?php

	require("../../domain/connection.php");
	require("../../domain/mercadorias.php");

	class MercadoriasProcess {
		var $Md;

		function doGet($arr){
			$Md = new MercadoriasDAO();
			if($arr["cod"]=="0"){
				$sucess = $Md->readAll();
			}else{
				$sucess = $Md->read($arr["cod"]);
			}
			
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$Md = new MercadoriasDAO();
			$mercadorias = new Mercadorias();
			$mercadorias->setCod($arr["cod"]);
			$mercadorias->setNome($arr["nome"]);
			$mercadorias->setValor($arr["valor"]);
			$mercadorias->setQuantidade($arr["quantidade"]);
			$sucess = $Md->create($mercadorias);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPut($arr){
			$Md = new MercadoriasDAO();
			$mercadorias = new Mercadorias();
			$mercadorias->setCod($arr["cod"]);
			$mercadorias->setNome($arr["nome"]);
			$mercadorias->setValor($arr["valor"]);
			$mercadorias->setQuantidade($arr["quantidade"]);
			$sucess = $Md->update($mercadorias);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doDelete($arr){
			$Md = new ServicosDAO();
			$sucess = $md->delete($arr["cod"]);
			http_response_code(200);
			echo json_encode($sucess);
		}
	}