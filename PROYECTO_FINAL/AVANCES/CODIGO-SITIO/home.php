<?php
session_start();
$name = key($_SESSION);
require_once("database/MySQL.php");

if(isset($_POST['logout'])) {
    unset($_SESSION);
    session_destroy();
    header("Location:index.php");
}
?>


<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="ALPHA"/>
    <meta name="author" content="Tansh" />
    <title>AlphaDesign</title>
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
    <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/fullwidth.css" media="screen"/>

    
    <script src="js/jquery-1.9.1.min.js" type="text/javascript" ></script>
    <script src="js/modernizr.js" type="text/javascript"></script>
</head>
<body>
<!-- header section  -->
<section id="header">
    <div class="container clearfix">
        <div class="row">

            <!--logo starts-->
            <div class="span4 pos-rel"> <a href="home.php"><img src="img/logoAlpha.png" width="115" height="72" alt="logo"></a></div>
            <!--logo ends-->
            <form method="post" action="home.php">
              <div align="right">
                <input name="logout" type="submit" value="Log Out">
              </div>
            </form>
            <h2><strong>Bienvenido</strong> <?php echo $_SESSION[$name]['name'].' '.$_SESSION[$name]['lastname']; ?></h2>
            
          

            <!--menu starts-->
            <div class="span12">
                <div class="menu-wrapper">
                    <div id="smoothmenu" class="ddsmoothmenu">

                        <ul>
                            <li><a href="newuser.php" class="selected">Registrar Usuario Nuevo</a></li>
                            <li><a href="users.php">Usuarios Registrados</a> </li>
                            <li><a href="virtualmachines.php">Administración VM</a> </li>
                            <li><a href="configuracion.php">Nueva VM</a> </li>
                            <!--
                            <li><a href="#">Configuración</a>
                                <ul>
                                    <li><a href="configuracion.php">Nueva Virtual</a> </li>
                                    <li><a href="construccion.html">Generar Respaldo Base de Datos</a> </li>
                                    <li><a href="construccion.html">Eliminar Máquina</a> </li>
                                    <li><a href="construccion.html">Restaurar Máquina</a> </li>
                                </ul>
                                -->
                            <li><a href="help.html">Ayuda</a> </li>
                        </ul>

                    </div>
                    <ul class="inline-right">
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!--menu ends-->

        </div>
    </div>
</section>
<!-- header section ends
================================================== -->

<!--slider -->
<div id="slider-wrapper">
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <ul>

                <!--slide 1-->
                <li data-transition="fade" data-masterspeed="300">

                    <div class="caption large_text lfl"
                         data-x="30"
                         data-y="168"
                         data-speed="600"
                         data-start="500"
                         data-easing="easeOutExpo" data-endspeed="800" data-endeasing="easeInSine"> Administración más fácil</div>
                    <div class="caption large_text sfr sfl"
                         data-x="217"
                         data-y="168"
                         data-speed="600"
                         data-start="500"
                         data-easing="easeOutExpo" data-endspeed="800" data-endeasing="easeInSine"></div>
                    <div class="caption caption-box-grey lfl"
                         data-x="30"
                         data-y="222"
                         data-speed="800"
                         data-start="800"
                         data-easing="easeOutBack" data-endspeed="800" data-endeasing="easeInSine">Una forma de simplificar las tareas</div>
                     <div class="caption lft ltb"
                                 data-x="600"
                                 data-y="60"
                                 data-speed="600"
                                 data-start="1300"
                                 data-easing="easeOutExpo" data-endspeed="600" data-endeasing="easeInSine">
                                 <img src="img/rev-slider/slide-1/forslide.png" alt="image">
                                 </div>
                         </li>

            </ul>
        </div>
    </div>
</div>

<section id="content">

    <!--nubes start-->
    <div id="clouds">
        <div class="container">
            <div class="row">

                
                <div class="span6">
                <ul class="myunstyled features-style1">
                <li> <img src="img/icons/equipo.png" alt="icon" class="icon-bg">
                    <h2>Facilidad de administración</h2>
                    <p class="text-big"><strong>Alpha Design demuestra que las tecnologías de la información pueden ser cada vez más simples.</strong></p>
                </li>
                </ul>
                </div>

               
                <div class="span6">
                    <ul class="myunstyled features-style1">
                        <li> <img src="img/icons/equipo.png" alt="icon" class="icon-bg">
                            <h2 class="heading-styled">Nuestra base: <span> Trabajo en equipo</span></h2>
                            <p class="text-big">Establecemos objetivos comunes para lograr resultados más que exitosos .</strong></p>
                        </li>


                    </ul>
                </div>

</section>

<footer id="footer">
    <h5 align="center">ALPHA DESIGN</h5>
</footer>

<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript">
    //	var tpj=jQuery;
    //	tpj.noConflict();
    //<![CDATA[
    $(document).ready(function () {
        var api = $('.fullwidthbanner').revolution({
            delay: 9000,
            startwidth: 1170,
            startheight: 500,
            onHoverStop: "on", // Stop Banner Timet at Hover on Slide on/off
            thumbWidth: 100, // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
            thumbHeight: 50,
            thumbAmount: 3,
            hideThumbs: 1,
            navigationType: "none", // bullet, thumb, none
            navigationArrows: "solo", // nexttobullets, solo (old name verticalcentered), none
            navigationStyle: "round", // round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom
            navigationHAlign: "left", // Vertical Align top,center,bottom
            navigationVAlign: "bottom", // Horizontal Align left,center,right
            navigationHOffset: 30,
            navigationVOffset: 30,
            soloArrowLeftHalign: "left",
            soloArrowLeftValign: "center",
            soloArrowLeftHOffset: 20,
            soloArrowLeftVOffset: 0,
            soloArrowRightHalign: "right",
            soloArrowRightValign: "center",
            soloArrowRightHOffset: 20,
            soloArrowRightVOffset: 0,
            touchenabled: "on", // Enable Swipe Function : on/off
            stopAtSlide: -1, // Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
            stopAfterLoops: -1, // Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic
            hideCaptionAtLimit: 0, // It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
            hideAllCaptionAtLilmit: 0, // Hide all The Captions if Width of Browser is less then this value
            hideSliderAtLimit: 0, // Hide the whole slider, and stop also functions if Width of Browser is less than this value
            fullWidth: "on",
            shadow: 0 //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)
        });
    });
    //]]
</script>

</body>
</html>