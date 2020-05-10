<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Prueba de PHP</title>
  </head>
  <body>
    <p>Esto es una línea de HTML</p>
    <?php
      $matriz = array(array(1,2 ,3 ), array(4,5,6));

      for($i=0; $i < 2; $i++){
        for($j=0; $j < 3; $j++){
          echo "$matriz[$i][$j]";
        }
      }

      $i = 0;
      do {
        $j=0;
        do {
          echo $matriz[$i][$j]."";
          $j++;
        } while ($j < sizeof($matriz[$i]));
        $i++;
        echo "<br>";
      } while ($i < sizeof($matriz));
    ?>
  </body>
</html>
