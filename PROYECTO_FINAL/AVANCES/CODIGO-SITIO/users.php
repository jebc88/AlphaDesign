<?php
session_start();
$name = key($_SESSION);
/*if($_SESSION[$name]['tipo']!=1){
    header('Location:error.php');
}*/
require_once('database/MySQL.php');
$users = array();
$detail = array();
$users = database::getUsers();
if(isset($_POST['logout'])){
    unset($_SESSION);
    session_destroy();
    header('Location:index.php');
}
if(isset($_POST['status'])){
    if($_POST['status'] =='Activar'){
        $mod = database::activateUser($_POST['id']);
    }else{
        $mod = database::deactivateUser($_POST['id']);
    }
    header("Location:users.php");
}
if(isset($_POST['detail'])){
    $detail = database::userDetail($_POST['id']);
}

if(isset($_POST['delete'])){
    $mod = database::deleteUser($_POST['id']);
    header("Location:users.php");
}

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Tansh" />
    <title>Usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

   
    <link rel="shortcut icon" href="img/logoAlpha.png">
    <link rel="apple-touch-icon" href="img/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/icons/apple-touch-icon-114x114.png">


    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" media="screen" href="css/bootstrap.css"/>
    <link rel="stylesheet" media="screen" href="css/bootstrap-responsive.css"/>
    <link rel="stylesheet" media="screen" href="css/style.css"/>
    <link rel="stylesheet" media="screen" href="css/flexslider.css"/>
    <link rel="stylesheet" media="screen" href="css/prettyPhoto.css"/>

    <script src="js/jquery-1.9.1.min.js" type="text/javascript" ></script>
    <script src="js/modernizr.js" type="text/javascript"></script>
</head>
<body>

<!-- header starts
================================================== -->
<section id="header">
    <div class="container clearfix">
        <div align="right">
            <form method="post" action="users.php">
                <input name="logout" type="submit" value="Log Out">
            </form>
        </div>
        <div class="row">

            <!--logo -->
            <div class="span4 pos-rel"> <a href="index.php"><img src="img/logoAlpha.png" width="115" height="72" alt="logo"></a>
                <!--logo -->
                <div class="span12">
                    <div class="menu-wrapper">
                        <div id="smoothmenu" class="ddsmoothmenu">
                            <ul>
                                <li><a href="home.php" class="selected">Regresar</a></li>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--menu-->

            </div>
        </div>
</section>
<!-- header 
================================================== -->

<!-- conten
================================================== -->
<div id="content-top">
    <div id="content-top-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h1>Usuarios de sistema</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- conten
================================================== -->

<!-- contenido
================================================== -->
<section id="content">
    <div class="container">
        <table border="1px">
            <thead>
            <tr>
                <th colspan="5">Usuarios de Sistema</th>
            </tr>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Creacion</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <tr> <?php foreach($users as $data){ ?>
                <td><?php echo $data['usuario']; ?></td>
                <td><?php echo $data['apellido1'].', '.$data['nombre']; ?></td>
                <td><?php if($data['tipo']==1){echo 'Administrador';}elseif($data['tipo']==2){echo 'Normal';}else{echo 'Automatizado';} ?></td>
                <td><?php echo $data['fechaCreacion']; ?></td>
                <td><?php if($data['estado']==1){echo 'Activo';}else{echo 'Inactivo';} ?></td>
                <form method="post" action="users.php" name="users">
                    <input name="id" type="hidden" value="<?php echo $data['id'];?>">
                    <td><input type="submit"  name="status" value="<?php if($data['estado']==1){echo 'Desactivar';}else{echo 'Activar';}?>"></td>
                    <td><input type="submit"  name="detail" value="Ver Detalles"></td>
                    <td><input type="submit"  name="delete" value="Eliminar"></td>
                </form>
            </tr>
            <?php  }?>
            </tbody>
        </table><br><br><br>
<div>
        <table border="1px">
            <thead>
            <tr>
                <th colspan="10">Detalle de usuario</th>
            </tr>
            <tr>
                <th>Identificacion</th>
                <th>Nombre Completo</th>
                <th>Fecha Nacimiento</th>
                <th>Genero</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Tipo</th>
                <th>Fecha Creacion</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
                <tr> <?php foreach($detail as $data){ ?>
                    <th><?php echo $data['identificacion']; ?></th>
                    <th><?php echo $data['apellido1'].' '.$data['apellido2'].', '.$data['nombre']; ?></th>
                    <th><?php echo $data['fechaNacimiento']; ?></th>
                    <th><?php echo $data['genero']; ?></th>
                    <th><?php echo $data['telefono']; ?></th>
                    <th><?php echo $data['correo']; ?></th>
                    <th><?php echo $data['usuario']; ?></th>
                    <th><?php if($data['tipo']==1){echo 'Administrador';}elseif($data['tipo']==2){echo 'Normal';}else{echo 'Automatizado';} ?></th>
                    <th><?php echo $data['fechaCreacion']; ?></th>
                    <th><?php if($data['estado']==1){echo 'Activo';}else{echo 'Inactivo';} ?></th>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <span style="color:red">
        <?php if($vms='0'){
            echo 'NO EXISTEN MAQUINAS VIRTUALES';
        }?>
    </span>
</div>
    </div>
</section>

</body>
</html>