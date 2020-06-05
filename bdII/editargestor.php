<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Bartolomé Zambrana Pérez">
  <title>Edici&oacute;n de usuarios</title>
  <link rel="stylesheet" type="text/css" href="estilos.css">
  <script type="text/javascript" src="./validacion.js"></script>
</head>

<body>
  <?php 
    session_start();
  ?>

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
          echo $_SESSION['usuario'];
        ?>
      </h2>
    </section>
  </header>

  <!-- Cuerpo -->
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
      <article>
        <h2 id="tituloGeneral">Datos del usuario: </h2>
        <?php 
          echo '<p class="relevante" >Usuario: ' . $_SESSION['usuario'] . '<br>' .
                  'Email: ' . $_SESSION['email'] . '<br>' .  
                  'Tel&eacute;fono: ' . $_SESSION['telefono'] . '<br>' .
                  'Fecha de Nacimiento: ' . $_SESSION['fechaNacimiento'] . '<br>' .
          
               '</p>'
        ?>
      </article>

      <article>
        <form id="formulario" action="procesarEdicionUsuarioBD.php" method="post" name="formularioEdicionUsuario" onsubmit="return validarModificarUsuario();">
          <fieldset id="espaciadoFieldset">
            <legend>Datos personales a editar</legend>

            <label for="email">Email *</label>
            <input type="text" id="email" name="email" /><br><br>

            <label for="telefono">Tel&eacute;fono de contacto *</label>
            <input type="text" id="telefono" name="telefono" required /><br><br>

            <label for="fax">Fecha de Nacimiento *:  </label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" /><br><br>
          </fieldset>

          <button type="submit" name="Enviar" class="boton">Enviar</button>
          <button type="reset" name="Borrar" class="boton">Borrar</button>
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
