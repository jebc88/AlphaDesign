<?php

/*
require_once('lib/mysqlConnector.php');

//$dbSession = new mysqlConnector();
$dbCon = mysqlConnector::connectDatabase();
$list = mysqlConnector::returnQuery();

$result = mysqli_query($dbCon,$list);

echo $result;
*/

/*
echo "<table>";
//echo "<tr>  <th>ID_MARCA</th> <th>MARCA</th> <th>ID_PROD</th> <th>MODELO</th> <th>PRECIO</th></tr>";

while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){

    echo "<tr><td>";
   // echo $row['id_marca'];
    echo "</td><td>";

    echo "<tr><td>";
   // echo $row['nombre'];
    echo "</td><td>";

    echo "<tr><td>";
   // echo $row['id'];
    echo "</td><td>";

    echo "<tr><td>";
   // echo $row['modelo'];
    echo "</td><td>";

    echo "<tr><td>";
   // echo $row['precio'];
    echo "</td></tr>";

}
echo "</table> <br>";

$array = array();
$array [1][1]=1;
$array [2][2]=2;
$array [3][3]=3;

foreach($array as $idm => $idp){
    echo " | ".$idm;
    foreach($idp as $idp2 => $x){
        echo "-". $idp2;
        echo $x;
    }

}
//var_dump ($array);
//echo "</table>";
*/



//$list = self::searchCartProduct();


function searchCartProduct($idMarca=2, $idProducto=2){
    require_once('lib/mysqlConnector.php');
    $host = "localhost";
    $user = "root";
    $pass = "hola123";
    $dbName = "BdLaboratorio";
    $dbcon =  mysqli_connect($host,$user,$pass, $dbName);
    $list = "SELECT m.nombre, p.modelo, p.precio FROM marca as m INNER JOIN productos AS p on m.id_marca = p.idMarca AND m.id_marca = $idMarca AND p.id = $idProducto";
    $result = mysqli_query($dbcon,$list);

    echo "<table>";
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){

        echo "<tr><td>";
        echo $row['nombre'];
        echo "</td><td>";

        echo "<tr><td>";
        echo $row['modelo'];
        echo "</td><td>";

        echo "<tr><td>";
        echo $row['precio'];
        echo "</td></tr>";

    }
    echo "</table> <br>";
}

searchCartProduct();


//echo "<tr>  <th>ID_MARCA</th> <th>MARCA</th> <th>ID_PROD</th> <th>MODELO</th> <th>PRECIO</th></tr>";




?>