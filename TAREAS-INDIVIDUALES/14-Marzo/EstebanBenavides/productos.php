<?php
session_start();
//var_dump($_SESSION);
require_once("lib/UtilidadesSesion.php");
require_once("lib/Carrito.php");
require_once('lib/ConectorBD.php');

//revisamos sesion activa
UtilidadesSesion::revisarSesionActiva();

// Retorna arreglo assoc: idMarca - marca - idProducto - producto - precio
$products = ConectorBD::returnAllProducts();

//creamos el carrito
$oCarrito = new Carrito();
if(isset($_POST['submit'])){

    $oCarrito->agregarACarrito($_POST['idMarca'], $_POST['idProducto']);
}
?>

<!DOCTYPE html>

<html>
<head lang="en">
    <meta charset="UTF-8">
    <style>
        div { border: solid 1px grey;padding: 5px;}
        li {list-style-type: none;}
    </style>
</head>
<body>
<div id="header">
    Bienvenido <?php echo $_SESSION['nombreCompleto']; ?>
</div>
<div><?php //include('menu.php'); ?></div>
<div id="productos">

    <!-- Recorre filas de BD -->
    <?php foreach($products as $data){ ?>
            <ul class="telefonoEspecifico">
                <li>Marca: <?php echo $data['marca'];?></li>
                <li>Modelo: <?php echo $data['producto'];?></li>
                <li>Precio: <?php echo $data['precio'];?></li>
                <li>
                    <form id="agregarProducto" action="productos.php" method="post">
                        <input name="idMarca" type="hidden" value="<?php echo $data['idMarca'];?>">
                        <input name="idProducto" type="hidden" value="<?php echo $data['idProducto'];?>">
                        <input name="submit" type="submit" value="Add to Cart">
                    </form>
                </li>
            </ul>
<?php      }

    ?>
</div>
</body>
</html>
