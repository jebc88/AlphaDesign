<?php
session_start();
require_once('database/MySQL.php');
$alert='';
$insert=array();
if(isset($_POST['submit'])){
    $insert=database::insertNewUser($_POST['identificacion'],
        $_POST['nombre'],
        $_POST['apellido1'],
        $_POST['apellido2'],
        $_POST['fechaNacimiento'],
        $_POST['genero'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['usuario'],
        $_POST['pass'],
        $_POST['tipo']);
    $alert='1';
}
if(isset($_POST['logout'])){
    unset($_SESSION);
    session_destroy();
    header('Location:index.php');
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Tansh" />
    <title>Nuevo usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link rel="shortcut icon" href="img/logoAlpha.png">

    <!--google web font-->
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
            <form method="post" action="newuser.php">
                <input name="logout" type="submit" value="Log Out">
            </form>
        </div>
        <div class="row">
            <!--logo starts-->
            <div class="span4 pos-rel"> <a href="index.php"><img src="img/logoAlpha.png" width="115" height="72" alt="logo"></a>
                <!--logo ends-->

                <!--menu starts-->
                <div class="span12">
                    <div class="menu-wrapper">
                        <div id="smoothmenu" class="ddsmoothmenu">
                            <ul>
                                <li><a href="home.php" class="selected">Regresar</a></li>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--menu ends-->

            </div>
        </div>
</section>
<!-- header final
================================================== -->

<!-- contenido
================================================== -->
<div id="content-top">
    <div id="content-top-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h1>Registre nuevo usuario</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="content">
    <div class="container">
        <form  id="contactform" method="post" action="newuser.php">
            <fieldset>
                <p align="center">
                    <input name="identificacion"  type="text" placeholder="Digite su identificación" align="center">
                </p>
                <p align="center">
                    <input name="nombre"  type="text" placeholder="Digite su nombre" align="center">
                </p>
                <p align="center">
                    <input name="apellido1"  type="text" placeholder="Digite su primer apellido" align="center">
                </p>
                <p align="center">
                    <input name="apellido2"  type="text" placeholder="Digite su segundo apellido" align="center">
                </p>
                <p align="center">
                    <input name="fechaNacimiento"  type="text" placeholder="Digite su fecha de nacimiento (AAAA-MM-DD)" align="center">
                </p>
                <p align="center">
                    <select name="genero">
                        <option value="M">Masculino </option>
                        <option value="F">Femenino</option>
                    </select>
                </p>
                <p align="center">
                    <input name="telefono"  type="text" placeholder="Digite número telefónico" align="center">
                </p>
                <p align="center">
                    <input name="correo"  type="text" class="required email" placeholder="Dirección de correo" align="center">
                </p>
                <p align="center">
                    <input name="usuario"   type="text" placeholder="Usuario" align="center">
                </p>
                <p align="center">
                    <input name="pass"   type="text" placeholder="Password" align="center">
                </p>
                <p align="center">
                    <select name="tipo">
                        <option value="1">Administrador</option>
                        <option value="2">Normal</option>
                        <option value="3">Automatizado</option>
                    </select>
                </p>
                <input type="submit" name="submit" value="Ingresar" /><br>
                <span style="color:red"> <?php if($insert){
                        foreach($insert as $data){
                            echo $data; ?><br><?php
                        }
                    } ?></span>
            </fieldset>
        </form>
    </div>

</section>

</body>
</html>
