<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Prueba de PHP</title>
  </head>
  <body>
    <p>Esto es una línea de HTML</p>
    <?php
      foreach ($_POST as $key => $value) {
        echo "$key: $value <br>";
      }
    ?>
  </body>
</html>
