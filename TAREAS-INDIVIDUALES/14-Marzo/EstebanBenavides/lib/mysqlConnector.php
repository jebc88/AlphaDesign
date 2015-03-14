<?php

class mysqlConnector {

    /**
     * @return mysqli
     * Conexion base de datos
     */
    static function connectDatabase(){

        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbName = "BdLaboratorio";

        $dbcon =  mysqli_connect($host,$user,$pass, $dbName);

        return $dbcon;

    } // end of connectDatabase

    /**
     * @param $dbcon
     * Verifica estado de conexion de DB
     */
    function verifyDbConnection($dbcon){

        if(!$dbcon){
            die('Error connecting to database');
        }
    }

    // Devuelve todos los productos
    static function returnQuery(){

        $query = "SELECT m.idMarca, m.marca, p.idProducto, p.producto, p.precio FROM marca AS m INNER JOIN productos AS p on m.idMarca = p.idMarca";

        return $query;
    }

    /**
     * @return array
     * Devuelve todos los productos de la BD
     */
    static function productArray(){

        $dbcon = self::connectDatabase();
        $list = self::returnQuery();
        $result = mysqli_query($dbcon,$list);
        $products = array();

        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){

            $products[]= array($row['idMarca']=>array($row['marca'],$row['idProducto'],$row['producto'],$row['precio']));

            // array() = idMARCA => (marca, modelo, idProducto, producto, precio)
        }

        return $products;
    }

    // Busca productos del carrito
    static function searchCartProduct($sessionArray){

        $dbcon = self::connectDatabase();
        $cart = array();

        foreach($sessionArray as $idMarca => $idProducto){
            foreach($idProducto as $qty){

                $query = "SELECT m.idMarca, m.marca, p.idProducto, p.producto, p.precio FROM marca as m INNER JOIN productos AS p on m.idMarca = p.idMarca AND m.idMarca = $idMarca AND p.id = $idProducto";
                $result = mysqli_query($dbcon,$query);

                // Error en guardado de resultados en arreglo
                while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                    $cart[] = array($row['idMarca'] => array($row['marca'], $row['idProducto'], $row['producto'], $row['precio'], $qty));
                }
            }
        }

        return $cart;
    }

    /* No se esta usando por el momento
    function __construc(){
        $this->dbSession();
    } // end of constructor

    function dbSession(){
        if(array_key_exists('database', $_SESSION) == false){
            $_SESSION['database']=array();
        }
    } // end of dbSession
    */
}

?>