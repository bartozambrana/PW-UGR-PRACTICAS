<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Prueba de PHP</title>
  </head>
  <body>
    <p>Esto es una línea de HTML</p>
    <?php
       $capitales = array("Londres","Madrid","Berlín");
       echo "<pre>";
       var_dump($capitales);
       echo "</pre>";
       echo "<pre>";
       print_r($capitales);
       echo "</pre>";
    ?>
  </body>
</html>
