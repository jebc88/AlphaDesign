<?php
session_start();
require_once('database/MySQL.php');
$error='';
$errorMsg =' ';
if($_POST) {
    $login = database::loginUser($_POST['myusername'], $_POST['mypassword']);
    if ($login == 0) {
        $error = '1';
        $errorMsg = 'Usuario o password incorrecto';
    }
    if ($login == 1) {
        header("Location:home.php");
    }
    if ($login == 2) {
        $error = '1';
        $errorMsg = 'Usuario ' . $_POST['myusername'] . ' esta inactivo: Contacte al administrador';
    }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="Alpha"/>
    <meta name="author" content="Tansh" />
    <title>AlphaDesign</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

   
    <link rel="shortcut icon" href="img/logoAlpha.png">
    <link rel="apple-touch-icon" href="img/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/icons/apple-touch-icon-114x114.png">

    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700' rel='stylesheet' type='text/css'>

    <!--style sheets-->
    <link rel="stylesheet" media="screen" href="css/bootstrap.css"/>
    <link rel="stylesheet" media="screen" href="css/bootstrap-responsive.css"/>
    <link rel="stylesheet" media="screen" href="css/style.css"/>
    <link rel="stylesheet" media="screen" href="css/flexslider.css"/>
    <link rel="stylesheet" media="screen" href="css/prettyPhoto.css"/>

    <!--main jquery libraries / others are at the bottom-->
    <script src="js/jquery-1.9.1.min.js" type="text/javascript" ></script>
    <script src="js/modernizr.js" type="text/javascript"></script>
</head>
<body>

<!-- header section starts
================================================== -->
<section id="header">
    <div class="container clearfix">
        <div class="row">

            <!--logo starts-->
            <div class="span4 pos-rel"> <a href="index.php"><img src="img/logoAlpha.png" width="115" height="72" alt="logo"></a>
                <!--logo ends-->

                <!--social starts-->
                <div class="span8">
                    <ul class="social">
                        <li class="pos-rel">
                            <div class="search-header">
                                <form class="searchform" method="get" action=".">
                                </form>
                            </div>
                        </li>
                        <div class="clearfix"></div>
                </div>

            </div>
        </div>
</section>

<div id="content-top">
    <div id="content-top-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h1>Bienvenido</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- empieza contenido
================================================== -->
<section id="content">
    <div class="container">

        <form  id="contactform" method="post" action="index.php">
            <fieldset>
                <p align="center">
                    <input name="myusername"  type="text" placeholder="Digite usuario" align="center">
                </p>
                <p align="center">
                    <input name="mypassword"  type="password" placeholder="Digite password" align="center">
                <p align="center">
                    <input name="submit"  type="submit" align="center" value="Acceder">
                </p>
            </fieldset>
            <span><?php if($error) { echo $errorMsg; } ?></span>
        </form>
    </div>

</section>

</body>
</html>