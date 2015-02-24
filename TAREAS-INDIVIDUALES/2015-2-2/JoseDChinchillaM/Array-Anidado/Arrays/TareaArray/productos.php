<?php
                    require("lib\ConectorDatos.php");
                    $obj = new ConectorDatos();
                    $data=$obj->buscarProductos();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <style>
        div { border: solid 1px grey;padding: 5px;}
    </style>
</head>
<body>
<div id="header">
    Bienvenido
</div>
<div id="productos">
    <ul class="telefonoEspecifico">
        <li>Marca:
		<select name="marc" id="marc4">
                    		<?php
                    			foreach($data as $key=>$value)
                     			echo "<option>$key</option>";
                    		?>
                </select>

	</li>
	<li>Modelo:
		<select name="mol" id="mod">	  
				<?php  
					 
					foreach($data as $key=>$value){
					foreach($value as $tag_key=>$value2)
                     			echo "<option>$tag_key</option>";
					}
						   
				?>
		</select>
	</li>
	<li>Precio:
		<select name="prc" id="precios">  
				<?php  
					 
					foreach($data as $key=>$value){
					foreach($value as $tag_key=>$value2)
                     			echo "<option>$value[$tag_key]</option>";
					}
						   
				?>
		</select>
		</li>
  
    </ul>
</div>
</body>
</html>