<?php

	require("../../domain/connection.php");
	require("../../domain/compras.php");

	class ComprasProcess {
		var $Cd;

		function doGet($arr){
			$Cd = new ComprasDAO();
			if($arr["cod"]=="0"){
				$sucess = $Cd->readAll();
			}else{
				$sucess = $Cd->read($arr["cod"]);
			}
			
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$Cd = new ComprasDAO();
			$compras = new Compras();
			$compras->setData($arr["data"]);
			$compras->setCusto($arr["custo"]);
			$compras->setQuantidade($arr["quantidade"]);
			$sucess = $Cd->create($compras);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPut($arr){
			$Cd = new ComprasDAO();
			$compras = new Compras();
			$compras->setCod($arr["cod"]);
			$compras->setData($arr["data"]);
			$compras->setQuantidade($arr["quantidade"]);
			$sucess = $Cd->update($compras);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doDelete($arr){
			$Cd = new ComprasDAO();
			$sucess = $Cd->delete($arr["cod"]);
			http_response_code(200);
			echo json_encode($sucess);
		}
	}