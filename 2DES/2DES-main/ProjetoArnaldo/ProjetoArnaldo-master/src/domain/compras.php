<?php

	class Compras {
		var $cod;
		var $cod_merc;
		var $data;
		var $custo;
		var $quantidade;

		function getCod(){
			return $this->cod;
		}
		function setCod($cod){
			$this->cod = $cod;
		}
		function getCod_merc(){
			return $this->cod_merc;
		}
		function setCod_merc($cod_merc){
			$this->Cod_merc = $cod_merc;
		}

		function getData(){
			return $this->data;
		}
		function setData($data){
			$this->data = $data;
		}

		function getCusto(){
			return $this->custo;
		}
		function setCusto($custo){
			$this->custo = $custo;
		}

		function getQuantidade(){
			return $this->quantidade;
		}
		function setQuantidade($quantidade){
			$this->quantidade = $quantidade;
		}
	}

	class ComprasDAO {
		function create($compras) {
			$result = array();
			$cod = $compras-> getCod();
			$cod_merc = $compras-> getCod_merc();
			$data = $compras-> getData();
			$custo = $compras-> getCusto();
			$quantidade = $compras-> getQuantidade();

			try {
				$query = "INSERT INTO compras VALUES (default, $cod_merc, $data, $custo, $quantidade)";
				
				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["cod"] = connection::getInstance()->lastInsertId();
					$result["cod_merc"] = $compras->getCod_merc();
					$result["data"] = $compras->getData();
					$result["custo"] = $compras->getCusto();
					$result["quantidade"] = $compras->getQuantidade();

				} else{
					$result["erro"] = "Não foi possivel adicionar a compra.";
				}
				$con = null;
			}catch(PDOException $e) {
				$result["erro"] = "Não foi possivel adicionar a compra.";
			}

			return $result;
		}

		function readAll() {
			$result = array();
			
			try {
				$query = "SELECT * FROM compras";
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				while($linha = $resultSet->fetchObject()){
					$compras = new Compras();
					$compras->setCod($linha->cod);
					$compras->setCod_merc($linha->cod_merc);
					$compras->setData($linha->data);
					$compras->setCusto($linha->custo);
					$compras->setQuantidade($linha->quantidade);
					$result[] = $compras;
				}
				$con = null;
			}catch(PDOException $e) {
				$result["erro"] = "Erro na compra.";
			}

			return $result;
		}

		function read($cod) {
			$result = array();
			$query = "SELECT * FROM compras where cod=$cod";
			try {
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				if($resultSet){
				while($linha = $resultSet->fetchObject()){
					$compras = new Compras();
					$compras->setCod($linha->cod);
					$compras->setData($linha->data);
					$compras->setCusto($linha->custo);
					$compras->setQuantidade($linha->quantidade);

					$result[] = $compras;
				}
			}
				$con = null;
			}catch(PDOException $e) {
				$result["erro"] = "Erro na compra.";
			}

			return $result;
		}

		function update($comp) {
			$result = array();
			$cod = $comp-> getCod();
			$data = $comp-> getData();
			$custo = $comp-> getCusto();
			$quantidade = $comp-> getQuantidade();

			try {
				$query = "UPDATE compras SET data = '$data', custo = '$custo',quantidade = '$quantidade' WHERE cod = $cod";

				$con = new Connection();

				$status = Connection::getInstance()->prepare($query);
				echo $query;
				if($status->execute()){
					$result = $comp;
				}else{
					$result["erro"] = "Não foi possivel atualizar os dados";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["erro"] = "Erro na compra.";
			}

			return $result;
		}

		function delete($cod) {
			$result = array();
			$query = "DELETE FROM compras WHERE cod = $cod";
			try {
			
				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["msg"] = "A compra foi excluida.";
				}else{
					$result["Erro"] = "Compra não excluida.";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["erro"] = "Erro na compra.";
			}

			return $result;
		}
	}
