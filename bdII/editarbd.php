<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Bartolomé Zambrana Pérez">
  <title>Editar BD</title>
  <link rel="stylesheet" type="text/css" href="estilos.css">
  <script type="text/javascript" src="./validacion.js"></script>
</head>

<body>
  <!-- Cabecera -->
  <header>
    <!--logo-->
    <section class="encabezado">
      <img src="./imagenes/logo.jpg" id="logoCabecera" alt="Logo del gestor">
    </section>

    <!--Nombre del gestor -->
    <section class="encabezado">
      <h1 id="tituloCabecera">Contenido digital Netflix</h1>
    </section>

    <!--Zona en la que nos encontramos-->
    <section class="encabezado">
      <h2 id="subtituloCabecera">
        <?php 
            if(isset($_GET["bibliotecaEditar"])) //Comprobamos si se encuentra la variable
              echo 'Edici&oacute;n de biblioteca digital '.$_GET["bibliotecaEditar"];
        ?>
      </h2>
    </section>
  </header>
  <!-- Cuerpo de la página -->
  <main>

    <!-- Navagador, en su interior hemos situado en el caso de querer acceder de Barrionuevo
         a la página del gestor, en el futuro se podría implementar un mayor número de páginas
         principales dedicadas al gestor y podrían ser enlazadas en el interior de esta zona.
    -->
    <nav>
        <a href="./gestorbd.php" class="enlace1">Inicio</a>
    </nav>

    <!-- Sección para establecer el contenido principal de la página web -->
    <section id="seccionCentrada">
      <!-- Zona de insercción de una imagen, establecemos un enlace para simularlo -->
      <article>
        <h2 id="tituloGeneral">Datos Biblioteca Digital a Editar</h2>
        <?php 
          require_once("configuracion.php");
          require_once("conexion.php");
          require_once("tratamientoCadenas.php");

          $sql = "SELECT nombre, date_format(fechaalta,'%d/%m/%Y') fechaalta, date_format(fechabaja, '%d/%m/%Y') fechabajamodificada,fechabaja, descripcion FROM ".BIBLIOTECAS_DIGITALES ." WHERE nombre = :nombre";
          $sentencia = $conexion->prepare($sql);
          $sentencia->bindValue(":nombre",quitarAcentos($_GET["bibliotecaEditar"]) );
          $sentencia->execute();

          $resultado = $sentencia->fetchAll();
          foreach($resultado as $fila){
            echo'<ul class="relevante">
                  <li>Nombre de la biblioteca digital: '. $fila["nombre"] . '</li>
                  <li>Fecha de alta de la biblioteca digital: '. $fila["fechaalta"] .'</li>
                  <li>Fecha de baja de la biblioteca digital: '. $fila["fechabajamodificada"] .'</li>
                  <li>Descripcion: ' .$fila["descripcion"] . '</li>
                  
                </ul>';
          }
          $conexion = null;

        ?>
      </article>
      
      <article>
      <form id="formulario" action="procesarEdicionBD.php" method="post" name="formularioEditarBibliotecaDigital" onsubmit="return validarEditarBibliotecaDigital();">
        <fieldset>
          <legend>Datos Biblioteca Digital.</legend>
 
          <label for="fechaFinalizacionAlta">Fecha de finalizaci&oacute;n *</label>
          <input type="date" id="fechaFinalizacionAlta" name="fechaFinalizacionAlta" value="<?php echo $resultado[0]['fechabaja'];?>" /><br><br>

          <label for="Descripcion">Descripci&oacute;n *</label> <br><br>
          <textarea name="Descripcion" id="Descripcion" rows="8" cols="80" ></textarea>

          <input type="hidden" name="nombreBD" id="nombreBD" value="<?php echo quitarAcentos($_GET["bibliotecaEditar"]); ?>">
        </fieldset>
        <input type="submit" name="Enviar" class="boton" >
        <input type="reset" name="Reset" class="boton">
      </form>
      </article>
      
    </section>


  </main>
  <!-- Pie de la página -->
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
