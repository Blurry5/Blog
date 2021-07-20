<?php 

	require "DB/BaseDatos.php";

//Capturar datos de los campos
if (!empty($_POST['correo']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) ) {
  	//Verificar que el correo no se repita
  	$mensaje = '';

  	$sql = 'SELECT * FROM usuarios WHERE correo = ?';
	$sentencia = $conexion->prepare($sql);
	$sentencia->execute(array($_POST['correo']));
	$resultado = $sentencia->fetch();

	if ($resultado) {
		$mensaje = 'Este usuario ya existe.';
	}else{
		//Confirmar contraseña
		if ($_POST['password'] == $_POST['confirm_password']) {
			//Verificar correo electrónico
	  		if (filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {

				//Incorporar usuario a la base de datos
				$sql = "INSERT INTO usuarios (correo, password) VALUES (:correo, :password)";
				$declaracion = $conexion->prepare($sql);
				$declaracion->bindParam(':correo', $_POST['correo']);
				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
				$declaracion->bindParam(':password', $password);

				if ($declaracion->execute()) {
				    $mensaje = 'Usuario creado exitosamente, haga click en iniciar sesión.';
				} else {
				    $mensaje = 'Lo lamentamos debe de haber ocurrido un error a la hora de crearse la cuenta.';
				}

			}else{
				$mensaje = 'Correo electrónico inválido.';
			}	

	  	}else{
	  		$mensaje = 'Contraseña no válida. Ambas contraseñas deben coincidir.';
	  	}
	}
}
error_reporting(0);
 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vanegas Blog</title>
	<link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/formularioCSS/estilos.css">
</head>
<body>
	
	<?php require "parcial/header.php"?>
	
	<h1>Resgístrate</h1>

	<span>¿Ya tiene una cuenta? <a href="login.php">Iniciar sesión aquí</a></span><br>
	
	<div class="mensaje">
		<?php if (!empty($mensaje)):  ?>
			<p ><?= $mensaje ?></p>
		<?php endif; ?>
	</div>

	<form action="signup.php" method="POST">
		<input type="text" name="correo" placeholder="Tu correo" pattern="[A-Za-z0-9_@.ñ-]{1,40}" required>
		<input type="password" name="password" placeholder="Tu contraseña" pattern="[A-Za-z0-9_@.ñ-]{1,200}" required>
		<input type="password" name="confirm_password" placeholder="Repita su contraseña" pattern="[A-Za-z0-9_@.ñ-]{1,200}" required>
		<input type="submit" value="Crear cuenta">
	</form>

</body>
</html>