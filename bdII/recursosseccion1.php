<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Bartolomé Zambrana Pérez">
    <link rel="stylesheet" type="text/css" href="./estilos.css">
    <script type="text/javascript" src="./validacion.js"></script>
    <title>Recursos</title>
</head>

<body>
    <?php 
      //Reanudamos la sesión
      session_start();
    ?>
    <!-- Cabecera -->
    <header>
        <!--logo-->
        <section class="encabezado">
            <img src="./imagenes/logo.jpg" id="logoCabecera" alt="Logo del gestor">
        </section>

        <!--Nombre de la biblioteca digital -->
        <section class="encabezado">
            <h1 id="tituloCabecera">
            <?php 
                echo $_GET["bd"];
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

        <h2 id="tituloMenuSecciones"><?php echo $_GET['seccion']; ?></h2>

        <!-- sección general de mostrado de elementos -->
       
            <?php 

                try{
                  //Escogemos los recursos pertenecientes a la bilioteca digital que nos encontramos y contamos los recursos, puesto que nos serviran posteriormente
                  $sql = "SELECT recursos.nombre, recursos.descripcion FROM recursos, secciones WHERE secciones.nombrebd = :bd AND recursos.seccion = :nombreseccion AND recursos.seccion = secciones.nombre";
                  $sentencia = $conexion->prepare($sql);
                  $sentencia->bindValue(":bd",$_GET["bd"] );
                  $sentencia->bindValue(":nombreseccion",$_GET["seccion"] );
                  $sentencia->execute();
    
                  
                  $conexion = null;
                }catch(PDOException $e){
                  echo $e;
                  $conexion = null;
                  die();
                }
                $resultado = $sentencia->fetchAll();
                $contador = 0;
                $t = 0;
                echo '<section class="tablegen"> ';
                //Elaboración de la zona central de mostrado.
                for( $i = intval($_GET['empieza']) ; $i < count($resultado) && $t < 9 ; $i++ ){
                  if($contador == 0){
                    echo '<section class="fila">';
                  }
              
                    echo ' 
                    <article class="columna">
                        <a href="./recurso.php?recurso='. $resultado[$i]['nombre'] . '&seccion='. $_GET['seccion']. '&bd=' . $_GET["bd"]  .'" class="enlace5">' . $resultado[$i]['nombre'] . '</a>
                        <p class="relevante"> '
                          . $resultado[$i]['descripcion'] .
                        '</p>
                    </article>';
                  $contador++;
                  $t++;
                  if($contador == 3){
                      echo '</section>';
                      $contador = 0;
                  }
                }
                //Caso de que por ejemplo haya o dos recursos como final, han de cerrarse el section al final de recorrer todos los recursos disponibles                                   
                if($contador < 3 && $contador > 0){
                    echo '</section>';
                }

                echo '</section>';
                
                //Implementación del paso de página.
                if(count($resultado) > 9){
                  echo ' <nav id="navSecciones"> '; 
                  $k = 1;
                  for($j = 0; $j < count($resultado); $j+=9){
                    echo '<a href="./recursosseccion1.php?bd='. $_GET["bd"]. '&seccion='. $_GET['seccion'] . '&empieza=' . $j .'" class="enlace4">' . $k . ' </a>';
                    $k++;
                  } 
                  
                  echo '</nav>';
                }

                  
            ?>

       

    </main>
    <!-- Pie de página -->
    <footer>
        <h1 id="tituloPiePagina">Contacto-C&oacute;mo se hizo. </h1>
        <p id="fondoClaroParrafoPiePagina">En el siguiente enlace puede encontrar informaci&oacute;n del desarrollador del sitio web <a href="contacto.html" class="enlace2">Contacto</a> as&iacute; como se tomaron las decisiones en el proceso de desarrollo <a href="como_se_hizo.pdf" class="enlace2">C&oacute;mo se Hizo</a>
        </p>
    </footer>
</body>

</html>