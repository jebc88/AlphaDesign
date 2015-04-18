<?php

class database {

    private static $host = "localhost";
    private static $port = "3306";
    private static $user = "root";
    private static $password = "";
    private static $dbh;
    private static $db = "bdreveladofotografico";

    // Abre conexion con la base de datos
    static function openConnection(){
        $dbh = new PDO("mysql:host=localhost;dbname=bdreveladofotografico", self::$user, self::$password);
        return $dbh;
    }

    //Devuelve todos los usuarios registrados, siempre hay minimo 1 usuario activo.
    static function getUsers(){
        $users = array();
        $handler = self::openConnection();
        $sql = 'CALL obtenerUsuarios()';
        $array = $handler->query($sql);
        while($row = $array->fetch(PDO::FETCH_ASSOC)){
            $users[] = array("id"=>$row['idUsuario'], "ident"=> $row['identificacion'],
                                    "nombre"=>$row['nombre'], "apellido1"=>$row['apellido1'],
                                    "apellido2"=>$row['apellido2'], "fechaNacimiento"=>$row['fechaNacimiento'],
                                    "genero"=>$row['genero'], "telefono"=>$row['telefono'],
                                    "correo"=>$row['correo'], "usuario"=>$row['usuario'],
                                    "tipo"=>$row['tipo'], "fechaCreacion"=>$row['fechaCreacion'],
                                    "estado"=>$row['estado']);
        }
        return $users;
    }

    // Devuelve todas las maquinas virtuales registradas, en caso de no encontrar devuelve 0
    static function getVirtualMachines(){
        $vms = array();
        $handler = self::openConnection();
        $sql = 'CALL obtenerMaquinasVirtuales()';
        $array = $handler->query($sql);

        if($row = $array->rowCount()){
            while($row = $array->fetch(PDO::FETCH_ASSOC)){
                $vms[] = array("id"=>$row['id'], "usuario"=>$row['usuario'],
                    "nombre"=>$row['nombre'],"descripcion"=>$row['descripcion'],
                    "fecha"=>$row['fecha'],"estado"=>$row['estado']);
            }
        }else{
            $vms = '0';
        }
        return $vms;
    }

    //Falta probar con formulario
    static function insertNewUser($id,$nombre,$apellido1,$apellido2,$fecha,$genero,$telefono,$correo,$user,$pass,$admin){
        $bindArray[]=$id;
        $bindArray[]=$nombre;
        $bindArray[]=$apellido1;
        $bindArray[]=$apellido2;
        $bindArray[]=$fecha;
        $bindArray[]=$genero;
        $bindArray[]=$telefono;
        $bindArray[]=$correo;
        $bindArray[]=$user;
        $bindArray[]=$pass;
        $bindArray[]=$admin;
        $result = array();
        $handler = self::openConnection();
        $sql = 'CALL insertarUsuarioNuevo(?,?,?,?,?,?,?,?,?,?,?)';
        $array = $handler->prepare($sql);
        $array->execute($bindArray);

        while($row = $array->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row['msg'];
        }
        return $result;
    }

