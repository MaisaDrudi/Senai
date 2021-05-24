<?php
/* Controller utilizando programação estrutural e função mysql_connect */
$imagem = $_FILES["foto"];
$host = "localhost";
$username = "root";
$password = "";
$db = "receitas";

if ($imagem != null) {

    $tipo = $_POST["tipo"];
    $nome = $_POST["nome"];
    $ingredientes = $_POST["ingredientes"];
    $modoDeFazer = $_POST["mododefazer"];
    $tipoArquivo = explode("/", $imagem["type"])[1];
    $nomeFinal = time() . "." . $tipoArquivo;

    if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) {

        $tamanhoImg = filesize($nomeFinal);
        $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg)); //Salva a imagem no diretório
        $connection = mysqli_connect($host, $username, $password) or die("Impossível Conectar ao SGBD");

        @mysqli_select_db($connection, $db) or die("Impossível Conectar ao BD");
        mysqli_query($connection, "INSERT INTO RECEITAS VALUES (NULL,'$tipo','$nome','$ingredientes','$modoDeFazer','$mysqlImg','$tipoArquivo')") or
        die("O sistema não foi capaz de executar a query");
        mysqli_close($connection);

        unlink($nomeFinal); //Remove o arquivo de imagem do diretório

        header("location:receitas.html");
    }
} else {
    echo "Você não realizou o upload de forma satisfatória.";
}
