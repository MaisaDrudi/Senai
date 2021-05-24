<?php

	require("../../domain/connection.php");
	require("../../domain/vendas.php");

	class VendasProcess {
		var $vd;

		function doGet($arr){
			$vd = new VendasDAO();
			if($arr["cod"]=="0"){
				$sucess = $vd->readAll();
			}else{
				$sucess = $vd->read($arr["cod"]);
			}
			
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$vd = new VendasDAO();
			$vendas = new Vendas();
			$vendas->setPreco($arr["preco"]);
			$vendas->setQuantidade($arr["quantidade"]);
			$sucess = $vd->create($vendas);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPut($arr){
			$vd = new VendasDAO();
			$vendas = new Vendas();
			$vendas->setCod($arr["cod"]);
			$vendas->setPreco($arr["preco"]);
			$vendas->setQuantidade($arr["quantidade"]);
			$sucess = $vd->update($vendas);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doDelete($arr){
			$vd = new VendasDAO();
			$sucess = $vd->delete($arr["cod"]);
			http_response_code(200);
			echo json_encode($sucess);
		}
	}