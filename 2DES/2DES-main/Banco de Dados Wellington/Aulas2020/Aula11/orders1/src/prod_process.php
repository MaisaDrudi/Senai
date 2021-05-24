<?php
//Exemplo com programação estrutural, Esta classe funciona como um Controller MVC
//Este arquivo terá o comportamento de uma API REST ou webService (Intermediário de acesso ao Banco de dados)

//Configura o CORS para acesso a url local "Live Server" e aos verbos GET,POST,PUT,DELETE
header("Access-Control-Allow-Origin:http://127.0.0.1:5500");
header("Access-Control-Allow-Methods:GET,POST,PUT,DELETE");

//OBS:As variáveis(constantes) $_POST e $_GET não precisam ser criadas pois são nativas do PHP
//Criação das variáveis(Constantes) para os verbos DELETE e PUT
$_PUT = array();
$_DELETE = array();
if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT')) {
    parse_str(file_get_contents('php://input'), $_PUT);
}
if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE')) {
    parse_str(file_get_contents('php://input'), $_DELETE);
}

//Configura as variáveis para a conexão com o Banco de dados
$host = "localhost";
$username = "root";
$password = "";
$db = "orders";

if(!empty($_GET)){ //Se não for via post então é via GET (Neste caso lista)
    $id = $_GET["id"];
    $saida = array();
    //Realizando a conexão efetiva ao SGBD e ao Banco de dados
    $connection = mysqli_connect($host, $username, $password) or die("Impossível conectar ao SGBD.");
    @mysqli_select_db($connection, $db) or die("Impossível conectar ao BD.");
    if($id == 0){
        $result = mysqli_query($connection,"SELECT id_prod,name,quantity FROM products") or die("Impossível executar a query");
        while($row=mysqli_fetch_object($result)) {
            array_push($saida, $row);
        }
    } else {
        $result = mysqli_query($connection,"SELECT id_prod,name,quantity FROM products WHERE id_prod=$id") or die("Impossível executar a query");
        while($row=mysqli_fetch_object($result)) {
            array_push($saida, $row);
        }
    }
    mysqli_close($connection); //Encerra a conexão
    header("Content-type: application/json");//Define o conteúdo do retorno
    echo json_encode($saida); //Converte a saída para JSON array
}

if (!empty($_POST)){
    $connection = mysqli_connect($host, $username, $password) or die("Impossível Conectar ao SGBD"); //Conecta no SGBD MySQL
    @mysqli_select_db($connection, $db) or die("Impossível Conectar ao BD"); //Conecta no Banco de dados "ORDERS"
    //Se recebeu um ID altera somente a imagem senão cadastra um novo registro
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $imagem = $_FILES["picture"];
        if ($imagem["type"] != null) { //Se recebeu um arquivo de imagem
            $tipoArquivo = explode("/", $imagem["type"])[1]; //Obtem o tipo de arquivo
            $nomeArquivo = time() . "." . $tipoArquivo; //Manta o nome do arquivo pegando a hora do sistema e o tipo do arquivo
            if (move_uploaded_file($imagem['tmp_name'], $nomeArquivo)) { //Move o arquivo recebido para o diretório do servidor temporariamente
                $tamanhoImg = filesize($nomeArquivo); //Descobre o tamanho do arquivo
                $mysqlBlob = addslashes(fread(fopen($nomeArquivo, "r"), $tamanhoImg)); //Pega o arquivo e converte para o formato BLOB do Banco de dados
                //Executa a QUERY
                mysqli_query($connection, "UPDATE products SET picture = '$mysqlBlob' WHERE id_prod = $id") or die("O sistema não foi capaz de executar a query");
                mysqli_close($connection); //Fecha a conexão com o Banco de dados
                unlink($nomeArquivo); //Remove o arquivo temporário de imagem do diretório
            }
        }
    } else {
        //Recebendo os dados via POST (Texto e Imagem) para Criação de um novo Registro
        $name = $_POST["name"];
        $quantity = $_POST["quantity"];
        $imagem = $_FILES["picture"];
        if ($imagem["type"] != null) { //Se recebeu um arquivo de imagem
            $tipoArquivo = explode("/", $imagem["type"])[1]; //Obtem o tipo de arquivo
            $nomeArquivo = time() . "." . $tipoArquivo; //Manta o nome do arquivo pegando a hora do sistema e o tipo do arquivo
            if (move_uploaded_file($imagem['tmp_name'], $nomeArquivo)) { //Move o arquivo recebido para o diretório do servidor temporariamente
                $tamanhoImg = filesize($nomeArquivo); //Descobre o tamanho do arquivo
                $mysqlBlob = addslashes(fread(fopen($nomeArquivo, "r"), $tamanhoImg)); //Pega o arquivo e converte para o formato BLOB do Banco de dados
                //Executa a QUERY
                mysqli_query($connection, "INSERT INTO products VALUES (default,'$name','$quantity','$mysqlBlob')") or die("O sistema não foi capaz de executar a query");
                unlink($nomeArquivo); //Remove o arquivo temporário de imagem do diretório
            }
        }
    }
    mysqli_close($connection); //Fecha a conexão com o Banco de dados
    header("location:http://127.0.0.1:5500/prod_front.html");
}

if(!empty($_DELETE)){
    $id = $_DELETE["id"];
    $connection = mysqli_connect($host, $username, $password) or die("Erro ao conectar ao SGBD.");
    @mysqli_select_db($connection, $db) or die("Erro ao conectar ao BD.");
    mysqli_query($connection,"DELETE FROM products WHERE id_prod=$id") or die("Erro ao executar a query");
    mysqli_close($connection);
    echo "Enviada a solicitação de exclusão do id_prod =  ".$id." ao Banco de dados.";
}

if(!empty($_PUT)){
    $id = $_PUT["id"];
    $name = $_PUT["name"];
    $quantity = $_PUT["quantity"];
    $connection = mysqli_connect($host, $username, $password) or die("Erro ao conectar ao SGBD.");
    @mysqli_select_db($connection, $db) or die("Erro ao conectar ao BD.");
    mysqli_query($connection,"UPDATE products SET name='$name', quantity=$quantity WHERE id_prod=$id") or die("Erro ao executar a query");
    mysqli_close($connection);
    echo "Alterado id = ".$id." name = ".$name." quantity = ".$quantity;
}