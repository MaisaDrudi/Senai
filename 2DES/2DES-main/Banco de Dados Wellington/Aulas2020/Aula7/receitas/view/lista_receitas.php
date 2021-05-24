<?php
/* Controller utilizando programação estrutural e função mysql_connect */
$host = "localhost";
$username = "root";
$password = "";
$db = "receitas";

$connection = mysqli_connect($host, $username, $password) or die("Impossível conectar ao SGBD.");
@mysqli_select_db($connection, $db) or die("Impossível conectar ao BD.");

$result = mysqli_query($connection,"SELECT id,tipo,nome,ingredientes,modo_de_fazer FROM receitas") or die("Impossível executar a query");

echo "<table><tbody>";
while($row=mysqli_fetch_object($result)) {
    echo "<tr><td>$row->id</td>";
    echo "<td>$row->tipo</td>";
    echo "<td>$row->nome</td>";
    echo "<td>$row->ingredientes</td>";
    echo "<td>$row->modo_de_fazer</td>";
    echo "<td><img src='get_foto.php?id=$row->id' /></td></tr>";
}
echo "</tbody></table>";
mysqli_close($connection);
