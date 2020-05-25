<?php 
    
    //Obtenemos los ficheros necesarios para realizar la conexión a la bd, ya que en un caso
    // u otra va a ser utilizado.
    require_once("conexion.php");
    require_once("configuracion.php");
    require_once("tratamientoCadenas.php");


    if(!isset($_GET['recursoseleccionado'])){
        //Buscamos todos los recursos asocidados a dicha biblioteca digital
        try{
            $sql = "SELECT recursos.nombre FROM ".RECURSOS .", ". SECCIONES ." WHERE secciones.nombrebd = :bd AND recursos.seccion = secciones.nombre";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(":bd",quitarAcentos($_GET['bd']) );
            $sentencia->execute();
        }catch(PDOException $e){
            echo $e;
            die();
            $conexion = null;
        }
        $resultado = $sentencia->fetchAll();
        $conexion = null;

        echo '
        <form id="formulario" action="procesarSeleccionRecursos.php" method="post">
            <fieldset>
            <legend>Formulario de selecci&oacute;n de recurso.</legend>
            <datalist id="seleccionRecurso">
            ';
            foreach($resultado as $fila){
                echo '<option value="'. $fila['nombre'] .'">';
            }
        echo '</datalist>
            <label for="recurso">Recurso *</label>
            <input type="text" name="recurso" id="recurso" list="seleccionRecurso" required>
            
            <input type="hidden" name="bd" id="bd" value="'. $_GET['bd'] .'">
            </fieldset>
            <input type="submit" name="Enviar" class="boton" value="Siguiente Paso" >
            <input type="reset" name="Reset" class="boton">
        </form>
        ';


    }else{
        echo '
        <article>
            <h2 id="tituloGeneral">Datos Recurso a Editar</h2>
            ';
            try{
                $sql = "SELECT nombre, date_format(fechaalta,'%d/%m/%Y') fechaalta, date_format(fechabaja, '%d/%m/%Y') fechabaja, seccion, descripcion, resumen, urlImagen FROM ".RECURSOS ." WHERE nombre = :nombre";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindValue(":nombre",quitarAcentos($_GET['recursoseleccionado']) );
                $sentencia->execute();
            }catch(PDOException $e){
                echo $e;
                die();
                $conexion = null;
            }
            
    
            $resultado = $sentencia->fetch();
            echo'<ul class="relevante">
                    <li>Nombre de la biblioteca digital: '. $resultado["nombre"] . '</li>
                    <li>Nombre de la secci&oacute;n a la que pertenece: '. $resultado["seccion"] . '</li>
                    <li>Fecha de alta de la biblioteca digital: '. $resultado["fechaalta"] .'</li>
                    <li>Fecha de baja de la biblioteca digital: '. $resultado["fechabaja"] .'</li>
                    <li>Descripcion: ' .$resultado["descripcion"] . '</li>
                    <li>Breve resumen: ' .$resultado["resumen"] . '</li>
                
                </ul>';
                
            $seccion = $resultado['seccion'];
            $descripcion = $resultado['descripcion'];
            $resumen = $resultado['resumen'];
            $imagen = $resultado["urlImagen"];
            echo '
        </article>
        
        <form id="formulario" action="procesarEdicionRecurso.php" method="post" name="formularioEdicionRecursos" onsubmit="return validarEdicionRecurso();">

        <fieldset>
            <legend>Formulario de edici&oacute;n del recurso.</legend>
            <!--
                Aplilamiento para establecer el mostrado del recurso una vez seleccionado su título
                (supongo que se realizará mediante php) junto con la introducción de datos de caracter específico
            -->
            <article class="apilamiento2Secciones">
                <img src="'. $imagen .'" class="imagen100porcientoBordeSinSombra">
            </article>

            <article class="apilamiento2Secciones">
                
                <label for="titulo">T&iacute;tulo: *</label>
                <input type="text" name="titulo" id="titulo" list="seleccionRecurso" required><br><br>

                <datalist id="seleccionSeccion">';

            //Obtenemos todas las secciones disponibles en la biblioteca actual en la que nos encontramos.
                try{
                    $sql = "SELECT nombre FROM ".SECCIONES ." WHERE nombrebd = :bd";
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindValue(":bd",quitarAcentos($_GET['bd']) );
                    $sentencia->execute();
                }catch(PDOException $e){
                    echo $e;
                    die();
                    $conexion = null;
                }

                $resultado = $sentencia->fetchAll();
                foreach($resultado as $fila){
                    echo '<option value="'. $fila['nombre'] .'">';
                }
                
        echo '</datalist>
            <label for="seccion">Seccion: *</label>
            <input type="text" name="seccion" id="seccion" list="seleccionSeccion" placeholder="'. $seccion .'"><br><br>

            <label for="fechaFinalizacionAlta">   Fecha de finalizaci&oacute;n *</label>
            <input type="date" id="fechaFinalizacionAlta" name="fechaFinalizacionAlta" required /><br><br>
            </article>
            <!-- Sección dedicada a la toma de datos de caracter más genérica -->
            <article>
                <label for="Descripcion">Descripci&oacute;n *</label> <br>
                <textarea name="Descripcion" id="Descripcion" rows="8" cols="80" required>'. $descripcion .'</textarea><br><br>
                <label for="Resumen">Resumen *</label> <br>
                <textarea name="Resumen" id="Resumen" rows="8" cols="80" required>'. $resumen .'</textarea><br><br>
            </article>

        </fieldset>
        <input type="submit" name="Enviar" class="boton">
        <input type="reset" name="Reset" class="boton">
        </form>
        ';
    }
    

?>