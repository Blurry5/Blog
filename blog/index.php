<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="UTF-8">
  <title>Vanegas Blog</title>
  <link rel="stylesheet" href="css/IntroCSS/estilos.css">
  <link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
  <body>

  <?php if (isset($_SESSION['sesion']) && isset($_SESSION['correo'])):  ?>

  <header>
    <h1>
      <a href="../blog"><img src="img/fondos/logo.PNG" /></a>
    </h1>
    <nav>
      <ul>
        <li><a href="usuario/blog.php">VISUALIZAR EL BLOG</a></li>
        <li><a href="#" id="expresate">EXPRÉSATE</a></li>
        <li><a href="#" id="contacto">CONTACTO</a></li>   
        <li><a href="#" id="ayuda">AYUDA</a></li>
        <li><a href="logout.php" >CERRAR SESIÓN</a></li>
      </ul>
    </nav>
  </header>
  <section id="contenido">
    
    <h2>
      <img src="img/fondos/decoracion.png" />
    </h2>
    <br><h3>¡Bienvenid@ <?php echo $_SESSION['correo']; ?> a mi blog! </h3> 
      
    <p>
      Le doy mi cordial bienvenida a mi blog de uso personal, un espacio donde subiré día a día ideas de lugares maravillosos para pasar el verano con los amigos o la familia. También subiré herramientas innovadoras para el uso de Web y muchos más!. Como te puedes dar cuenta, el proyecto se encuentra en sus inicios, espero que poco a poco se vaya fortaleciendo con la nutrición de nuevos contenidos y nuevas ideas.
    </p>

  </section>

  <script src="js/efectos.js"></script>

  <script>
    efectos();
  </script>

  <?php else: ?>
    <p class="inicio">
      Por favor <b><a  href="signup.php">Regístrese</a></b> o <b><a href="login.php">Inicie sesión</a></b>
  </p>
  <?php endif; ?>
  
  </body>
</html>