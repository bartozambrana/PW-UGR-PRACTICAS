<!DOCTYPE html>
<html lang="es" >
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Bartolomé Zambrana Pérez">
    <link rel="stylesheet" type="text/css" href="./estilos.css">
    <script type="text/javascript" src="./validacion.js"></script>
    <title>Recurso1</title>
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
                echo quitarAcentos($_GET["bd"]);
            ?></h1>
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
        Navegador por si se quiere volver de nuevo a la biblioteca digital, como a las distintas secciones
        de la biblioteca
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
              }catch(PDOException $e){
                echo $e;
                $conexion = null;
              }
              
              $resultado = $sentencia->fetchAll();
              foreach($resultado as $fila){
                echo '<a href="./recursosseccion1.php?bd='. $_GET["bd"]. '&seccion='. $fila['nombre'] . '" class="enlace1">' . $fila['nombre'] . '</a>';

              }
            ?>
      </nav>

      <!-- Seccion con contiene el cotenido principal de la página, así como para establecer un diseño visual -->
      <section id="recurso" >
        <?php 
          
          //Realización de la consulta del recurso.

          try{
            $sql = "SELECT recursos.* FROM recursos, secciones WHERE secciones.nombrebd = :bd AND secciones.nombre = :nombreseccion" ;
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(":bd",quitarAcentos($_GET["bd"]) );
            $sentencia->bindValue(":nombreseccion",quitarAcentos($_GET["seccion"]) );
            $sentencia->execute();
          }catch(PDOException $e){
            echo $e;
            $conexion = null;
            die();
          }

          $resultado = $sentencia->fetchAll();
          $siguiente = 0;
          $anterior = count($resultado)-1;

          foreach($resultado as $fila){

            if($anterior == -1){
              $anterior = count($resultado)-1;
            }

            $siguiente = ($siguiente + 1) % (count($resultado));
            if($fila['nombre'] == quitarAcentos($_GET['recurso'])){
              echo '<article class="apilamiento2Secciones">
                  <img src="'. $fila['urlImagen'] .'"  id="imagenRecurso">
                </article>
                <!-- Características de la película -->
                <article class="apilamiento2Secciones">
                  <p class="relevante"> 
                    Titulo:' . $fila['nombre'] . ' <br>
                    Fecha de Finalizaci&oacute;n de alta: ' . $fila['fechabaja'] . '.<br>
                    Fecha de alta: ' . $fila['fechaalta'] . '.<br>
                    Tipo: Imagen.<br>
                  </p>
                </article>
                <!-- Descripción de la película -->
                <article class="relevante">
                  Descripci&oacute;n:<br>
                  <p id="cuadro">
                  ' . $fila['resumen'] . '
                  </p>
                </article>
                <article>
                  <a href="recurso.php?bd='. $_GET['bd'] .'&seccion='. $_GET["seccion"] .'&recurso='. $resultado[$anterior]['nombre'] .'" class="enlace1">Anterior</a>
                  <a href="recurso.php?bd='. $_GET['bd'] .'&seccion='. $_GET["seccion"] .'&recurso='. $resultado[$siguiente]['nombre'] .'" class="enlace1" id="separacion">Siguiente</a>
                </article>';
                
            }
            
            $anterior--;
            
          }
          
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
