<?php
require "receita.php";

class Conexao
{
    public static $instance;
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=localhost;port=3306;dbname=receitas', "root",
                "", array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_CASE => PDO::CASE_LOWER));
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        return self::$instance;
    }
}

class ReceitaDAO
{
    public function create($receita)
    {
        $sql = 'INSERT INTO receitas VALUES (NULL,"'.$receita->getTipo().'","'.$receita->getNome().'","'.
        $receita->getIngredientes().'","'.$receita->getModoDeFazer().'","'.
        $receita->getFoto().'","'.$receita->getTipoFoto().'");';
        try {
            $conecta = new Conexao();
            $resultado = Conexao::getInstance()->exec($sql);
            $conecta = null;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
        return $resultado;
    }

    public function listAll()
    {
        try {
            $conecta = new Conexao();
            $resultado = Conexao::getInstance()->query('select id, tipo, nome, ingredientes, modo_de_fazer, foto, tipo_foto from receitas;');
            $conecta = null;
        } catch (PDOException $e) {
            $resultado = 'Erro: ' . $e->getMessage();
        }
        return $resultado;
    }
}
