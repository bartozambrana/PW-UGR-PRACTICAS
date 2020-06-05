<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Bartolomé">
    <title>Biblioteca Digital 
          <?php 
            echo $_GET['bd'];
          ?></title>
    <link rel="stylesheet" type="text/css"  href="estilos.css">
    <script type="text/javascript" src="./validacion.js"></script>
    <?php 
    if(isset($_GET['correcto'])){
      if($_GET['correcto'] == 1){
        echo  '<script> window.onload=function mensaje(){alert("Recurso Digital Creado");} </script>';
      }else if($_GET['correcto'] == 2){
        echo  '<script> window.onload=function mensaje(){alert("Recurso Digital Borrado");} </script>';
      }else if($_GET['correcto'] == 3){
        echo  '<script> window.onload=function mensaje(){alert("Recurso Digital Editado");} </script>';
      }else if($_GET['correcto'] == 4){
        echo  '<script> window.onload=function mensaje(){alert("Sección Creada");} </script>';
      }else if($_GET['correcto'] == 5){
        echo  '<script> window.onload=function mensaje(){alert("Sección Borrada");} </script>';
      }else{
        echo '<script> window.onload=function mensaje(){alert("Sección Editada");} </script>';
      }
    }
  ?>

  </head>
  <body>
    <?php 
      //Reanudamos la sesión
      session_start();
    ?>
    <header>
      <section class="encabezado">
        <img src="./imagenes/logo.jpg" id="logoCabecera" alt="Logo del gestor">
      </section>

      <!--Nombre de la Biblioteca Digital-->
      <section class="encabezado">
        <h1 id="tituloCabecera">
          <?php 
            echo $_GET['bd'];
          ?>
        </h1>
      </section>


      <section class="encabezado">
      <?php 
        require_once("loginMensajeValidacion.php");
        formularioLogin();
      ?>
      </section>
    </header>
    <main>
      <!--
          Navegador por si se quiere volver al inicio como si se quiere navegar a las distintas seccciones
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

                
                
              }catch(PDOException $e){
                echo $e;
                $conexion = null;
                die();
              }
              
              $resultado = $sentencia->fetchAll();
              foreach($resultado as $fila){
                  echo '<a href="./recursosseccion1.php?bd='. $_GET["bd"]. '&seccion='. $fila['nombre'] . '&empieza=0' .'" class="enlace1">' . $fila['nombre'] . '</a>';

              }
              
              $nSecciones = count($resultado);

            ?>

      </nav>

      <!--
        Sección primaria para dar una descripción de la biblioteca digital, así como para mostrar
        el contenido destacado. Se le realiza una apilamiento para que se pueda mostrar junto con la sección
        secundaria en una misma franja.
      -->
      <section class="apilamiento2Secciones" id="seccionPrincipal">
        <!-- Descripción de la biblioteca digital -->
        <article class="Cuadro50BordeMargenIzquierdo">
          <p class="relevante">

            <?php 
              //Código de extracción de la descripción de la biblioteca digital de la base de datos.
              try{
                $sql = "SELECT descripcion FROM ".BIBLIOTECAS_DIGITALES ." WHERE nombre = :nombre";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindValue(":nombre",$_GET["bd"]);
                $sentencia->execute();

                $resultado = $sentencia->fetch();
                echo $resultado['descripcion'];
                
              }catch(PDOException $e){
                echo $e;
                $conexion = null;
                die();
              }
              
            ?>
          </p>
        </article>

        <h2 id="tituloMenuSecciones">Recursos Destacados</h2>
        <section id="scrollbar">
          <!--
            Sección para acoger en su interior los contenido destacados, aplicándole el diseño
            de un cuadro
          -->

          <?php 
            //Código de extracción de los ultimos 3 recursos de la biblioteca digital de la base de datos
            try{
              //Escogemos los recursos pertenecientes a la bilioteca digital que nos encontramos y contamos los recursos, puesto que nos serviran posteriormente
              $sql = "SELECT recursos.urlImagen, recursos.nombre, recursos.seccion FROM recursos, secciones WHERE secciones.nombrebd = :bd AND recursos.seccion = secciones.nombre";
              $sentencia = $conexion->prepare($sql);
              $sentencia->bindValue(":bd",$_GET["bd"] );
              $sentencia->execute();

              $resultado = $sentencia->fetchAll();
              $contador = 0;
              //Mostramos los últimos 3 recursos de la consulta obtenida, como recursos destacados
              for($i = count($resultado) -1; $i >= 0 && $contador < 3; $i--){
                echo ' <section class="Cuadro50BordeMargenIzquierdo">
                          <article class="apilamiento2Secciones">
                            <img src="' . $resultado[$i]['urlImagen'] . '" class="imagen100porcientoBordeSinSombra">
                          </article>
                          <!-- Segunda zona que contiene los enlaces así como una breve descripción -->
                          <article class="apilamiento2Secciones">
                            <a href="./recurso.php?bd='. $_GET["bd"] .'&seccion='. $resultado[$i]['seccion'] .'&recurso='. $resultado[$i]['nombre'] .'" class="enlace3">'. $resultado[$i]['nombre'] .'</a>
                          </article>
                        </section>';
                        $contador++;
              }
              
              $conexion = null;
            }catch(PDOException $e){
              echo $e;
              $conexion = null;
              die();
            }
          ?>

        </section>


      </section>

      <!-- Zona secundaria apilada con la segunda para que se encuentren en la misma franja -->
      <section class="apilamiento2Secciones" id="seccionSecundaria">
        <?php 
          echo '<article class="Cuadro50BordeMargenIzquierdo">
                  <h2>Informaci&oacute;n general de la colecci&oacute;n.</h2>' . 
                  '<p class="relevante" id="informacionGeneralColeccion">' . 
                    'N&uacute;mero de recursos: ' . count($resultado) . '<br><br>' ;
                    if(count($resultado) == 0){
                      echo '&Uacute;ltima publicaci&oacute;n: No se encuentra publicado nada a&uacute;n. <br><br>';
                    }else{
                      echo '&Uacute;ltima publicaci&oacute;n: '. $resultado[count($resultado) -1]['nombre'].' <br><br>';
                    }
                    echo 'Fuentes de datos: Plataforma Netflix. <br><br>' . 
                  '</p>' .
                '</article>';
          //Si el usuario está logueado
          if(isset($_SESSION['usuario'])){
            //Si no hay secciones, se muestra solo la alta de secciones
            if($nSecciones == 0){
              echo '<aside>' . 
                    '<a href="altaseccion.php?bd='. $_GET['bd'] .'" class="enlace1">Alta</a>
                    (Secciones)
                  </aside>';
            }else{
              //Si hay secciones definidas pero no recursos, solo se muestra la alta de recursos, en caso contrario se muestra todo.
              echo '<aside>';
              if(count($resultado) == 0){
                echo '<a href="altarecurso.php?bd='. $_GET['bd'] .'" class="enlace1">Alta</a>
                      (Recursos)
                      <br><br><br>
                      <a href="altaseccion.php?bd='. $_GET['bd'] .'" class="enlace1">Alta</a>
                      <a href="borrarseccion.php?bd='. $_GET['bd'] .'" class="enlace1">Baja</a>
                      <a href="editarseccion.php?bd='. $_GET['bd'] .'" class="enlace1">Editar</a>
                      (Secciones)
                    </aside>';
              }else{
                echo '<a href="altarecurso.php?bd='. $_GET['bd'] .'" class="enlace1">Alta</a>
                      <a href="borrarrecursos.php?bd='. $_GET['bd'] .'" class="enlace1">Baja</a>
                      <a href="editarrecurso.php?bd='. $_GET['bd'] .'" class="enlace1">Editar</a>
                      (Recursos)
                      <br><br><br>
                      <a href="altaseccion.php?bd='. $_GET['bd'] .'" class="enlace1">Alta</a>
                      <a href="borrarseccion.php?bd='. $_GET['bd'] .'" class="enlace1">Baja</a>
                      <a href="editarseccion.php?bd='. $_GET['bd'] .'" class="enlace1">Editar</a>
                      (Secciones)
                  </aside>';
              }
                    
            }
          } 
                
                
        ?>
      </section>


    </main>

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
