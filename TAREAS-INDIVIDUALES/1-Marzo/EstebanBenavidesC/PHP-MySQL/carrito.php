<?php
session_start();
require_once("lib/UtilidadesSesion.php");
//require_once("lib/ConectorDatos.php");
require_once("lib/Carrito.php");
require_once('lib/mysqlConnector.php');

$oCarrito = new Carrito();

// idMarca - idProducto - cantidad
$aProductosCarro = $oCarrito->listadoItemesCarrito();
var_dump($_SESSION);

//revisamos sesion activa
UtilidadesSesion::revisarSesionActiva();

// session DB
$host = "localhost";
$user = "root";
$pass = "hola123";
$dbName = "BdLaboratorio";

$dbcon =  mysqli_connect($host,$user,$pass, $dbName);

// end of DB session



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
        <div>Productos agregados</div>
        <div id="productosDeCarrito">
            <hr>


            <?php foreach($aProductosCarro as $idMarca => $producto) {
                    foreach($producto as $idProducto => $qty) { ?>

                        <?php
                        $list = mysqlConnector::searchCartProduct($idMarca, $idProducto);
                        $result = mysqli_query($dbcon, $list);
                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) { ?>
                            <ul>
                                <li>Marca:<?php echo $row['nombre'];; ?></li>
                                <li>Modelo:<?php echo $row['modelo'];; ?></li>
                                <li>Precio:<?php echo $row['precio'];; ?></li>
                                <li>Cantidad:<?php echo $qty; ?></li>
                            </ul>

                        <?php } // end of while statement
                    } // end of second foreach
                ?>
                <form action="carrito.php" method="post">
                    <p>Editar cantidad</p>
                    <input type="int" name="cantidad" placeholder="<?php echo $qty ?>">
                    <input name="idMarca"  type="hidden" value="<?php echo $idMarca; ?>">
                    <input name="idProducto"  type="hidden" value="<?php echo $idProducto; ?>">
                    <input type="submit" name="edit" value="Editar">
                    <input type="submit" name="remove" value="Borrar">
                </form>


                <?php
                if (isset($_POST['remove'])) {
                    unset ($_SESSION['carrito'][$_POST['idMarca']][$_POST['idProducto']]);
                    header("location:carrito.php");
                }
                if (isset($_POST['edit'])) {
                    $_SESSION['carrito'][$_POST['idMarca']][$_POST['idProducto']] = $_POST['cantidad'];
                    header("location:carrito.php");
                }
            } // end of first foreach
            ?>
                <form action="carrito.php" method="post">
                    <input type="submit" name="purge" value="Empty Cart">
                    <input type="submit" name="logout" value="Log Out">
                    <input type="submit" name="goBack" value="Return">
                </form>
            <?php
                if (isset($_POST['logout'])) {
                    unset ($_SESSION['carrito']);
                    session_destroy();
                    header("location:formulario-sesiones.php");
                }
                if (isset($_POST['goBack'])) {
                    header("location:productos.php");
                }
                if (isset($_POST['purge'])) {
                    unset ($_SESSION['carrito']);
                    header("location:carrito.php");
                }
            ?>
        </div>
    </body>
</html>
