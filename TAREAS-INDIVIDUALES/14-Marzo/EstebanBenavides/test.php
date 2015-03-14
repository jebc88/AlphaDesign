<?php

    /*
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "BdLaboratorio";

    $handler = new PDO("mysql:host=localhost;dbname=$dbName",$user, $pass);

    $query = $handler->query('INSERT INTO carrito (idMarca,idProducto,cantidad) VALUES (1,1,1)');

    if(!$query){

        echo 'error';
    }else{
        echo 'inserted';
    }
    */
    // busca en el indice marca el valor dado en array_key_exists() devuelve true o false
    $qty = 1;
    $a = array();
    $a[] = array('marca'=>1,array('producto'=>2,'cantidad'=>3));
    $a[] = array('marca'=>3,array('producto'=>4,'cantidad'=>1));
//var_dump($a);
    if(array_key_exists(1,$a)){
        echo 'existe';
    }else{
        echo 'nada paso';
    }

var_dump($a);

?>