<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "receitas";
$id = $_GET["id"];

$connection = mysqli_connect($host, $username, $password) or die("Impossível conectar ao SGBD.");
@mysqli_select_db($connection, $db) or die("Impossível conectar ao BD.");
$result = mysqli_query($connection, "SELECT foto,tipo_foto FROM RECEITAS WHERE id=$id") or die("Impossível executar a query ");
$row = mysqli_fetch_object($result);
mysqli_close($connection);
Header("Content-type: image/$row->tipo_foto");
echo $row->foto;
