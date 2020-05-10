<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Prueba de PHP</title>
  </head>
  <body>
    <p>Esto es una línea de HTML</p>
    <?php
      echo "<p> Esto es una línea de PHP </p>";
      echo "Hola, caracola", 134;
      $nombre="Bartolomé Zambrana Pérez";
      echo "Mi nombre es ",$nombre;
      print_r("Mi nombre es",$ $nombre);
      $nombre_de_la_variable="temperatura";
      $$nombre_de_la_variable= 30.5;
      echo $temperatura;
      unset($temperatura);
      echo $temperatura;
    ?>
  </body>
</html>
