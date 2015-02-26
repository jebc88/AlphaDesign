<?php
session_start();
var_dump($_SESSION);
require_once("lib/UtilidadesSesion.php");
require_once("lib/ConectorDatos.php");
require_once("lib/Carrito.php");

//revisamos sesion activa
UtilidadesSesion::revisarSesionActiva();

$oCarrito = new Carrito();

$aProductosCarro = $oCarrito->listadoItemesCarrito();

$eCarrito = new Carrito();
if($_POST) {
    if($_POST['accion'] === 'eliminar') {
        $eCarrito->eliminarDeCarrito($_POST['idProductoXEliminar']);
    }
    if($_POST['accion'] === 'vaciar') {
        $eCarrito->VaciarDeCarrito($_POST['IdProductoXVaciar']);
    }
    if($_POST['accion'] === 'modificar') {
        $eCarrito->ModificarDeCarrito($_POST['idProductoXModificar'],$_POST['nuevaCant']);
        //$eCarrito->ModificarDeCarrito($_POST['nuevaCant']);
        //echo $_POST['idProductoXModificar'];

    }
}



?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
            <?php foreach($aProductosCarro as $aDatosProducto) { ?>
                <ul>
                    <li>Producto:<?php echo $aDatosProducto['modelo']; ?></li>
                    <li>Marca:<?php echo $aDatosProducto['marca']; ?></li>
                    <li>Precio:<?php echo $aDatosProducto['precio']; ?></li>
                    <li>Cantidad:<?php echo $aDatosProducto['cantidad']; ?></li>
                </ul>
            <?php } ?>
        </div>


       <div>Modificar de carrito
            <form id="modificarCarrito-<?php echo $aDatosProducto['id']; ?>" action="carrito.php" method="post">
                <input name="idProductoXModificar" type="hidden" value="<?php echo $aDatosProducto['id']; ?>">
                Digita nueva cantidad:
                <br>
                <input type="text" value=" " name="nuevaCant">
                <br>
                <input name="accion" type="hidden" value="modificar">
                <input type="submit" value="Modificar Ultimo producto de Carrito">
            </form>
        </div>

        <div>Eliminar de carrito
    <hr>
            <form id="eliminarCarrito-<?php echo $aDatosProducto['id']; ?>" action="carrito.php" method="post">
                <input type="submit" value="Eliminar de Carrito">
                <input name="idProductoXEliminar" type="hidden" value="<?php echo $aDatosProducto['id']; ?>">
                <input name="accion" type="hidden" value="eliminar">
            </form>
    </div>

        <div>Vaciar carrito
            <hr>
            <form id="Vaciar-<?php echo $aDatosProducto['id']; ?>" action="carrito.php" method="post">
                <input type="submit" value="Vaciar carrito">
                <input name="IdProductoXVaciar" type="hidden" value="<?php echo $aDatosProducto['id']; ?>">
                <input name="accion" type="hidden" value="vaciar">
            </form>
        </div>


    </body>
</html>
