<?php

	class Vendas {
		var $cod;
		var $quantidade;
		var $preco;

		function getCod(){
			return $this->cod;
		}
		function setCod($cod){
			$this->cod = $cod;
		}

		function getQuantidade(){
			return $this->quantidade;
		}
		function setQuantidade($quantidade){
			$this->quantidade = $quantidade;
		}

		function getPreco(){
			return $this->preco;
		}
		function setPreco($preco){
			$this->preco = $preco;
		}
	}

	class VendasDAO {
		function create($Vendas) {
			$result = array();

			try {
				$query = "INSERT INTO vendas VALUES (default,'".$vendas->getPreco()."','".$vendas->getQuantidade()."')";
				
				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["cod"] = connection::getInstance()->lastInsertCod();
					$result["preco"] = $vendas->getValor();
					$result["quantidade"] = $vendas->getQuantidade();

				} else{
					$result["erro"] = "Não foi possivel adicionar a venda.";
				}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function readAll() {
			$result = array();
			
			try {
				$query = "SELECT * FROM vendas";
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				while($linha = $resultSet->fetchObject()){
					$vendas = new Vendas();
					$vendas->setCod($linha->cod);
					$vendas->setPreco($linha->preco);
					$vendas->setQuantidade($linha->quantidade);
					$result[] = $vendas;
				}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function read($cod) {
			$result = array();
			$query = "SELECT * FROM vendas where cod=$cod";
			try {
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				if($resultSet){
				while($linha = $resultSet->fetchObject()){
					$vendas = new Mercadorias();
					$vendas->setCod($linha->cod);
					$vendas->setPreco($linha->preco);
					$vendas->setQuantidade($linha->quantidade);

					$result[] = $vendas;
				}
			}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function update($vend) {
			$result = array();
			$cod = $vend-> getCod();
			$preco = $vend-> getPreco();
			$quantidade = $vend-> getQuantidade();

			try {
				$query = "UPDATE vendas SET preco = '$preco',quantidade = '$quantidade' WHERE cod = $cod";

				$con = new Connection();

				$status = Connection::getInstance()->prepare($query);
				echo $query;
				if($status->execute()){
					$result = $vend;
				}else{
					$result["erro"] = "Não foi possivel atualizar os dados";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function delete($cod) {
			$result = array();
			$query = "DELETE FROM vendas WHERE cod = $cod";
			try {
			
				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["msg"] = "A venda foi excluida.";
				}else{
					$result["Erro"] = "Venda não excluida.";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}
	}
