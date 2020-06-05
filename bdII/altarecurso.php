<!DOCTYPE html>
<html lang="es" >
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Bartolomé Zambrana Pérez">
    <link rel="stylesheet" type="text/css" href="./estilos.css">
    <title>Alta de Recurso</title>
    <script type="text/javascript" src="./validacion.js"></script>
    <?php
      //Comprobaciones en la creación de un recruso
      if(isset($_GET['utilizado'])){
        if($_GET['utilizado'] == 1){
          echo '<script> window.onload=function mensaje(){ alert("El recurso introducido ya existe en la plataforma"); }</script>';
        }else if($_GET['utilizado'] == 2){
          echo '<script> window.onload=function mensaje(){ alert("La sección introducida no existe"); }</script>';
        }
      }
      //Comprobaciones del campo imagen
      if(isset($_GET['error'])){
        switch($_GET['error']){
          case 1:
            echo '<script> alert("Error más de un elemento seleccionado, o no definido en la selección de imagen"); </script>';
          break;
  
          case 2:
            echo '<script> alert("Documento no seleccionado en la selección de imagen"); </script>';
          break;
          case 3:
            echo '<script> alert("Error supera el tamaño límite en la selección de imagen"); </script>';
          break;
  
          case 4:
            echo '<script> alert("Algún error ocurrió en la selección de imagen"); </script>';
          break;
  
          default:
            echo '<script> alert("Error no es una imagen"); </script>';
          
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
            if(isset($_GET['bd'])){
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
          Navegador por si se quiere volver al incio de la biblioteca como si se quiere navegar a las distintas seccciones
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
            $sentencia->bindValue(":nombrebd",$_GET["bd"]);
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
        <!-- Formulario para dar de alta a un recurso -->
        <form id="formularioCentrado" action="procesarAltaRecurso.php" method="post" name="formularioAltaRecurso" onsubmit="return validarAltaRecurso();" enctype="multipart/form-data">

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
              <label for="nombre">Nombre: *</label>
              <input type="text" id="nombre" name="nombre" /><br><br>

              <datalist id="seleccionSeccion">
                <?php 
                  foreach($resultado as $fila){
                    echo '<option value="'. $fila['nombre'] .'">';
                  }
                ?>
              </datalist>
              <label for="seccion">Seccion: *</label>
              <input type="text" name="seccion" id="seccion" list="seleccionSeccion"><br><br>


              <label for="fechaDeAlta">Fecha de Alta *</label>
              <input type="date" id="fechaDeAlta" name="fechaDeAlta"  /><br><br>

              <label for="fechaFinalizacionAlta">Fecha de finalizaci&oacute;n *</label>
              <input type="date" id="fechaFinalizacionAlta" name="fechaFinalizacionAlta"  /><br><br>

              

              
            </article>

            <!-- Sección dedicada a la toma de datos de caracter más genérica -->
            <article>
              <label for="Descripcion">Descripci&oacute;n *</label> <br>
              <textarea name="descripcion" id="descripcion" rows="8" cols="80" required>Introduzca una descripci&oacute;n del recurso.</textarea>

              <label for="resumen">Resumen *</label> <br>
              <textarea name="resumen" id="resumen" rows="8" cols="80" required>Introduzca un breve resumen del recurso.</textarea>
            </article>
            
            <input type="hidden" name="bd" value="<?php echo $_GET['bd']; ?>">
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
