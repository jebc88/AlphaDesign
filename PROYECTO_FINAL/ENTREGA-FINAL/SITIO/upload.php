<?php
use Aws\S3\Exception\S3Exception;
require 'app/start.php';

if(isset($_FILES['file'])){

	$file = $_FILES['file'];

	//file details
	$name = $file['name'];
	$tmp_name = $file['tmp_name'];

	$extension = explode('.', $name);
	$extension = strtolower(end($extension));

	// temp details
	$key = md5(uniqid());
	$tmp_file_name = "{$key}.{$extension}";
	$tmp_file_path = "temp/{$tmp_file_name}";

	//move the file
	move_uploaded_file($tmp_name, $tmp_file_path);

	try{

		$s3->putObject([
			'Bucket' => $config['s3']['bucket'],
			'Key' => "{$name}",
			'Body' => fopen($tmp_file_path, 'rb'),
			'ACL' => 'public-read'
			]);
		
		unlink($tmp_file_path);

	}catch(S3Exception $e){
		die("There was an error uploading the file");
	}

	//var_dump($tmp_file_path);

}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Upload Page</title>	
	</head>
	<body>
		<h3>Amazon S3 Bucket</h3><br>
		<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="file">
			<input type="submit" value="Upload">
		</form>

	</body>
</html>
