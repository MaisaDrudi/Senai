<?php
//Exemplo com programação estrutural, Esta classe funciona como um Controller MVC
//Comportamento REST, as constantes $_GET e $_POST são nativas do PHP

//Concedendo acesso CORS para url local "Live Server"
$urlFront="http://127.0.0.1:5500";
header("Access-Control-Allow-Origin:".$urlFront);
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE");
//Preparando a conexão com o Banco de dados
$host = "localhost";
$username = "root";
$password = "";
$db = "orders";
//As constantes $_DELETE e $_PUT precisam ser criadas e definidas
$_DELETE = array();
$_PUT = array();
if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE')) {
    parse_str(file_get_contents('php://input'), $_DELETE);
}
if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT')) {
    parse_str(file_get_contents('php://input'), $_PUT);
}

//Realizando a conexão efetiva ao SGBD e ao Banco de dados
$connection = mysqli_connect($host, $username, $password) or die("Impossível conectar ao SGBD.");
@mysqli_select_db($connection, $db) or die("Impossível conectar ao BD.");

if (!empty($_GET)) {
    $result = mysqli_query($connection, "SELECT id_prod,name,quantity FROM products") or die("Impossível executar a query");
    $saida = array();
    while ($row = mysqli_fetch_object($result)) {
        array_push($saida, $row);
    }
    mysqli_close($connection); //Fecha a conexão com o Banco de dados
    header("Content-type: application/json"); //Define o conteúdo do retorno
    echo json_encode($saida); //Converte a saída para JSON array
}

if (!empty($_POST)) {
    //Recebendo os dados de texto
    $name = $_POST["name"];
    $quantity = $_POST["quantity"];
    $imagem = $_FILES["picture"]; //A imagem é recebida por uma constante separada $FILES
    if (empty($_POST["id"])) { //Se os dados chegarem sem o ID executa a criação senão executa um Update
        //Executando a criação de um novo produto
        if ($imagem["type"] == "image/jpeg" || $imagem["type"] == "image/png") { //Se recebeu um arquivo de imagem
            $tipoArquivo = explode("/", $imagem["type"])[1]; //Obtem o tipo de arquivo
            $nomeArquivo = time() . "." . $tipoArquivo; //Monta o nome do arquivo pegando a hora do sistema e o tipo do arquivo
            if (move_uploaded_file($imagem['tmp_name'], $nomeArquivo)) { //Move o arquivo recebido para o diretório do servidor temporariamente
                $tamanhoImg = filesize($nomeArquivo); //Descobre o tamanho do arquivo
                $mysqlBlob = addslashes(fread(fopen($nomeArquivo, "r"), $tamanhoImg)); //Pega o arquivo e converte para o formato BLOB do Banco de dados
                mysqli_query($connection, "INSERT INTO products VALUES (default,'$name','$quantity','$mysqlBlob')") or die("O sistema não foi capaz de executar a query");
                mysqli_close($connection); //Fecha a conexão com o Banco de dados
                unlink($nomeArquivo); //Remove o arquivo temporário de imagem do diretório
                header("location:".$urlFront."/prod_front.html?mensagem=Produto cadastrado com sucesso.");
            }
        } else {
            header("location:".$urlFront."/prod_front.html?mensagem=Favor anexar uma imagem.");
        }
    } else {
        //Executando um update da imagem
        $id = $_POST["id"];
        if ($imagem["type"] == "image/jpeg" || $imagem["type"] == "image/png") { //Se recebeu um arquivo de imagem
            $tipoArquivo = explode("/", $imagem["type"])[1]; //Obtem o tipo de arquivo
            $nomeArquivo = time() . "." . $tipoArquivo; //Monta o nome do arquivo pegando a hora do sistema e o tipo do arquivo
            if (move_uploaded_file($imagem['tmp_name'], $nomeArquivo)) { //Move o arquivo recebido para o diretório do servidor temporariamente
                $tamanhoImg = filesize($nomeArquivo); //Descobre o tamanho do arquivo
                $mysqlBlob = addslashes(fread(fopen($nomeArquivo, "r"), $tamanhoImg)); //Pega o arquivo e converte para o formato BLOB do Banco de dados
                mysqli_query($connection, "UPDATE products SET picture = '$mysqlBlob' WHERE id_prod = $id") or die("O sistema não foi capaz de executar a query");
                mysqli_close($connection); //Fecha a conexão com o Banco de dados
                unlink($nomeArquivo); //Remove o arquivo temporário de imagem do diretório
            }
            header("location:".$urlFront."/prod_front.html?mensagem=Imagem alterada com sucesso.");
        } else {
            header("location:".$urlFront."/prod_front.html?mensagem=Favor anexar uma imagem.");
        }
    }
}

if (!empty($_DELETE)) {
    $id = $_DELETE["id"];
    $result = mysqli_query($connection, "DELETE FROM products WHERE id_prod = $id") or die("A query de exclusão não foi executada com sucesso");
    if ($result > 0) {
        echo "O produto id " . $id . " foi excluído com sucesso.";
    }
    mysqli_close($connection); //Fecha a conexão com o Banco de dados
}

if (!empty($_PUT)) {
    $id = $_PUT["id"];
    $name = $_PUT["name"];
    $quantity = $_PUT["quantity"];
    $result = mysqli_query($connection, "UPDATE products SET name = '$name', quantity = $quantity WHERE id_prod = $id") or die("A query de alteração não foi executada com sucesso");
    if ($result > 0) {
        echo "Os dados do produto id " . $id . " foram alterados com sucesso.";
    }
    mysqli_close($connection); //Fecha a conexão com o Banco de dados
}
