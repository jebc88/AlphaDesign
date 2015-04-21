<?php

use Aws\S3\S3Client;
require 'C:\Users\Esteban\PhpstormProjects\AmazonS3\vendor\autoload.php';

        $s3 = S3Client::factory(["key" => '',
            "secret" => '']);

        $bucket = 'alpha-design-2015';

        $archivos = $s3->getListObjectsIterator(array(
            'Bucket' => $bucket,
            'Prefix'=> ''
        ));

?>
