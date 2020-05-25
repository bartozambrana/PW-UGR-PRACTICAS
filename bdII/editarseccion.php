<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Bartolomé Zambrana Pérez">
  <link rel="stylesheet" type="text/css" href="./estilos.css">
  <title>Edici&oacute;n de Secci&oacute;n</title>
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

    <!--Nombre de la biblioteca digital -->
    <section class="encabezado">
      <h1 id="tituloCabecera"><?php 
            echo $_GET['bd'];
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
        require_once("tratamientoCadenas.php");
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
    <section id="seccionCentrada">
      <?php 
        require_once("formularioEditarSeccion.php");    
      ?>
    </section>
  </main>

  <!-- Pie de página -->
  <footer>
    <h1 id="tituloPiePagina">Contacto-C&oacute;mo se hizo. </h1>
    <p id="fondoClaroParrafoPiePagina">En el siguiente enlace puede encontrar información del desarrollador del sitio web <a href="contacto.html" class="enlace2">Contacto</a>
      as&iacute; como se tomaron las decisiones en el proceso de desarrollo <a href="como_se_hizo.pdf" class="enlace2">C&oacute;mo se Hizo</a>
    </p>
  </footer>
</body>

</html>
