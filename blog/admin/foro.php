<?php 

	session_start();

	include_once '../DB/BaseDatos.php';

	//Llamamos a la tabla
	$sql = 'SELECT * FROM comentario';
	$sentencia = $conexion->prepare($sql);
	$sentencia->execute();

	$resultado = $sentencia->fetchAll();
	$contenido_x_pagina = 8;

	//Contar contenido de la página
	$total_contenido_db = $sentencia->rowCount();

	$paginas = $total_contenido_db/8;
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
		<a class="nuevoPost" href="admin.php"><b>BLOG</b></a>
		<a class="cerrar-sesion" href="../logout.php"><b>CERRAR SESIÓN</b></a>
	</header>

	<br>

	<?php 
		if (!$_GET) {
			header('Location: foro.php?pagina=1');
		}
		if($_GET['pagina']>$paginas || $_GET['pagina']<= 0){
			header('Location: foro.php?pagina=1');
		}

		$iniciar = ($_GET['pagina']-1)*$contenido_x_pagina;
		
		$sql = 'SELECT * FROM comentario LIMIT :iniciar,:ncontenido';
		$sentencia = $conexion->prepare($sql);	
		$sentencia->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
		$sentencia->bindParam(':ncontenido', $contenido_x_pagina, PDO::PARAM_INT);
		$sentencia->execute();

		$tabla = $sentencia->fetchAll();
	 ?>

	

	<div class="post">
		<div class="col-11"><br>
			<h1>Comentarios</h1>
			<h3>¡Dudas, opiniones, impresiones... !</h3>
			<hr>
			<?php //Insertar comentario de usuario

				$conexion = mysqli_connect('localhost', 'root', 'Nfdeammd1!', 'blog');

				$resultado = mysqli_query($conexion, 'SELECT * FROM comentario');
				foreach($tabla as $contenido){
				
					
						?>
						<b><?php echo $_SESSION['correo']; ?> </b> (<?php echo $contenido['fecha'] ?>) dijo: <br><div class="comentarios">
						<?php echo $contenido['comentario']; ?></div>
						<hr>
						 
					<?php 
				}
			 ?>
		</div>		
	</div>
	<br>
	<div class="post">	
		<form id="formulario" action="" method="POST">
			<h3>Opine aquí:</h3>
			<textarea name="comentario" id="comentario" placeholder="Escribe aquí tu comentario" cols="60" rows="5"></textarea>
			<br><br>
			<input id="enviar" type="button" value="Comentar">
		</form>
	</div>
	<br><br>

	<nav aria-label="Page navigation example">

		<ul class="pagination">

			<li class="page-item <?php echo $_GET['pagina']<=1? 'disabled':'' ?>"><a class="page-link" href="foro.php?pagina=<?php echo $_GET['pagina']-1 ?>">Anterior</a></li>

			<?php for ($i=0; $i < $paginas; $i++): ?>

			<li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>"><a class="page-link" href="foro.php?pagina=<?php echo $i+1 ?>"><?php echo $i+1 ?></a></li>
			    <?php endfor ?>

		    <li class="page-item <?php echo $_GET['pagina']>=$paginas? 'disabled':'' ?>"><a class="page-link" href="foro.php?pagina=<?php echo $_GET['pagina']+1 ?>">Siguiente</a></li>

		</ul>

	</nav>
	<br>
	
</body>
	<script>
		$("#enviar").click(function() {
			var comentario = $('#comentario').val();
			if (comentario=="") {
				alert('Debe escribir un comentario');
				return;
			}
			$('#formulario').submit();
		});
	</script>
</html>