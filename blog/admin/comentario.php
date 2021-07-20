<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Refresh" content="1, url=http://localhost/PHP/blog/admin/foro.php?pagina=1">
	<title>Redireccionando</title>
	<link rel="stylesheet" href="../css/blogCSS/estilos.css">
</head>
<body id="fondoBlog">
	
</body>
</html>
<?php 
	$conexion = @mysqli_connect('localhost', 'root', 'Nfdeammd1!', 'blog');

	$comentario = @$_POST['comentario'];

	$comentario = @mysqli_real_escape_string($conexion, $comentario);

	if($comentario != ''){
		$resultado = mysqli_query($conexion, 'INSERT INTO comentario(comentario) VALUES ("' . $comentario . '")');
		echo "<script>alert('El comentario se subió con éxito')</script>";
	}else{
		echo 'Lastimosamente ha ocurrido un error, redireccionando al foro de nuevo';
	}
	mysqli_close($conexion);
 ?>
