<?php
class Receita
{
    private $id;
    private $tipo;
    private $nome;
    private $ingredientes;
    private $modoDeFazer;
    private $foto;
    private $tipoFoto;

    public function __constructor($id, $tipo, $nome, $ingredientes, $modoDeFazer, $foto, $tipoFoto)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->ingredientes = $ingredientes;
        $this->modoDeFazer = $modoDeFazer;
        $this->foto = $foto;
        $this->tipoFoto = $tipoFoto;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }
    public function getIngredientes()
    {
        return $this->ingredientes;
    }
    public function setIngredientes($ingredientes)
    {
        $this->ingredientes = $ingredientes;
        return $this;
    }
    public function getModoDeFazer()
    {
        return $this->modoDeFazer;
    }
    public function setModoDeFazer($modoDeFazer)
    {
        $this->modoDeFazer = $modoDeFazer;
        return $this;
    }
    public function getFoto()
    {
        return $this->foto;
    }
    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }
    public function getTipoFoto()
    {
        return $this->tipoFoto;
    }
    public function setTipoFoto($tipoFoto)
    {
        $this->tipoFoto = $tipoFoto;
        return $this;
    }
}
