<?php
use Aws\S3\Exception\S3Exception;
require 'app/start.php';

if($_FILES){
    $file = $_FILES['file'];

    // file details
    $name = $file['name'];
    $tmp_name = $file['tmp_name'];
    $extension = explode('.', $name);
    $extension = strtolower(end($extension));

    // temp details
    $key = md5(uniqid());
    $tmp_file_name = "{$key}.{$extension}";
    $tmp_file_path = "temp/{$tmp_file_name}";

    //move file
    move_uploaded_file($tmp_name,$tmp_file_path);

    try{
        $s3->putObject([
            'Bucket' => $config['s3']['bucket'],
            'Key' => "temp/{$name}",
            'Body' => fopen($tmp_file_path,'rb'),
            'ACL' => 'public-read'
        ]);

        //Remove file
        unlink($tmp_file_path);

    }catch(S3Exception $e){
        die("Error uploading file");
    }

}
?>

<!DOCTYPE html>
<html>
<head >
    <meta charset="utf-8">
    <meta name="Author" content="Alpha Design">
    <title>Upload</title>
    <meta name="description" content="Pagina de ayuda al usuario">
    <link rel="stylesheet" href=" css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
</head>
<body>
<h3>Upload files</h3>
<div>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" name="submit" value="upload">
    </form>
</div>

</body>
</html>
