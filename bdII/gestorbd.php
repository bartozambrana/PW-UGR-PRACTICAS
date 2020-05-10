<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Bartolomé Zambrana Pérez">
  <title>Biblioteca digital Netflix</title>
  <link rel="stylesheet" type="text/css" href="estilos.css">
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

    <!--Enlaces auxiliares-->
    <section class="encabezado">
    <?php 
        require_once("loginMensajeValidacion.php");
        formularioLogin();
      ?>
    </section>
  </header>
  <!-- Cuerpo de la página -->
  <main>

    <!-- Zona de la imagen representantiva del gestor -->
    <section class="apilamiento2Secciones">
      <a href="./crearbd.html" id="enlaceCrearBibliotecaDigital">Crear Biblioteca Digital</a>
    </section>

    <!-- Zona de lista de bibliotecas -->
    <section class="apilamiento2Secciones">
      <section id="scrollbar">
        <h2>Bibliotecas dadas de alta</h2>
        <section class="Cuadro50BordeMargenIzquierdo">
          <article class="apilamiento2Secciones">
            <img src="./imagenes/peliculas.jpg" alt="Peliculas" class="imagen100porcientoBordeSinSombra">
          </article>

          <article class="apilamiento2Secciones">
              <a href="./bd1.html" class="enlace6">Pel&iacute;culas</a><br>
              <a href="borrarbd.html" class="enlaceBorrar">Borrar</a>
              <a href="editarbd.html" class="enlaceEditar">Editar</a>
          </article>
        </section>

        <section class="Cuadro50BordeMargenIzquierdo">
          <article class="apilamiento2Secciones">
            <img src="./imagenes/series.jpg" alt="Series" class="imagen100porcientoBordeSinSombra">
          </article>

          <article class="apilamiento2Secciones">
              <a href="./bd1.html" class="enlace6">Series</a><br>
              <a href="borrarbd.html" class="enlaceBorrar">Borrar</a>
              <a href="editarbd.html" class="enlaceEditar">Editar</a>
          </article>
        </section>

        <section class="Cuadro50BordeMargenIzquierdo">
          <article class="apilamiento2Secciones">
            <img src="./imagenes/documentales.jpg" alt="Documentales" class="imagen100porcientoBordeSinSombra">
          </article>

          <article class="apilamiento2Secciones">
              <a href="bd1.html" class="enlace6">Documentales</a><br>
              <a href="borrarbd.html" class="enlaceBorrar">Borrar</a>
              <a href="editarbd.html" class="enlaceEditar">Editar</a>
          </article>
        </section>
      </section>
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