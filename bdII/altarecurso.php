<!DOCTYPE html>
<html lang="es" >
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Bartolomé Zambrana Pérez">
    <link rel="stylesheet" type="text/css" href="./estilos.css">
    <title>Alta de Recurso</title>
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
        <h1 id="tituloCabecera">Pel&iacute;culas</h1>
      </section>

      <!--Indicación de donde nos encontramos-->
      <section class="encabezado">
        <h2 id="subtituloCabecera">Alta de Recurso</h2>
      </section>
    </header>

    <!-- Cuerpo de la página -->
    <main>
      <!--
          Navegador por si se quiere volver al incio de la biblioteca como si se quiere navegar a las distintas seccciones
          de dicha biblioteca digital
     -->

      <nav id="navSecciones">
            <a href="./bd1.html" class="enlace1">Inicio</a>
            <a href="./recursosseccion1.html" class="enlace1">Acci&oacute;n</a>
            <a href="./recursosseccion1.html" class="enlace1">Aventuras</a>
            <a href="./recursosseccion1.html" class="enlace1">Ciencia Ficci&oacute;n</a>
            <a href="./recursosseccion1.html" class="enlace1">Comedia</a>
            <a href="./recursosseccion1.html" class="enlace1">Drama</a>
            <a href="./recursosseccion1.html" class="enlace1">Musicales</a>
            <a href="./recursosseccion1.html" class="enlace1">B&eacute;licas</a>
            <a href="./recursosseccion1.html" class="enlace1">Suspense</a>
            <a href="./recursosseccion1.html" class="enlace1">Cl&aacute;sicos</a>
      </nav>
      <!--
        Sectión para establecer el contenido principal de la página web.
      -->
      <section>
        <!-- Formulario para dar de alta a un recurso -->
        <form id="formularioCentrado" action="ficheroPHPparaP2.php" method="post">

          <fieldset>
            <legend>Datos Recurso</legend>
            <!--
                Aplilamiento para establecer el seleccionado del recurso junto con la
                introducción de datos de caracter específico
            -->
            <article class="apilamiento2Secciones">
              <input type="file" name="seleccionRecurso" id="seleccionRecurso">
            </article>

            <article class="apilamiento2Secciones">
              <label for="Titulo">Titulo: *</label>
              <input type="text" id="titulo" name="titulo" required /><br><br>

              <label for="autor">Autor: *</label>
              <input type="text" id="autor" name="autor" required /><br><br>

              <datalist id="seleccionSeccion">
                <option value="Ciencia Ficci&oacute;n">
                <option value="Aventuras">
                <option value="Comedia">
                <option value="Drama">
                <option value="Acci&oacute;n">
                <option value="Musicales">
                <option value="B&eacute;licas">
                <option value="Suspense">
                <option value="Cl&aacute;sicos">
              </datalist>
              <label for="seccion">Seccion: *</label>
              <input type="text" name="seccion" id="seccion" list="seleccionSeccion"><br><br>

              <datalist id="seleccionTipo">
                <option value="Texto">
                <option value="Audio">
                <option value="Imagen">
                <option value="V&iacute;deo">
              </datalist>
              <label for="tipo">Tipo: *</label>
              <input type="text" name="tipo" id="tipo" list="seleccionTipo"><br><br>

              <label for="fechaDeAlta">Fecha de Alta *</label>
              <input type="date" id="fechaDeAlta" name="fechaDeAlta" required /><br><br>

              <label for="fechaFinalizacionAlta">Fecha de finalizaci&oacute;n *</label>
              <input type="date" id="fechaFinalizacionAlta" name="fechaFinalizacionAlta" required /><br><br>
            </article>

            <!-- Sección dedicada a la toma de datos de caracter más genérica -->
            <article>
              <label for="Descripcion">Descripci&oacute;n *</label> <br>
              <textarea name="Descripcion" id="Descripcion" rows="8" cols="80" required>Introduzca una descripci&oacute;n del recurso.</textarea>
            </article>

          </fieldset>
          <input type="submit" name="Enviar" class="boton">
          <input type="reset" name="Reset" class="boton">
        </form>
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
