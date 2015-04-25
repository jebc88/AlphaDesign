<?php

define('BACKUPDIR', '/tmp/db/');//esta carpeta debe crearse con chown mysql:mysql y chmod 777

define('THISPAGE', $_SERVER['PHP_SELF']);


function doHeader($title) {
	?><html><head><title><?php echo $title;?></title></head><body><?php
}

function doFooter() {
	
	?></body></html><?php
}


if (!empty($_POST['filename'])) {

	$errors = array();
	$n = 0;
	

	if (empty($_POST['filename'])) { 
		$errors[$n] = "Digite nombre de archivo.";
		$n++;
	}

	if (empty($_POST['mysqluser'])) { 
		$errors[$n] = "Digite MySQL username.";
		$n++;
	}

	if (empty($_POST['mysqlpass'])) { 
		$errors[$n] = "Digite password";
		$n++;
	}

	if ($_POST['backupall'] == 'false' AND empty($_POST['backupwhichdb'])) { 
		$errors[$n] = "Ha seleccionado realizar un backup pero no especifica algunos parametros.";
		$n++;
	}

	if ($n > 0) { 
		// display an error page
		doHeader('Remote Database Backup');

		?><h1>Backup de Base de datos</h1>
		<h2Backup no completado.</h2>
		<ul>
			<?php foreach ($errors as $err) { 
				?><li><?php echo $err; ?></li><?php
			}
			?>
		</ul>

		<a href="<?php echo THISPAGE;?>">Vuelva al formulario anterior</a>
		<?php
		doFooter();
		die(); 
	}

	
	$_POST['filename'] = escapeshellcmd($_POST['filename']);
	$_POST['mysqluser'] = escapeshellarg($_POST['mysqluser']);
	$_POST['mysqlpass'] = escapeshellcmd($_POST['mysqlpass']);
	$_POST['backupwhichdb'] = escapeshellarg($_POST['backupwhichdb']);

	// todas las bases
	$backupall = ($_POST['backupall'] == 'false') ? false : true;

	// solo unabd
	$dbarg = $backupall ? '-A' : $_POST['backupwhichdb'];

	// 
	$command = "mysqldump ".$dbarg." -u ".$_POST['mysqluser']." -p".$_POST['mysqlpass']." -r \"".BACKUPDIR.$_POST['filename']."\" 2>&1";

	
	doHeader('Remote Database Backup');

	?><h1>Ejecutando Backup...</h1><?php

	
	system($command);

	//se opta por comprimir
	if ($_POST['bzip'] == 'true') {
		system('bzip2 "'.BACKUPDIR.$_POST['filename'].'"');
	}

	

	?><h2>Ejecutado el proceso, si existe algun error verificar el mensaje anterior y resolverlo.</h2>
<a href="<?php echo THISPAGE;?>">Vuelva al formulario anterior</a><?php

	
	doFooter();
	
	die();
}

doHeader('Remote Database Backup');

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="Alpha"/>
    <meta name="author" content="Tansh" />
    <title>Respaldo</title>
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
                    <h1>Respaldos</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- empieza contenido
================================================== -->
<section id="content">
  <div class="container"> 
 
        <form name="dbbackup" method="post" action="<?php echo THISPAGE;?>">
          <p>Nombre archivo backup: <strong><?php echo BACKUPDIR;?></strong>
          <input type="text" name="filename" value="<?php echo date('dMY_H.i.s').'.sql';?>" /><br />
          <label for="bzipTick">Comprime el backup
            <input type="checkbox" name="bzip" value="true" id="bzipTick" />
          </label>
MySQL username: <input type="text" name="mysqluser" value="root" /><br />
MySQL password: <input type="password" name="mysqlpass" value="" /><br />
<label for="backupallFalse">
  Base de datos:
  <input type="text" name="backupwhichdb" value="bdreveladofotografico" />
</label>
</p>
          <p>&nbsp;</p>
          <p><br />
            <input type="submit" value="Crear Respaldo" />
          </p>
</form>
</section>

</body>
</html>