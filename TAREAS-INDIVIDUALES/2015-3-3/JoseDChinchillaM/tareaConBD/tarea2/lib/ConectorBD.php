<?php
class ConectorBD {
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "hola123";


    private static function abrirConexion()
    {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=bitic_25_dev_db", $username, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //$sth = $conn->prepare("SELECT id_marca, nombre FROM marca");
            //$sth->execute();
            //$result = $sth->fetchAll((PDO::FETCH_COLUMN | PDO::FETCH_GROUP));
            //var_dump($result);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public function ejecutarQuery()

    {
        ConectorBD::abrirConexion();
        $sth = $conn->prepare("SELECT id_marca, nombre FROM marca");
        $sth->execute();
        $result = $sth->fetchAll((PDO::FETCH_COLUMN | PDO::FETCH_GROUP));
        return ($result);
    }


}
?>