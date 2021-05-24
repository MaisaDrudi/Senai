<?php

	require("../../domain/connection.php");
	require("../../domain/compras.php");

	class ComprasProcess {
		var $cd;

		function doGet($arr){
			$cd = new ComprasDAO();
			if($arr["cod"]=="0"){
				$sucess = $cd->readAll();
			}else{
				$sucess = $cd->read($arr["cod"]);
			}
			
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$cd = new ComprasDAO();
			$compras = new Compras();
			$compras->setCod_merc($arr["cod_merc"]);
			$compras->setData($arr["data"]);
			$compras->setCusto($arr["custo"]);
			$compras->setQuantidade($arr["quantidade"]);
			$sucess = $cd->create($compras);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPut($arr){
			$cd = new ComprasDAO();
			$compras = new Compras();
			$compras->setCod($arr["cod"]);
			$compras->setCod_merc($arr["cod_merc"]);
			$compras->setData($arr["data"]);
			$compras->setQuantidade($arr["quantidade"]);
			$sucess = $cd->update($compras);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doDelete($arr){
			$cd = new ComprasDAO();
			$sucess = $cd->delete($arr["cod"]);
			http_response_code(200);
			echo json_encode($sucess);
		}
	}