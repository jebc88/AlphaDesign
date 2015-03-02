<?php

class mysqlConnector {

    // Devuelve todos los productos
    static function returnQuery(){

        $query = "SELECT m.id_marca, m.nombre, p.id, p.modelo, p.precio FROM marca AS m INNER JOIN productos AS p on m.id_marca = p.idMarca";

        return $query;
    }

    // Busca productos especificos
    static function searchCartProduct($idMarca, $idProducto){

        $query = "SELECT m.nombre, p.modelo, p.precio FROM marca as m INNER JOIN productos AS p on m.id_marca = p.idMarca AND m.id_marca = $idMarca AND p.id = $idProducto";

        return $query;
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

    /* No se esta usando por el momento
    static function connectDatabase(){

        $host = "localhost";
        $user = "root";
        $pass = "hola123";
        $dbName = "BdLaboratorio";

        $dbcon =  mysqli_connect($host,$user,$pass, $dbName);

        if(!$dbcon){
            die('Error connecting to database');
        }else{
            echo "Successfully connected to MySQL: " .$dbName;
            return $dbcon;
        }

    } // end of connectDatabase
    */
}

?>