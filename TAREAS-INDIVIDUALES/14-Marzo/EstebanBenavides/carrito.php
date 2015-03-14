<?php
session_start();
require_once("lib/UtilidadesSesion.php");
require_once("lib/ConectorBD.php");
require_once("lib/Carrito.php");

$oCarrito = new Carrito();
// idMarca - idProducto - cantidad

$aProductosCarro= $oCarrito->listadoItemesCarrito();
//var_dump($aProductosCarro);
var_dump($_SESSION['carrito']);
//revisamos sesion activa
UtilidadesSesion::revisarSesionActiva();

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


            <?php foreach($aProductosCarro as $data) {
                     ?>
                            <ul>
                                <li>Marca:<?php echo $data['marca']; ?></li>
                                <li>Modelo:<?php echo $data['producto']; ?></li>
                                <li>Precio:<?php echo $data['precio']; ?></li>
                                <li>Cantidad:<?php echo $data['cantidad']; ?></li>
                            </ul>

                            <form action="carrito.php" method="post">
                                <p>Editar cantidad</p>
                                <input type="int" name="cantidad" placeholder="<?php echo $data['cantidad']; ?>">
                                <input name="idMarca"  type="hidden" value="<?php echo $data['idMarca']; ?>">
                                <input name="idProducto"  type="hidden" value="<?php echo $data['idProducto']; ?>">
                                <input type="submit" name="edit" value="Editar">
                                <input type="submit" name="remove" value="Borrar">
                            </form>


                <?php } //end of first foreach

                if (isset($_POST['remove'])) {
                    $oCarrito->eliminarArticuloDeCarrito($_POST['idMarca'],$_POST['idProducto']);
                    header("location:carrito.php");
                }
                if (isset($_POST['edit'])) {
                    $oCarrito->modificarArticulo($_POST['idMarca'],$_POST['idProducto'],$_POST['cantidad']);
                    header("location:carrito.php");
                }
            ?>
                <form action="carrito.php" method="post">
                    <input type="submit" name="purge" value="Empty Cart">
                    <input type="submit" name="logout" value="Log Out">
                    <input type="submit" name="goBack" value="Return">
                </form>
            <?php
                if (isset($_POST['logout'])) {

                    ConectorBD::purgeCart();
                    unset ($_SESSION['carrito']);
                    session_destroy();
                    header("location:formulario-sesiones.php");
                }
                if (isset($_POST['goBack'])) {
                    header("location:productos.php");
                }
                if (isset($_POST['purge'])) {
                    ConectorBD::purgeCart();
                    unset ($_SESSION['carrito']);
                    header("location:carrito.php");
                }
            ?>
        </div>
    </body>
</html>
