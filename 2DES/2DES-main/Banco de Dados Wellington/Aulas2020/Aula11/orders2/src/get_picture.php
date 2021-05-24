<?php
//Exemplo com programação estrutural, Esta classe funciona como um Controller MVC
//Comportamento de Read em um CRUD, porém somente para a IMAGEM
//Dados para conexão ao Banco de dados
$host = "localhost";
$username = "root";
$password = "";
$db = "orders";
if (!empty($_GET["id"])) {//Se receber o id do produto pelo verbo GET
    $id = $_GET["id"];
    $connection = mysqli_connect($host, $username, $password) or die("Impossível conectar ao SGBD.");
    @mysqli_select_db($connection, $db) or die("Impossível conectar ao BD.");
    $result = mysqli_query($connection, "SELECT picture FROM products WHERE id_prod=$id") or die("Impossível executar a query ");
    $row = mysqli_fetch_object($result);
    mysqli_close($connection);
    header("Content-type: image");
    echo $row->picture;
}
