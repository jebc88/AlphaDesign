<?php

use Aws\S3\S3Client;
require 'C:\Users\Esteban\PhpstormProjects\AlphaDesign\vendor\autoload.php';
$config = require('C:\Users\Esteban\PhpstormProjects\AlphaDesign\app\config.php');

//S3
$s3 = S3Client::factory([
    'key' => $config['s3']['key'],
    'secret' => $config['s3']['secret']
    ]);

?>