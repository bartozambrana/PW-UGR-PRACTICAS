<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Ejercicio Sesi&oacute;n 4</title>
  </head>
  <body>
    <?php

      $dns = "mysql:host=localhost;db26504270_pw1819";
      $usuario = "db26504270_pw1920";
      $password = "26504270";

      $consultaSQL = "INSERT INTO  libros('123456789', 'Dune', 'HOLA', 'Atlanta', '478', '1989' )";

      try{
        $conexion->query($consultaSQL);
      }catch(PDOException $e){
        echo "Consulta Fallida: ".$e->getMessage();
      }

    ?>
  </body>
</html>
