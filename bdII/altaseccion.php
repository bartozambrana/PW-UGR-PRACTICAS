<!DOCTYPE html>
<html lang="es" >
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Bartolomé Zambrana Pérez">
    <link rel="stylesheet" type="text/css" href="./estilos.css">
    <title>Alta de Secci&oactue;n</title>
    <script type="text/javascript" src="./validacion.js"></script>
    <?php 
    if(isset($_GET['utilizado'])){
      if($_GET['utilizado'] == 1){
        echo '<script> window.onload=function mensaje(){ alert("La sección introducida ya existe en esta biblioteca digital"); }</script>';
      }
    }
  ?>
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
        <h1 id="tituloCabecera">
          <?php 
            if( isset($_GET['bd'])){
              echo $_GET['bd'];
            }
          ?>
        </h1>
      </section>

      <!--Indicación de donde nos encontramos-->
      <section class="encabezado">
        <?php 
          require_once("loginMensajeValidacion.php");
          formularioLogin();
        ?>
      </section>
    </header>

    <!-- Cuerpo de la página -->
    <main>
      <!--
          Navegador por si se quiere volver al incio como si se quiere navegar a las distintas seccciones
          de dicha biblioteca digital
     -->
      <nav id="navSecciones">
        <?php
          if(isset($_SESSION['usuario'])){
            echo '<a href="./gestorbd.php" class="enlace1">Inicio</a>';
          }else{
            echo '<a href="./index.php" class="enlace1">Inicio</a>';
          }
          require_once("configuracion.php");
          require_once("conexion.php");
          try{
            $sql = "SELECT nombre FROM ". SECCIONES ." WHERE nombrebd = :nombrebd";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(":nombrebd",$_GET["bd"] );
            $sentencia->execute();

            $resultado = $sentencia->fetchAll();
            foreach($resultado as $fila){
              echo '<a href="./recursosseccion1.php?bd='. $_GET["bd"]. '&seccion='. $fila['nombre'] . '&empieza=0' .'" class="enlace1">' . $fila['nombre'] . '</a>';

            }
            
          }catch(PDOException $e){
            echo $e;
            $conexion = null;
          }
            
        ?>
      </nav>

      <!--
        Sectión para establecer el contenido principal de la página web.
      -->
      <section >
        <!-- Formulario para dar de alta seccción -->
        <form id="formularioCentrado" action="procesarAltaSeccion.php" method="post" name="formularioAltaSeccion" onsubmit="return validarAltaSeccion();">

          <fieldset>
            <legend>Datos de la Secci&oacute;n</legend>

            <label for="Titulo">Titulo: *</label>
            <input type="text" id="titulo" name="titulo"  /><br><br>

            <label for="fechaDeAlta">Fecha de Alta *</label>
            <input type="date" id="fechaDeAlta" name="fechaDeAlta"  /><br><br>

            <label for="fechaFinalizacionAlta">Fecha de finalizaci&oacute;n *</label>
            <input type="date" id="fechaFinalizacionAlta" name="fechaFinalizacionAlta"  /><br><br>

            <label for="Descripcion">Descripci&oacute;n *</label> <br>
            <textarea name="Descripcion" id="Descripcion" rows="8" cols="80" >Introduzca una descripci&oacute;n de la secci&oacute;n.</textarea>

            <input type="hidden" name="bd" value="<?php if(isset($_GET['bd'])) echo $_GET['bd']; ?>" >

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
