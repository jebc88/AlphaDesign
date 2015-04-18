<?php
session_start();
require_once('database/MySQL.php');
$vms = array();
$detail = array();
$name = key($_SESSION);
$id = $_SESSION[$name]['id'];
$vms = database::getVirtualMachines();

if(isset($_POST['logout'])){
    unset($_SESSION);
    session_destroy();
    header('Location:index.php');
}

if(isset($_POST['detail'])){
    $detail = database::VMdetail($_POST['id']);
}

if(isset($_POST['backup'])){
    var_dump($_POST['idvm']);
    $backup = database::insertBackup($id,$_POST['idvm']);
    $vms = database::getVirtualMachines();
}
if(isset($_POST['restore'])){
    $restore = database::insertRestore($id,$_POST['idvm']);
    $vms = database::getVirtualMachines();
}
if(isset($_POST['delete'])){
    $delete = database::deleteVM($_POST['idvm']);
    $vms = database::getVirtualMachines();
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Tansh" />
    <title>Maquinas Virtuales</title>
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

<!-- header
================================================== -->
<section id="header">
    <div class="container clearfix">
        <div align="right">
            <form method="post" action="home.php">
                <input name="logout" type="submit" value="Log Out">
            </form>
        </div>
        <div class="row">

            <!--logo-->
            <div class="span4 pos-rel"> <a href="index.php"><img src="img/logoAlpha.png" width="115" height="72" alt="logo"></a>

                <!--menu-->
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



<div id="content-top">
    <div id="content-top-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h1><?php if($vms=='0'){echo 'NO EXISTEN MAQUINAS VIRTUALES';}else{echo 'Máquinas Virtuales Registradas';}?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- conten
================================================== -->

<!-- conten
================================================== -->
<section id="content">
    <div class="container">
        <table border="1px">
            <thead>
            <tr>
                <th colspan="3">Maquinas Virtuales</th>
            </tr>
            <tr>
                <th>NombreVM</th>
                <th>Descripcion</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <tr> <?php if($vms!='0'){foreach($vms as $data){ ?>
                <td><?php echo $data['nombre']; ?></td>
                <td><?php echo $data['descripcion']; ?></td>
                <td><?php if($data['estado']==1){echo 'Activo';}else{echo 'Inactivo';} ?></td>
                <form method="post" action="virtualmachines.php" name="users">
                    <input name="id" type="hidden" value="<?php echo $data['id'];?>">
                    <td><input type="submit"  name="detail" value="Ver Detalles"></td>
                </form>
            </tr>
            <?php } }?>
            </tbody>
        </table><br><br><br>
        <div>
            <table border="1px">
                <thead>
                <tr>
                    <th colspan="7">Detalle de VM</th>
                </tr>
                <tr>
                    <th>Usuario</th>
                    <th>NombreVM</th>
                    <th>Descripcion</th>
                    <th>RAM</th>
                    <th>IP</th>
                    <th>Fecha Creacion</th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                <tr> <?php foreach($detail as $data){ ?>
                    <th><?php echo $data['usuario']; ?></th>
                    <th><?php echo $data['nombre']; ?></th>
                    <th><?php echo $data['descripcion']; ?></th>
                    <th><?php echo $data['ram']; ?></th>
                    <th><?php echo $data['ip']; ?></th>
                    <th><?php echo $data['fecha']; ?></th>
                    <th><?php  if($data['estado']==1){echo 'Activo';}else{echo 'Inactivo';} ?></th>
                    <form method="post" action="virtualmachines.php" name="vms">
                        <input name="idvm" type="hidden" value="<?php echo $data['id'];?>">
                        <td><input type="submit"  name="backup" value="Respaldar"></td>
                        <td><input type="submit"  name="restore" value="Restaurar"></td>
                        <td><input type="submit"  name="delete" value="Eliminar"></td>
                    </form>
                </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</section>

</body>
</html>