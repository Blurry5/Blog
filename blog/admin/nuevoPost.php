<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="UTF-8"><meta
   name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vanegas Blog</title>
  <link rel="stylesheet" href="../css/blogCSS/estilos.css">
  <link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
  </head>

  <body id="fondoFormulario">
    <h2>NUEVA ENTRADA PARA EL BLOG</h2>
    
    <form action="../controlador/transacciones.php" method="post" enctype="multipart/form-data" name="form1">
    <table >
    <tr>
        <td>Título: 
            <label for="titulo"></label></td>
        <td><input type="text" name="titulo" id="titulo"></td>
    </tr>

      <tr><td>Comentarios: 
          <label for="comentarios"></label></td>
          <td><textarea name="comentarios" id="comentarios" rows="10" cols="50"></textarea></td>
      </tr>

          <input type="hidden" name="MAX_TAM" value="5097152">

      <tr>
          <td colspan="2" align="left"><input type="file" name="imagen" id="imagen"></td>
      </tr>
        <tr>
          <td colspan="2">  
          <input type="submit" name="btn_enviar" id="btn_enviar" value="Enviar"></td>
        </tr>

      <tr><td colspan="2" align="center"><a href="admin.php">Volver al blog</a></td></tr>
      
      </table>

    </form>

  </body>
</html>