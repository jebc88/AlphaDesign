<?php
require_once("lib/UtilidadesSesion.php");
require_once("lib/ConectorBD.php");

class Carrito {

    var $redirectUrl = 'carrito.php';

    function __construct() {
        $this->revisarCarrito();
    }

    function __destruct() {

    }

    function agregarACarrito($idProducto) {
        $sMensaje = '';
        //$aTempCarrito = $_SESSION['nombreCompleto'];
        $aTempCarrito = $_SESSION['carrito'];
        //echo $aTempCarrito;
        //$sMensajeError .= '<br/> Usuario o clave incorrectas.';
        //echo $sMensajeError;

        $query="INSERT INTO carrito(id_Producto, id_Sesion, cantidad) VALUES ($idProducto,'$aTempCarrito',1)";
        $carrito=ConectorBD::ejecutarQuery($query);
        $sMensaje .= '<br/> Producto Insertado exitosamente.';
        echo $sMensaje;



        header("Location: $this->redirectUrl");


    }



    /**
     * Retorna itemes de carro en el SESSION
     * @return array Itemes carro
     */
    function listadoItemesCarrito() {
        $aCarrito = $_SESSION['carrito'];
        // id, modelo, marca, precio
        $aItemesCarro = array();

        //construye itemes de carro
        foreach($aCarrito as $idModeloTelefono => $sCantidadModelo) {
            $aProducto = ConectorDatos::buscarProductoEspecifico($idModeloTelefono);
            $aProducto['cantidad'] = $sCantidadModelo;
            $aItemesCarro[] = $aProducto;
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
        //$_SESSION['carrito'] = array();
        $query="TRUNCATE TABLE carrito";
        $carrito=ConectorBD::ejecutarQuery($query);
        $sMensaje .= '<br/> Carrito Vaciado';
        echo $sMensaje;

    }

    /**
     * @param $idArticulo
     * @param $cantidad
     */
    function modificarArticulo($idProducto,$cantidad) {
        //$aTempCarrito = $_SESSION['carrito'];
        // id => cantidad
        //if(array_key_exists($idArticulo,$_SESSION['carrito'])) {
            //cantidad articulo 0, elimino de carrito
            //if($cantidad  == 0) {
              //  $this->eliminarArticuloDeCarrito($idArticulo);
            //} else {
               // $_SESSION['carrito'][$idArticulo] = $cantidad;
          //  }
        //}
        $aTempCarrito = $_SESSION['carrito'];
        $query="UPDATE carrito SET cantidad=$cantidad WHERE id_Producto=$idProducto and id_Sesion='$aTempCarrito' ";
        $carrito=ConectorBD::ejecutarQuery($query);
        $sMensaje .= '<br/> Producto Modificado';
        echo $sMensaje;



    }
    /**
     * Elimina artículo específico del carrito en sesión
     * @param $idArticulo Id del artículo
     */
    function eliminarArticuloDeCarrito($idProducto) {
        //if(array_key_exists($idArticulo,$_SESSION['carrito'])) {
          //  unset($_SESSION['carrito'][$idArticulo]);
        //}
        //echo $idProducto;
        $aTempCarrito = $_SESSION['carrito'];
        $query="DELETE FROM carrito WHERE id_Producto=$idProducto and id_Sesion= '$aTempCarrito'";
        $carrito=ConectorBD::ejecutarQuery($query);
        $sMensaje .= '<br/> Producto eliminado';
        echo $sMensaje;
    }
}
?>