<?php
require_once("ConectorBD.php");

class Carrito {
    var $redirectUrl = 'carrito.php';

    function __construct() {
        $this->revisarCarrito();
    }
    function revisarCarrito() {
        if(array_key_exists('carrito',$_SESSION) === false){
            $_SESSION['carrito']= array();
        }
    }
    function __destruct() {

    }

    // Funciona bien
     function agregarACarrito($idMarca,$idProducto, $qty=1) {

        $id= ConectorBD::checkCartItem($idMarca, $idProducto);

        if(!$id){

            $newId=ConectorBD::newCartInsert($idMarca, $idProducto, $qty);
            //array_push($_SESSION['carrito'],$newId);
            $_SESSION['carrito'][$newId]= $qty;
            header("Location: $this->redirectUrl");

        }else {

            ConectorBD::updateCartInsert($id, $qty);
            $_SESSION['carrito'][$id]+= $qty;
            header("Location: $this->redirectUrl");

        }
    }


   // Funciona bien
    function listadoItemesCarrito() {

        $aItemesCarro = ConectorBD::searchCartItems();

        return $aItemesCarro;

    }

    // Funciona bien
    function modificarArticulo($idMarca, $idProducto ,$cantidad) {

        $idCarrito= ConectorBD::checkCartItem($idMarca, $idProducto);

        ConectorBD::editItemQuantity($idCarrito, $cantidad);

        $_SESSION['carrito'][$idCarrito]=$cantidad;
    }

    // Funciona bien
    function eliminarArticuloDeCarrito($idMarca, $idProducto) {

        $idCarrito= ConectorBD::checkCartItem($idMarca, $idProducto);

        if(array_key_exists($idCarrito,$_SESSION['carrito'])){

            unset($_SESSION['carrito'][$idCarrito]);
            ConectorBD::deleteCartItem($idCarrito);
        }

    }
}
?>