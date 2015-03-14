<?php
/* Connecting to DB
print PDO::getAvailableDrivers(); //this is how we know what we can use
$user = '';
$host = 'localhost';
$pass = '123';

$handler = PDO('mysql:host=127.0.0.1;dbname=BdLaboratorio', $user, $pass);

//error catch
 try {
	 $handler = PDO('mysql:host=127.0.0.1;dbname=BdLaboratorio', $user, $pass);
	 $handler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION)
 }catch(PDOException $e){
	 echo 'Caught error;'
	 die('DB Problem');
	 echo $e->getMessage(); // specifies error
 }
?>

<?php
// Getting results (SELECT)

$query = $handler->query('SELECT * FROM marca');

while($row = $query->fetch()) {
	
	//echo $row['id_marca'];
	//echo $row['nombre'];
	//or to check associative array structure
	
	echo '<pre>', print_r($row), '</pre>';
}
?>

<?php
//Fetch types (select how data to be returned)

$query = $handler->query('SELECT * FROM marca');

while($row = $query->fetch(FETCH_OBJ)) {
	
	//fetch() -> FETCH_OBJ = return object ** preferable
	//fetch() -> FETCH_ASSOC = return associative array
	//fetch() -> FETCH_NUM = returns a numeric array

	echo $row->message; // summon directly by object name instead of array
}

echo $handler->lastInsertId();
*/

require_once ("lib/ConectorBD.php");

$handler=ConectorBD::openConnection();
$idMarca = 1;
$idProducto = 1;
$cantidad = 1;
$sql ="SELECT idCarrito FROM carrito WHERE idMarca=$idMarca AND idProducto=$idProducto";
$id = $handler->query($sql);
$id = $id->fetchColumn(0);
$sql = "UPDATE carrito SET cantidad= cantidad+$cantidad WHERE idCarrito=$id";
$handler->query($sql);

//var_dump($id);
/*
$sql = "INSERT INTO carrito (idMarca,marca,idProducto,producto,precio,cantidad)
                                  SELECT m.idMarca, m.marca, p.idProducto,p.producto,p.precio,1
                                  FROM marca as m
                                  INNER JOIN productos as p
                                  on m.idMarca=p.idMarca
                                  AND m.idMarca = 2
                                  AND p.idProducto=2";

$handler->query($sql);

echo $handler->lastInsertId();
*/
?>