<?php

  require 'DB/BaseDatos.php';

  session_start();  

  //Redirigiendo usuario
  
  function tipoUsuario(){

    if (isset($_SESSION['sesion']) && isset($_SESSION['correo']) && isset($_SESSION['id'])) {

      switch($_SESSION['sesion'] && $_SESSION['correo']){

        case 0://Vista del usuario
          header("Location: ../blog");
          break;
          
        case 1://Vista del administrador
          header('Location: admin/admin.php');
        break;

        default:
      }
    }
  }

  //Autenficar un usuario
  if (!empty($_POST['correo']) && !empty($_POST['password'])) {
    
    $sql = $conexion->prepare('SELECT * FROM usuarios WHERE correo = :correo');
    $sql->bindParam(':correo', $_POST['correo']);
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    $mensaje = '';

    if (count($resultado) > 0 && password_verify($_POST['password'], $resultado['password'])) {
      
      if ($resultado == true) {
        // validando el tipo de usuario
      $_SESSION['sesion'] = $resultado['rol_id'];
      $_SESSION['correo'] = $resultado['correo'];
      $_SESSION['id'] = $resultado['id'];

        tipoUsuario();
          
      }

    } else {
      $mensaje = 'Correo o contraseña incorrecta';
    }
  }
?>

<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/formularioCSS/estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/tipoUsuario.js"></script>
    <title>Vanegas Blog</title>
  </head>

  <body>
    
    <?php require "parcial/header.php" ?>

  <h1>Iniciar sesión</h1>

  <span>¿No tiene una cuenta aún? <a href="signup.php">Regístrese aquí</a> </span><br>

  <div class="mensaje">
    <?php if (!empty($mensaje)) : ?>
      <p><?= $mensaje ?> </p>
    <?php endif; ?>
  </div>

  <form action="login.php" method="POST" id="inicio-sesion">
    <input type="text" name="correo" placeholder="Tu correo" pattern="[A-Za-z0-9_@.ñ-]{1,40}" required>
    <input type="password" name="password" placeholder="Tu contraseña" pattern="[A-Za-z0-9_@.ñ-]{1,200}" required>
    <input type="submit" value="Iniciar sesión">
  </form>

  </body>

</html>
