<!DOCTYPE html>
<html lang="es" >
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Bartolomé Zambrana Pérez">
    <link rel="stylesheet" type="text/css" href="./estilos.css">
    <title>Baja de Secci&oactue;nes</title>
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
            require_once("tratamientoCadenas.php");
            if(isset($_GET['bd']))
              echo quitarAcentos($_GET['bd']); //convertimos una vocal con acento o ñ por &<vocal>acute; o &ntilde;
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
          Navegador por si se quiere volver a la biblioteca digital como si se quiere navegar a las distintas seccciones
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
              $sentencia->bindValue(":nombrebd",quitarAcentos($_GET["bd"]) );
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
      <section>
        <?php 
          //Obtengamos todas las secciones perteneciente a esta biblioteca digital.
          try{
            $sql = "SELECT nombre FROM " . SECCIONES . " WHERE nombrebd = :bd";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(":bd", quitarAcentos($_GET['bd']));
            $sentencia->execute();
            //obtenemos todos los resultados.
            $resultado = $sentencia->fetchAll();
          }catch(PDOException $e){
            echo $e;
            $conexion = null;
            die();
          }

          $conexion = null;

          echo '<!-- Formulario para dar de baja una sección -->
          <form id="formularioCentrado" action="procesarBorrarSecciones.php" method="post">
            <fieldset>
              <legend>Selecci&oacute;n de la secci&oacute;n a dar de baja.</legend>
              <datalist id="seleccionSeccion">';
              foreach($resultado as $fila){
                echo '<option value="'. $fila['nombre'] .'">';
              }
            
          echo '<input type="hidden" name="bd" value="'. $_GET['bd'] .'"></datalist>
              <label for="seccion">Seccion: *</label>
              <input type="text" name="seccion" id="seccion" list="seleccionSeccion" ><br><br>';

          echo '</fieldset>
            <input type="submit" name="Enviar" class="boton">
            <input type="reset" name="Reset" class="boton">
          </form>';
        ?>
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
