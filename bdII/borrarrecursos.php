<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Bartolomé Zambrana Pérez">
  <title>Borrado de Recurso</title>
  <link rel="stylesheet" type="text/css" href="estilos.css">
  <?php 
    if(isset($_GET['utilizado'])){
      if($_GET['utilizado'] == 1){
        echo '<script> window.onload=function mensaje(){ alert("El recurso no existe, seleccione uno de la lista desplegable "); }</script>';
      }
    }
  ?>
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
      <h1 id="tituloCabecera"> 
        <?php
          echo $_GET['bd'];
        ?> </h1>
    </section>

    <!--Indicación de donde nos encontramos-->
    <section class="encabezado">
      <?php 
        require_once("loginMensajeValidacion.php");
        formularioLogin();
      ?>
    </section>
  </header>

  <!-- Cuerpo -->
  <main>


    <!--
         Navegador por si se quiere ir de nuevo a la página principal de la biblioteca
         digital, así como a las distintas secciones
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

    <!-- Sección que contiene el contenido principal de la página web -->
    <section >
    <?php 
          //Obtengamos todas las recursos perteneciente a esta biblioteca digital.
          try{
            $sql = "SELECT recursos.nombre FROM " . SECCIONES . ",". RECURSOS ." WHERE secciones.nombrebd = :bd AND recursos.seccion = secciones.nombre";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(":bd", $_GET['bd']);
            $sentencia->execute();
            //obtenemos todos los resultados.
            $resultado = $sentencia->fetchAll();
          }catch(PDOException $e){
            echo $e;
            $conexion = null;
            die();
          }

          $conexion = null;

          echo '<!-- Formulario para dar de baja un recurso -->
          <form id="formularioCentrado" action="procesarBorrarRecurso.php" method="post">
            <fieldset>
              <legend>Selecci&oacute;n del recurso a dar de baja.</legend>
              <datalist id="seleccionRecurso">';
              foreach($resultado as $fila){
                echo '<option value="'. $fila['nombre'] .'">';
              }
            
          echo '</datalist> 
              <label for="seccion">Recurso: *</label>
              <input type="text" name="recurso" id="seccion" list="seleccionRecurso" ><br><br>
              <input type="hidden" name="bd" value="'. $_GET['bd'] .'"';

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
