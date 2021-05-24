<?php

	class Mercadorias {
		var $cod;
		var $nome;
		var $valor;
		var $quantidade;

		function getCod(){
			return $this->cod;
		}
		function setCod($cod){
			$this->cod = $cod;
		}

		function getNome(){
			return $this->nome;
		}
		function setNome($nome){
			$this->nome = $nome;
		}

		function getValor(){
			return $this->valor;
		}
		function setValor($valor){
			$this->valor = $valor;
		}

		function getQuantidade(){
			return $this->quantidade;
		}
		function setQuantidade($quantidade){
			$this->quantidade = $quantidade;
		}
	}

	class MercadoriasDAO {

		function create($Mercadorias) {
			$result = array();

			try {
				$query = "INSERT INTO mercadorias VALUES (default, '".$mercadorias->getNome()."','".$mercadorias->getValor()."','".$mercadorias->getQuantidade()."')";
				
				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["cod"] = connection::getInstance()->lastInsertCod();
					$result["nome"] = $mercadorias->getNome();
					$result["valor"] = $mercadorias->getValor();
					$result["quantidade"] = $mercadorias->getQuantidade();

				} else{
					$result["erro"] = "Não foi possivel adicionar a mercadoria!!";
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
				$query = "SELECT * FROM mercadorias";
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				while($linha = $resultSet->fetchObject()){
					$mercadorias = new Mercadorias();
					$mercadorias->setCod($linha->cod);
					$mercadorias->setNome($linha->nome);
					$mercadorias->setValor($linha->valor);
					$mercadorias->setQuantidade($linha->quantidade);
					$result[] = $mercadorias;
				}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function read($cod) {
			$result = array();
			$query = "SELECT * FROM mercadorias where cod=$cod";
			try {
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				if($resultSet){
				while($linha = $resultSet->fetchObject()){
					$mercadorias = new Mercadorias();
					$mercadorias->setCod($linha->cod);
					$mercadorias->setNome($linha->nome);
					$mercadorias->setValor($linha->valor);
					$mercadorias->setQuantidade($linha->quantidade);

					$result[] = $mercadorias;
				}
			}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function update($merc) {
			$result = array();
			$cod = $merc-> getCod();
			$nome = $merc-> getNome();
			$valor = $merc-> getValor();
			$quantidade = $merc-> getQuantidade();

			try {
				$query = "UPDATE mercadorias SET nome = '$nome', valor = '$valor',quantidade = '$quantidade' WHERE cod = $cod";

				$con = new Connection();

				$status = Connection::getInstance()->prepare($query);
				echo $query;
				if($status->execute()){
					$result = $merc;
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
			$query = "DELETE FROM mercadorias WHERE cod = $cod";
			try {
			
				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["msg"] = "A mercadoria foi excluida.";
				}else{
					$result["Erro"] = "Mercadoria não excluida.";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}
	}
