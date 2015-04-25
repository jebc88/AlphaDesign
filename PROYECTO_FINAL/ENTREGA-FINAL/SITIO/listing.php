<?php
require 'app/start.php';

$objects = $s3->getIterator('ListObjects',[
							'Bucket' => $config['s3']['bucket']
	]);

if(isset($_POST['delete'])){
	$s3->deleteObject(array(
			'Bucket' => $_POST['bucket'],
			'Key' => $_POST['key']
		));
	header('Location:listing.php');
}
//var_dump($objects);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Listing Page</title>	
	</head>
	<body>
		<table border="1px">
			<thead>
				<tr>
					<th>File</th>
					<th>Download</th>
					<th>Action</th>
				</tr>	
			</thead>
			<tbody>
				<?php foreach ($objects as $object) {?>
				<tr>
					<form action="listing.php" method="post">
						<td><?php echo $object['Key']; ?></td>
						<td> <a href="<?php echo $s3->getObjectURL($config['s3']['bucket'], $object['Key']); ?>" download><input type="button" name="download" value="Download"></a></td>
						<input name="bucket" type="hidden" value="<?php echo $config['s3']['bucket'];?>">
						<input name="key" type="hidden" value="<?php echo $object['Key'];?>">
						<td><input type="submit"  name="delete" value="Delete"></td>
					</form>
					
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</body>
</html>