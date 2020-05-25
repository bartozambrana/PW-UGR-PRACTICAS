<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Bartolomé Zambrana Pérez">
  <title>Crear BD</title>
  <link rel="stylesheet" type="text/css" href="estilos.css">
  <script type="text/javascript" src="./validacion.js"></script>
</head>

<body>

  <?php 
    session_start();
  ?>
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
      <h2 id="subtituloCabecera"><?php echo $_SESSION['usuario']?></h2>
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
    
    <!-- Zona princiapl de la página web-->
    <section>
      <form id="formularioCentrado" action="procesarCrearBD.php" method="post" name="formularioCrearBD" onsubmit="return validarCrearBD();" enctype="multipart/form-data">

        <fieldset >
          <legend>Datos Biblioteca Digital.</legend>
          <article class="apilamiento2Secciones">
            <input type="file" name="seleccionImagenBD" class="boton" id="seleccionImagenBD" >
          </article>

          <article class="apilamiento2Secciones">
            <label for="titulo">Titulo *</label>
            <input type="text" id="titulo" name="titulo" /><br><br>

            <label for="fechaDeAlta">Fecha de Alta *</label>
            <input type="date" id="fechaDeAlta" name="fechaDeAlta"  /><br><br>

            <label for="fechaFinalizacionAlta">Fecha de finalizaci&oacute;n *</label>
            <input type="date" id="fechaFinalizacionAlta" name="fechaFinalizacionAlta"  /><br><br>
          </article>
          <article>
            <label for="Descripcion">Descripci&oacute;n *</label> <br><br>
            <textarea name="Descripcion" id="Descripcion" rows="8" cols="80" ></textarea>
          </article>

        </fieldset>
        <input type="submit" name="Enviar" class="boton" onclick="return validarCrearBD();">
        <input type="reset" name="Reset" class="boton">
      </form>
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
