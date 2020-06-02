<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Bartolomé Zambrana Pérez">
  <title>Biblioteca digital Netflix</title>
  <link rel="stylesheet" type="text/css" href="estilos.css">
  <script>
    function mostrarRecursos(enunciado){
      alert(enunciado);
    }
  </script>

  <?php 
    if(isset($_GET['correcto'])){
      if($_GET['correcto'] == 1){
        echo  '<script> window.onload=function mensaje(){alert("Biblioteca Digital Creada");} </script>';
      }else if($_GET['correcto'] == 2){
        echo  '<script> window.onload=function mensaje(){alert("Biblioteca Digital Borrada");} </script>';
      }else if($_GET['correcto'] == 3){
        echo  '<script> window.onload=function mensaje(){alert("Biblioteca Digital Editada");} </script>';
      }else{
        echo '<script> window.onload=function mensaje(){alert("Se produjo un error vuelva a intentarlo");} </script>';
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
      <a href="./crearbd.php" id="enlaceCrearBibliotecaDigital">Crear Biblioteca Digital</a>
    </section>

    <!-- Zona de lista de bibliotecas -->
    <section class="apilamiento2Secciones">
      <section id="scrollbar">
      <h2>Bibliotecas dadas de alta</h2>
      <?php 
          //obtenemos las bibliotecas digitales de la base de datos. 
          require_once("configuracion.php");
          require_once("conexion.php");

          try{
            $sql = "SELECT * FROM ". BIBLIOTECAS_DIGITALES;
            $resultadoConsulta = $conexion->query($sql);
          }catch(PDOExcepcion $e){
            echo $e;
            $conexion = null;
            die();
          }
          
          foreach($resultadoConsulta as $fila){
            
            //Obtenemos los recursos asociados a dicha bilioteca digital
            try{
              $sql = "SELECT recursos.nombre FROM bd1, secciones, recursos WHERE secciones.nombrebd = bd1.nombre AND secciones.nombre = recursos.seccion AND bd1.nombre = :nombre";
              $sentencia = $conexion->prepare($sql);
              $sentencia->bindValue(":nombre",$fila['nombre']);
              $sentencia->execute();
            }catch(PDOException $e){
              echo $e;
              $conexion = null;
              die();
            }         

            $resultado = $sentencia->fetchAll();
            $enunciado = "'En ".$fila['nombre']." hay los siguientes recursos; " ;

            foreach($resultado as $fila2){
              $enunciado = $enunciado . $fila2['nombre'] . " || ";
            }

            $enunciado = $enunciado ."'";
            
            echo '<section class="Cuadro50BordeMargenIzquierdo" >
                    <article class="apilamiento2Secciones">
                      <img src="'. $fila["urlImagen"] .'" alt="'. $fila["nombre"] .'" class="imagen100porcientoBordeSinSombra" onmouseover="mostrarRecursos('.$enunciado.');" >
                    </article>
  
                    <article class="apilamiento2Secciones">
                        <a href="./bd1.php?bd='.$fila["nombre"].'" class="enlace6">'. $fila["nombre"] .'</a><br>';
            if(isset($_SESSION['usuario'])){
              echo '    <a href="./borrarbd.php?bibliotecaBorrar='.$fila["nombre"].'" class="enlaceBorrar">Borrar</a>
                        <a href="./editarbd.php?bibliotecaEditar='.$fila["nombre"].'" class="enlaceEditar">Editar</a>
                      </article>
                    </section>';
            }else{
              echo '  </article>
                    </section>';
            }
          }

          $conexion = null;
        ?>
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
