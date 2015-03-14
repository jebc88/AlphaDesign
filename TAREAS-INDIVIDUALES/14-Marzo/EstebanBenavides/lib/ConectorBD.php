<?php

class ConectorBD {

    private static $host = "localhost";
    private static $port = "3306";
    private static $user = "root";
    private static $password = "";
    private static $dbh;
    private static $db = "BdLaboratorio";

    // Abrir conexion con BD
    static function openConnection(){
        $dbh = new PDO("mysql:host=localhost;dbname=BdLaboratorio", self::$user, self::$password);

        return $dbh;
    }

    // Retorna todos los productos
     static function returnAllProducts(){

        $handler = self::openConnection();
        $query = $handler->query('SELECT * FROM marca as m INNER JOIN productos as p on m.idMarca=p.IdMarca');

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $products[] = array('idMarca'=>$row['idMarca'], 'marca'=>$row['marca'], 'idProducto'=>$row['idProducto'], 'producto'=>$row['producto'], 'precio'=>$row['precio']);
        }

        return $products;
    }

     static function checkCartItem($idMarca, $idProducto){

        $handler = self::openConnection();
        $sql = "SELECT idCarrito FROM carrito WHERE idMarca=$idMarca AND idProducto=$idProducto";
        $id = $handler->query($sql);
        $id = $id->fetchColumn(0);
        return $id;

    }

    //
    static function searchCartItems(){

        $handler = self::openConnection();
        $sql = 'SELECT * FROM carrito';
        $query=$handler->query($sql);
        $products = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $products[] = array('idMarca'=>$row['idMarca'], 'marca'=>$row['marca'], 'idProducto'=>$row['idProducto'], 'producto'=>$row['producto'], 'precio'=>$row['precio'], 'cantidad'=>$row['cantidad']);
        }

        return $products;
    }

    // actualiza producto  en tabla carrito
     static function updateCartInsert($idCarrito, $cantidad){

        $handler = self::openConnection();
        $sql = "UPDATE carrito SET cantidad = cantidad + $cantidad WHERE idCarrito = $idCarrito";
        $handler->query($sql);
    }

    static function editItemQuantity($idCarrito, $cantidad){

        $handler = self::openConnection();
        $sql = "UPDATE carrito SET cantidad = $cantidad WHERE idCarrito = $idCarrito";
        $handler->query($sql);
    }

    static function deleteCartItem($idCarrito){

        $handler = self::openConnection();
        $sql = "DELETE FROM carrito WHERE idCarrito=$idCarrito";
        $handler->query($sql);

    }

    static function purgeCart(){

        $handler = self::openConnection();

        $sql = "DELETE FROM carrito";
        $handler->query($sql);

    }

    // inserta nuevos itemes en tabla carrito
     static function newCartInsert($idMarca, $idProducto, $cantidad){

        $handler = self::openConnection();
        $sql = "INSERT INTO carrito (idMarca,marca,idProducto,producto,precio,cantidad)
                                  SELECT m.idMarca, m.marca, p.idProducto,p.producto,p.precio,$cantidad
                                  FROM marca as m
                                  INNER JOIN productos as p
                                  on m.idMarca=p.idMarca
                                  AND m.idMarca = $idMarca
                                  AND p.idProducto=$idProducto";

        $handler->query($sql);
        $id = $handler->lastInsertId();

        return $id;
    }
}
?>