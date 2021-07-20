<?php 

session_start();

if (!isset($_SESSION['sesion'])) {
	header('Location: ../login.php');
}elseif ($_SESSION['sesion'] != 1) {
	header('Location: ../login.php');
}

include_once '../DB/BaseDatos.php';

//Llamamos a la tabla
$sql = 'SELECT * FROM contenido ORDER BY fecha ASC';
$sentencia = $conexion->prepare($sql);
$sentencia->execute();

$resultado = $sentencia->fetchAll();
$contenido_x_pagina = 2;

//Contar contenido de la página
$total_contenido_db = $sentencia->rowCount();

$paginas = $total_contenido_db/2;
$paginas = ceil($paginas);

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vanegas Blog</title>
	<link rel="stylesheet" href="../css/blogCSS/estilos.css">
	<link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body id="fondoBlog">
	<header id="encabezado">
		<a class="nuevoPost" href="nuevoPost.php"><b>CREAR NUEVO POST</b></a>
		<a class="nuevoPost" href="foro.php"><b>FORO/COMENTARIOS</b></a>
		<a class="cerrar-sesion" href="../logout.php"><b>CERRAR SESIÓN</b></a>
	</header>
	<br>
	<?php //Sanamos posibles errores de la paginación
		if (!$_GET) {
			header('Location: admin.php?pagina=1');
		}
		if($_GET['pagina']>$paginas || $_GET['pagina']<= 0){
			header('Location: admin.php?pagina=1');
		}

		$iniciar = ($_GET['pagina']-1)*$contenido_x_pagina;
		
		$sql = 'SELECT * FROM contenido LIMIT :iniciar,:ncontenido';
		$sentencia = $conexion->prepare($sql);	
		$sentencia->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
		$sentencia->bindParam(':ncontenido', $contenido_x_pagina, PDO::PARAM_INT);
		$sentencia->execute();

		$tabla = $sentencia->fetchAll();


		foreach($tabla as $contenido){
			//Rescatamos los valores del blog y su contenido

			echo "<div class='post'> <h3>" . $contenido['titulo'] . "</h3>";

			echo "<h4>" . $contenido['fecha'] . "</h4>";

			echo "<div class='comentarios'style='width:400px'>";
			echo $contenido['comentarios'] . "</div><br>";

			if($contenido['imagen']!=""){
					echo "<img src='../img/post/";
					echo $contenido['imagen'] . "' width='400px' height='200px'/>";
				}
			echo "</div> <hr/>"; 		
		}	
	?>

	<br><br>

	<nav aria-label="Page navigation example">
		    <ul class="pagination">
			    <li class="page-item <?php echo $_GET['pagina']<=1? 'disabled':'' ?>"><a class="page-link" href="admin.php?pagina=<?php echo $_GET['pagina']-1 ?>">Anterior</a></li>

			    <?php for ($i=0; $i < $paginas; $i++): ?>

			    <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>"><a class="page-link" href="admin.php?pagina=<?php echo $i+1 ?>"><?php echo $i+1 ?></a></li>
			    <?php endfor ?>

			    <li class="page-item <?php echo $_GET['pagina']>=$paginas? 'disabled':'' ?>"><a class="page-link" href="admin.php?pagina=<?php echo $_GET['pagina']+1 ?>">Siguiente</a></li>
		    </ul>
		</nav>
	<br>
 
</body>

<script>
	$("#enviar").click(function() {
		
		var nombre = $('#nombre').val();
		var comentario = $('#comentario').val();

		if (nombre=="") {
			alert('Debe insertar un nombre');
			return;
		}
		if (comentario=="") {
			alert('Debe escribir un comentario');
			return;
		}

		$('#formulario').submit();
	});
</script>
</html>