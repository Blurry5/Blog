<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Insertar Contenido a Blog Vanegas</title>
	<style>
		body{
			background-image: url('../img/fondos/fondo.jpg');
		}
		a{
			color: white;
			text-decoration: none;
		}
		#a1{
			float: left;
			margin-left: 5px;
		}
		#a2{
			margin-left: 15px;
		}
		nav{
			background-color: #e5005a;
			height: 30px;
		}
	</style>
</head>
<body>
	<nav>
		<a href="../admin/nuevoPost.php" id="a1">AÑADIR NUEVO POST</a>
		<a href="../admin/admin.php" id="a2">IR A VISUALIZAR BLOG</a>
	</nav>
	<?php 

	include "../DB/BaseDatos.php";
	include_once "../modelo/objeto.php";
	include "../modelo/manejo.php";

	
	

	//Control de errores de insertación de archivos
		if($_FILES['imagen']['error']){

			switch ($_FILES['imagen']['error']) {

				case 1:
					echo 'El tamaño del archivo es demasiado grande, no puede superar los 5MB';
					break;
				
				case 2:
					echo 'El tamaño del archivo se ha excedido';
					break;

				case 3:
					echo 'El envío del archivo se ha interrumpido, por favor vuelva a intentarlo';
					break;

				case 4:
					echo 'No se ha enviado ningún archivo';
					break;
			}

		}else{
			echo "El archivo se subió correctamente <br>";

			if (isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK)) {
				$ruta = "../img/post/";

				move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta . $_FILES['imagen']['name']);

				echo "El archivo " . $_FILES['imagen']['name'] . " se ha copiado en el directorio img";
			}else{
				echo 'El archivo no se copió en el directorio';
			}
		}

		$manejoObjetos = new ManejoObjetos($conexion);

		$blog = new Objeto();

		$blog->setTitulo(htmlentities(addslashes($_POST['titulo']), ENT_QUOTES));

		$blog->setFecha(Date("Y-m-d H:i:s"));

		$blog->setComentarios(htmlentities(addslashes($_POST['comentarios']), ENT_QUOTES));

		$blog->setImagen($_FILES['imagen']['name']);

		$manejoObjetos->insertarContenido($blog);

		echo '<br>Contenido agregado con éxito<br>' ;

	?>
	 
</body>
</html>