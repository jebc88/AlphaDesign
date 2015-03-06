<?php
class ConectorBD {
    private static $host = 'localhost';
    private static $port = '3306';
    private static $user = 'root';
    private static $password = 'hola123';
    private static $dbh;
    private static $db = 'bitic_25_dev_db';


    private static function abrirConexion()
    {
        try {
            self::$dbh = new PDO('mysql:host=localhost;dbname=bitic_25_dev_db', self::$user, self::$password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public function ejecutarQuery($sql)

    {
        ConectorBD::abrirConexion();
        //echo 'conexion exitosa';
        $query = self::$dbh->prepare("$sql");
        $query->execute();
        //echo 'query ejecutada';
        $result = $query->fetchAll();
        return $result;
    }


}
?>