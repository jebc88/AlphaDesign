<?php
session_start();
require_once("lib/UtilidadesSesion.php");
require_once("lib/ConectorDatos.php");
require_once("lib/Carrito.php");
$counter = 1;
var_dump($_SESSION);
//revisamos sesion activa
//UtilidadesSesion::revisarSesionActiva();

$oCarrito = new Carrito();

$aProductosCarro = $oCarrito->listadoItemesCarrito();

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
            <?php foreach($aProductosCarro as $aDatosProducto) { ?>
                <ul>
                    <li>Producto:<?php echo $aDatosProducto['modelo']; ?></li>
                    <li>Marca:<?php echo $aDatosProducto['marca']; ?></li>
                    <li>Precio:<?php echo $aDatosProducto['precio']; ?></li>
                    <li>Cantidad:<?php echo $aDatosProducto['cantidad']; ?></li>
                </ul>
                <form action="carrito.php" method="post">
                    <p>Editar cantidad</p>
                    <input type="int" name="cantidad" placeholder="<?php echo $aDatosProducto['cantidad']?>">
                    <input name="counter" type="hidden" value="<?php $counter++; ?>"> <!-- claramente $counter no funciona para mi proposito -->
                    <input type="submit" name="edit" value="Editar">
                    <input type="submit" name="remove" value="Borrar">
                </form>
            <?php }
                if (isset($_POST['remove'])){
                    unset ($_SESSION['carrito'][$counter]); //No logro una forma de extraer/buscar el indice del arreglo que me interesa borrar $counter no funciona
                }
                if (isset($_POST['edit'])){
                    $_SESSION['carrito'][1]= $_POST['cantidad']; // FUNCIONA BIEN
                }
            ?>
                <form action="carrito.php" method="post">
                    <input type="submit" name="logout" value="Log Out">
                </form>
            <?php
                if (isset($_POST['logout'])) {
                    session_destroy();
                    header("location:formulario-sesiones.php"); // FUNCIONA
                }
            ?>
        </div>
    </body>
</html>
