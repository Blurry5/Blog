<?php 

	session_start();

	include_once '../DB/BaseDatos.php';
	#PREPARANDO LA PAGINACIÓN
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
	<script src="https://kit.fontawesome.com/21e163927b.js" crossorigin="anonymous"></script>
</head>

<body id="fondoBlog">

	<header id="encabezado">
		<a class="nuevoPost" href="../index.php"><b>INICIO</b></a>
		<a class="nuevoPost" href="blog.php"><b>BLOG</b></a>
		<a class="cerrar-sesion" href="../logout.php"><b>CERRAR SESIÓN</b></a>
	</header>

	<br>
	<!-- SISTEMA DE PAGINACIÓN -->
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
	 <!-- COMENTARIOS -->
	<div class="post">
		<div class="col-11">
			<h1>Comentarios</h1>
			<h3>¡Dudas, opiniones, impresiones... !</h3>
			<hr>
		
			<?php
				foreach($tabla as $contenido){ ?>
					Usuario <a href="" class="perfil"><?php echo $contenido['id_usuario']; ?></a> <b>(<?php echo $contenido['fecha'] ?>)</b> dijo: <br><div id="comentarios">
					<?php echo $contenido['comentario']; ?></div>
					<hr>			 
			<?php 
				}
			 ?>
		</div>		
	</div>
	<br>
	<!-- FORMULARIO DE COMENTARIOS -->
	<div>	
		<form id="formulario" action="comentario.php" method="POST">
			<h3>Opine aquí:</h3>
			<textarea name="comentario" id="comentario" placeholder="Escribe aquí tu comentario" cols="60" rows="5"></textarea>
			<br><br>
			<input id="enviar" type="button" value="Comentar">
		</form>
	</div>
	<br><br>
	<!-- FINALIZACIÓN DE LA PAGINACIÓN -->
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