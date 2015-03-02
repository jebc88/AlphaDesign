<?php

class Carrito {

    var $redirectUrl = 'carrito.php';

    function __construct() {
        $this->revisarCarrito();
    }

    function __destruct() {

    }

    // se modificaron parametros, ahora recibe idMarca, idProducto y un valor por defecto 1 para cantidad
    // $_SESSION[carrito] ahora tiene una estructura de [idMarca] - [idProducto] - [cantidad]
    function agregarACarrito($idMarca,$idProducto, $qty=1) {
        $aTempCarrito = $_SESSION['carrito'];

        if(array_key_exists($idMarca,$aTempCarrito)) {
            $aTempCarrito[$idMarca][$idProducto] += $qty;
        }else{
            $aTempCarrito[$idMarca][$idProducto] = $qty;
        }

        $_SESSION['carrito'] = $aTempCarrito;
        header("Location: $this->redirectUrl");
    }

    function eliminarDeCarrito() {

    }

    /**
     * Retorna itemes de carro en el SESSION
     * @return array Itemes carro
     */
    function listadoItemesCarrito() {
        $aCarrito = $_SESSION['carrito'];

        $aItemesCarro = array();

        foreach($aCarrito as $idMarca => $producto){

            foreach($producto as $idProducto => $qty){

                $aItemesCarro[$idMarca][$idProducto] = $qty;
            }
        }

        return $aItemesCarro;

    }

    function revisarCarrito() {
        if(array_key_exists('carrito',$_SESSION) === false){
            $_SESSION['carrito']=array();
        }
    }

    /**
     *
     */
    function borrarCarrito() {
        $_SESSION['carrito'] = array();
    }

    /**
     * @param $idArticulo
     * @param $cantidad
     */
    function modificarArticulo($idArticulo,$cantidad) {
        //$aTempCarrito = $_SESSION['carrito'];
        // id => cantidad
        if(array_key_exists($idArticulo,$_SESSION['carrito'])) {
            //cantidad articulo 0, elimino de carrito
            if($cantidad  == 0) {
                $this->eliminarArticuloDeCarrito($idArticulo);
            } else {
                $_SESSION['carrito'][$idArticulo] = $cantidad;
            }
        }
    }

    /**
     * Elimina artículo específico del carrito en sesión
     * @param $idArticulo Id del artículo
     */
    function eliminarArticuloDeCarrito($idArticulo) {
        if(array_key_exists($idArticulo,$_SESSION['carrito'])) {
            unset($_SESSION['carrito'][$idArticulo]);
        }
    }
}
?>