    //Valida que usuario y password coincidan con al menos un regisro en la base de datos
    //Si coincide, verifica estado de usuario. Si es activo (1) devuelve 1. De lo contrario (0) devuelve 2.
    static function loginUser($username, $password){
        $bindArray[]=$username;
        $bindArray[]=$password;
        $handler = self::openConnection();
        $sucess = 0;
        $sql = 'CALL loguearUsuario(?,?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);

        if($result->rowCount()){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                if($row['estado']==1){
                    $_SESSION[$username] = array("id"=>$row['idUsuario'],"name" => $row['nombre'],"lastname"=>$row['apellido1'],
                        "tipo" => $row['tipo'], "estado" => $row['estado']);
                    $sucess = 1;
                }else{
                    $sucess = 2;
                }
            }
        }
        return $sucess;
    }

    // Desactiva estado de usuario especifico, recibe idUsuario como parametro.
    static function deactivateUser($userId){
        $bindArray[]=$userId;
        $handler = database::openConnection();
        $sql = 'CALL desactivarUsuario(?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);

        return true;
    }

    // Activa estado de usuario especifico, recibe idUsuario como parametro.
    static function activateUser($userId){
        $bindArray[]=$userId;
        $handler = database::openConnection();
        $sql = 'CALL activarUsuario(?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);

        return true;
    }

    //Elimina permanentemente usuario especifico de la base de datos. Recibe como parametro idUsuario.
    static function deleteUser($userId){
        $bindArray[]=$userId;
        $handler = database::openConnection();
        $sql = 'CALL eliminarUsuario(?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);

        return true;
    }

    //Devuelve detalles de usuario especifico. Recibe como parametro idUsuario.
    static function userDetail($userId){
        $user = array();
        $bindArray[]=$userId;
        $handler = database::openConnection();
        $sql = 'CALL detalleUsuario(?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $user[]=array("id"=>$row['idUsuario'],
                        "identificacion"=>$row['identificacion'],
                        "nombre"=>$row['nombre'],
                        "apellido1"=>$row['apellido1'],
                        "apellido2"=>$row['apellido2'],
                        "fechaNacimiento"=>$row['fechaNacimiento'],
                        "genero"=>$row['genero'],
                        "telefono"=>$row['telefono'],
                        "correo"=>$row['correo'],
                        "usuario"=>$row['usuario'],
                        "tipo"=>$row['tipo'],
                        "fechaCreacion"=>$row['fechaCreacion'],
                        "estado"=>$row['estado']);
        }
        return $user;
    }

    //Registra nueva maquina virtual a la base de datos.
    //Recibe como parametros, idUsuario que la crea, nombre de la VM, descripcion, cantidad RAM y la IP.
    static function newVirtualMachine($userId, $name, $description, $ram,$ip){
        $bindArray[]=$userId;
        $bindArray[]=$name;
        $bindArray[]=$description;
        $bindArray[]=$ram;
        $bindArray[]=$ip;
        $msg=array();
        $handler = database::openConnection();
        $sql = 'CALL insertarMaquinaVirtual(?,?,?,?,?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $msg[]=$row['msg'];
        }

        return $msg;
    }

    //Devuelve detalle de una maquina virtual especifica. Recibe como parametro idMaquinaVirtual.
    static function VMdetail($vmId){
        $vm = array();
        $bindArray[]=$vmId;
        $handler = database::openConnection();
        $sql = 'CALL detalleVM(?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $vm[] = array("id"=>$row['id'],
                        "usuario"=>$row['usuario'],
                        "nombre"=>$row['nombre'],
                        "descripcion"=>$row['descripcion'],
                        "ram"=>$row['ram'],
                        "ip"=>$row['ip'],
                        "fecha"=>$row['fecha'],
                        "estado"=>$row['estado']);
        }
        return $vm;
    }

    //Devuelve maquinas virtuales asociados a un usuario especifico, recibe idUsuario como parametro.
    static function getUserVM($iduser){
        $vms = array();
        $bindArray[]=$iduser;
        $handler = database::openConnection();
        $sql = 'CALL maquinasUsuario(?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $vms[] = array("idusuario"=>$row['idusuario'],
                            "idmaquina"=>$row['idmaquina'],
                            "nombre"=>$row['nombre']);
        }
        return $vms;
    }

    //Inserta registro de respaldo en base de datos. Recibe idUsuario y idMaquinaVirtual como parametros.
    static function insertBackup($iduser, $idvm){
        $msg = array();
        $bindArray[]=$iduser;
        $bindArray[]=$idvm;
        $handler = database::openConnection();
        $sql = 'CALL insertarRespaldo(?,?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $msg[]=array("exito"=>$row['msg']);
        }
        return $msg;
    }

    //Inserta registro de restauracion en base de datos. Recibe idUsuario y idMaquinaVirtual como parametros.
    static function insertRestore($iduser, $idvm){
        $msg = array();
        $bindArray[]=$iduser;
        $bindArray[]=$idvm;
        $handler = database::openConnection();
        $sql = 'CALL insertarRestaurado(?,?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $msg[]=array("exito"=>$row['msg']);
        }
        return $msg;
    }

    //Elimina un registro de maquina virtual, recibe como parametro idMaquinaVirtual.
    static function deleteVM($idvm){
        $msg = array();
        $bindArray[]=$idvm;
        $handler = database::openConnection();
        $sql = 'CALL eliminarVM(?)';
        $result = $handler->prepare($sql);
        $result->execute($bindArray);

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $msg[]=array("exito"=>$row['msg']);
        }
        return $msg;
    }
}
?>