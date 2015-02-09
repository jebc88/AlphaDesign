<?php
define('servidorBD', 'localhost');
define('nombreBD', 'unicenta');
define('usuarioBD', 'root');
define('passwdBD', 'hola123');
define('Resp', '/home/estudiante');
$hora = time();
$fecha = date("d-m-Y_H",$hora);
$archSQL= Resp . '/' ."RespaldoFull"."_". nombreBD . '_' . $fecha.'.sql';
$archResp =  $archSQL.'.tar'.'.gz';
$cmdDump = 'mysqldump  -h ' . servidorBD . ' -u ' . usuarioBD. ' -p' . passwdBD  . ' ' . nombreBD .'>'.$archSQL;
$cmdTar= 'tar -czf' .' '.$archResp .' '.$archSQL;
system($cmdDump);
system($cmdTar);
?>
