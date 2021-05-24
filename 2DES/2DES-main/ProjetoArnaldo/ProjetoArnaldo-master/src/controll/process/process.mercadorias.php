<?php

	require("../../domain/connection.php");
	require("../../domain/mercadorias.php");

	class MercadoriasProcess {
		var $md;

		function doGet($arr){
			$md = new MercadoriasDAO();
			if($arr["cod"]=="0"){
				$sucess = $md->readAll();
			}else{
				$sucess = $md->read($arr["cod"]);
			}
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$md = new MercadoriasDAO();
			$mercadorias = new Mercadorias();
			$mercadorias->setCod($arr["cod"]);
			$mercadorias->setNome($arr["nome"]);
			$mercadorias->setValor($arr["valor"]);
			$mercadorias->setQuantidade($arr["quantidade"]);
			$sucess = $md->create($mercadorias);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPut($arr){
			$md = new MercadoriasDAO();
			$mercadorias = new Mercadorias();
			$mercadorias->setCod($arr["cod"]);
			$mercadorias->setNome($arr["nome"]);
			$mercadorias->setValor($arr["valor"]);
			$mercadorias->setQuantidade($arr["quantidade"]);
			$sucess = $md->update($mercadorias);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doDelete($arr){
			$md = new MercadoriasDAO();
			$sucess = $md->delete($arr["cod"]);
			http_response_code(200);
			echo json_encode($sucess);
		}
	}