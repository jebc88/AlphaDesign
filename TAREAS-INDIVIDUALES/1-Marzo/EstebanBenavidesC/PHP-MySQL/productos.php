<?php
session_start();
var_dump($_SESSION);
require_once("lib/UtilidadesSesion.php");
//require_once("lib/ConectorDatos.php"); - No se esta usando, se reemplazo por mysqlConnector.php
require_once("lib/Carrito.php");
require_once('lib/mysqlConnector.php');

//revisamos sesion activa
UtilidadesSesion::revisarSesionActiva();
//$aTelefonos = ConectorDatos::buscarProductos(); - No se esta usando, se reemplazo por mysqlConnector.php

// session DB
$host = "localhost";
$user = "root";
$pass = "hola123";
$dbName = "BdLaboratorio";

$dbcon =  mysqli_connect($host,$user,$pass, $dbName);
$list = mysqlConnector::returnQuery();
$result = mysqli_query($dbcon,$list);
// end of DB session

//creamos el carrito
$oCarrito = new Carrito();
if($_POST) {
    if($_POST['accion'] === 'agregar') {
        $oCarrito->agregarACarrito($_POST['idMarca'], $_POST['idProducto']);
    }
}

?>

<!DOCTYPE html>

<html>
<head lang="en">
    <meta charset="UTF-8">
    <style>
        div { border: solid 1px grey;padding: 5px;}
    </style>
</head>
<body>
<div id="header">
    Bienvenido <?php echo $_SESSION['nombreCompleto']; ?>
</div>
<div><?php //include('menu.php'); ?></div>
<div id="productos">

    <!-- Recorre filas de BD -->
    <?php while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){ ?>
            <ul class="telefonoEspecifico">
                <li><?php echo $row['nombre'];?></li>
                <li><?php echo $row['modelo'];?></li>
                <li><?php echo $row['precio'];?></li>
                <li>
                    <form id="agregarProducto" action="productos.php" method="post">
                        <input name="idMarca" type="hidden" value="<?php echo $row['id_marca'];?>">
                        <input name="idProducto" type="hidden" value="<?php echo $row['id'];?>">
                        <input name="accion" type="hidden" value="agregar">
                        <input type="submit" value="Agregar a Carrito">
                    </form>
                </li>
            </ul>
<?php } // end of while statement
    ?>
</div>
</body>
</html>
