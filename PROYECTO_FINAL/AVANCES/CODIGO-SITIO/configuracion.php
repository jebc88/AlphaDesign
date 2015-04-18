<?php
session_start();
require_once('database/MySQL.php');
$name = key($_SESSION);
$id = $_SESSION[$name]['id'];
$vm = array();
if(isset($_POST['submit'])){
    $vm = database::newVirtualMachine($id, $_POST['nombre'], $_POST['descripcion'],$_POST['ram'],$_POST['ip']);
    $file = fopen("datos.txt", "w");
    fwrite($file, $_POST['nombre'] . PHP_EOL);
    fwrite($file, $_POST['ip'] . PHP_EOL);
    fwrite($file, $_POST['ram'] . PHP_EOL);
    fclose($file);
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
    <title>Configuracion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link rel="shortcut icon" href="img/logoAlpha.png">
    <link rel="apple-touch-icon" href="img/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/icons/apple-touch-icon-114x114.png">

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
        <form method="post" action="configuracion.php">
            <div align="right">
                <input name="logout" type="submit" value="Log Out">
            </div>
        </form>
        <div class="row">

            <!--logo-->
            <div class="span4 pos-rel"> <a href="home.php"><img src="img/logoAlpha.png" width="115" height="72" alt="logo"></a>
                <!--logo-->

               
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

<!-- contenido
================================================== -->
<div id="content-top">
    <div id="content-top-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h1>Nueva maquina virtual</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contenido
================================================== -->

<!-- contenido
================================================== -->
<section id="content">
    <div class="container">


        <form  id="contactform" method="post" action="configuracion.php" onSubmit="return myButton_onclick()">
            <fieldset>
                <p align="center">
                    <input name="nombre"  type="text" placeholder="Digite nombre de maquina virtual" align="center">ej: virtual01
                </p>
                <p align="center">
                    <input name="ip"  type="text" placeholder="Digite la IP" align="center">ej: 192.168.100.11
                </p>
                <p align="center">
                
                    <select name="ram">
  								<option value="1024">1024M</option>
  								<option value="2048">2048M</option>
  								<option value="4096">4096M</option>
					</select>
                Seleccione la cantidad de RAM
                </p>
                <p>
                    <textarea  rows="7" name="descripcion" id="message" class="required"  placeholder="Digite descripción"></textarea>ej: Maquina para POS
                </p>
                <input type="submit" name="submit" value="Generar"/><br>
                <span style="color:red">
                    <?php if($vm){
                        foreach($vm as $data){
                            echo $data; ?><br><?php
                        }
                    } ?>
                </span>
            </fieldset>
        </form>
    </div>
</section>

</body>
</html>