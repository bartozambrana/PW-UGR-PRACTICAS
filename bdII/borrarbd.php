<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Bartolomé Zambrana Pérez">
  <title>Borrado de Bibliotecas digitales</title>
  <link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
  <header>
    <!--logo-->
    <section class="encabezado">
      <img src="./imagenes/logo.jpg" id="logoCabecera" alt="Logo del gestor">
    </section>

    <!--Nombre del gestor -->
    <section class="encabezado">
      <h1 id="tituloCabecera">Contenido digital Netflix</h1>
    </section>

    <!--Indicación de donde nos encontramos-->
    <section class="encabezado">
      <h2 id="subtituloCabecera">
        <?php 
            if(isset($_GET["bibliotecaBorrar"])) //Comprobamos si se encuentra la variable
              echo 'Borrado de la Biblioteca Digital '.$_GET["bibliotecaBorrar"];
        ?>
      </h2>
    </section>
  </header>

  <!-- Cuerpo -->
  <main>

      <!-- Navegador por si se quiere volver al inicio del todo -->
    <nav>
      <a href="./gestorbd.php" class="enlace1">Inicio</a>
    </nav>

    <!-- Sección que contiene el contenido principal -->
    <section id="seccionCentrada">
      <!-- Primera zona dediaca a la introducción de la información de la biblioteca -->
      <article>
        <h2 id="tituloGeneral">Datos Biblioteca Digital a eliminar</h2>
        <?php 
          require_once("configuracion.php");
          require_once("conexion.php");
          require_once("tratamientoCadenas.php");

          $sql = "SELECT nombre, date_format(fechaalta,'%d/%m/%Y') fechaalta, date_format(fechabaja, '%d/%m/%Y') fechabaja, descripcion FROM ".BIBLIOTECAS_DIGITALES ." WHERE nombre = :nombre";
          $sentencia = $conexion->prepare($sql);
          $sentencia->bindValue(":nombre",quitarAcentos($_GET["bibliotecaBorrar"]) );
          $sentencia->execute();

          $resultado = $sentencia->fetchAll();
          foreach($resultado as $fila){
            echo'<p class="relevante">
                  <ul>
                    <li>Nombre de la biblioteca digital: '. $fila["nombre"] . '</li>
                    <li>Fecha de alta de la biblioteca digital: '. $fila["fechaalta"] .'</li>
                    <li>Fecha de baja de la biblioteca digital: '. $fila["fechabaja"] .'</li>
                    <li>Descripcion: ' .$fila["descripcion"] . '</li>
                    
                   </ul>
                  </p>  ';
          }
          $conexion = null;

        ?>

      </article>
      <!-- Segunda zona dedicado al formulario de borrado de la biblioteca -->
      <article>
        <form id="formulario" action="procesarBorradoBD.php" method="post">
          <label for="motivoDeBorrado">Introduzca el motivo de borrado: </label> <br>
          <textarea rows="8" cols="80" id="motivoDeBorrado"></textarea>
          
          <!-- Para saber que biblioteca hay que -->
          <input type="hidden" name="nombreBD" id="nombreBD" value="<?php echo quitarAcentos($_GET["bibliotecaBorrar"]); ?>">

          <input type="submit" name="Enviar" class="boton">
          <input type="reset" name="Reset" class="boton">
        </form>
      </article>
    </section>
  </main>

  <!-- Pie de página -->
  <footer>
    <section>
      <h1 id="tituloPiePagina">Contacto-C&oacute;mo se hizo. </h1>
      <p id="fondoClaroParrafoPiePagina">En el siguiente enlace puede encontrar información del desarrollador del sitio web <a href="contacto.html" class="enlace2">Contacto</a>
        as&iacute; como se tomaron las decisiones en el proceso de desarrollo <a href="como_se_hizo.pdf" class="enlace2">C&oacute;mo se Hizo</a>
      </p>
    </section>
  </footer>
</body>

</html>
