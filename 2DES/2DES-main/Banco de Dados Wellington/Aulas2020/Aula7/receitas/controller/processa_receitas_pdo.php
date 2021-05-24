<?php
require "../model/receita_dao.php";
/* Controller utilizando MVC, Orientado a Objeto e a classe PDO */
if (empty($_POST)) {
    echo "Aguardando requisição";
} else {
    if (isset($_POST["oficialform"])) {
        $fotoNome = $_FILES["foto"]["name"];
        $tipoFoto = $_FILES["foto"]["type"];
        $dadosDaFoto = $_FILES["foto"]["tmp_name"];
        echo "Nome do arquivo: " . $fotoNome . "<br/>";
        echo "Tipo de arquivo: " . $tipoFoto . "<br/>";
        echo $_POST["tipo"] . "," . $_POST["nome"] . "," . $_POST["ingredientes"] . "," . $_POST["mododefazer"] . "<br/>";
        if (substr($tipoFoto, 0, 5) != "image") {
            echo "Tipo de arquivo não suportado, favor escolher imagens do tipo .jpg, .png, .jpeg";
        } else {
            //Classes para receber os dados da receita e enviar para o Banco de Dados
            $receitadao = new ReceitaDAO();
            $receita = new Receita();
            //Tratamento do arquivo de imagem
            $extensaoArquivo = explode("/", $tipoFoto)[1];
            $nomeArquivo = time() . $extensaoArquivo;
            if (move_uploaded_file($dadosDaFoto, $nomeArquivo)) {
                $tamanhoFoto = filesize($nomeArquivo);
                $mysqlFoto = addslashes(fread(fopen($nomeArquivo, "r"), $tamanhoFoto));
                $receita->setFoto($mysqlFoto);
                unlink($nomeArquivo);
            } else {
                $receita->setFoto(null);
            }
            //Continua tratando os outros dados
            $receita->setTipo($_POST["tipo"]);
            $receita->setNome($_POST["nome"]);
            $receita->setIngredientes($_POST["ingredientes"]);
            $receita->setModoDeFazer($_POST["mododefazer"]);
            $receita->setTipoFoto($extensaoArquivo);
            if ($receitadao->create($receita) == 1) {
                echo "Dados enviados para o Banco de Dados";
            } else {
                echo "Erro ao enviar dados para o Banco de Dados";
            }
        }

    } else {
        echo "Este controle processa apenas requisições recebidas de um formulário específico";
    }
}
