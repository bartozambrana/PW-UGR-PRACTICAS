<?php 
    
    //Obtenemos los ficheros necesarios para realizar la conexión a la bd, ya que en un caso
    // u otra va a ser utilizado.
    require_once("conexion.php");
    require_once("configuracion.php");
    require_once("tratamientoCadenas.php");


    if(!isset($_GET['seleccionseccion'])){
        //Buscamos todos los recursos asocidados a dicha biblioteca digital
        try{
            $sql = "SELECT nombre FROM ".SECCIONES ." WHERE nombrebd = :bd ";
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
        <form id="formulario" action="procesarSeleccionSeccion.php" method="post">
            <fieldset>
            <legend>Formulario de selecci&oacute;n de secci&oacute;n.</legend>
            <datalist id="seleccionSeccion">
            ';
            foreach($resultado as $fila){
                echo '<option value="'. $fila['nombre'] .'">';
            }
        echo '</datalist>
            <label for="recurso">Seccion *</label>
            <input type="text" name="seccion" id="seccion" list="seleccionSeccion" required>
            
            <input type="hidden" name="bd" id="bd" value="'. $_GET['bd'] .'">
            </fieldset>
            <input type="submit" name="Enviar" class="boton" value="Siguiente Paso" >
            <input type="reset" name="Reset" class="boton">
        </form>
        ';


    }else{
        echo '
        <article>
            <h2 id="tituloGeneral">Datos Seccion a Editar</h2>
            ';
            try{
                $sql = "SELECT nombre, date_format(fechaalta,'%d/%m/%Y') fechaalta, date_format(fechabaja, '%d/%m/%Y') fechabaja, descripcion, nombrebd FROM ". SECCIONES ." WHERE nombre = :nombre";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindValue(":nombre",quitarAcentos($_GET['seleccionseccion']) );
                $sentencia->execute();
            }catch(PDOException $e){
                echo $e;
                die();
                $conexion = null;
            }
            
    
            $resultado = $sentencia->fetch();

            echo'<ul class="relevante">
                    <li>Nombre de la secci&oacute;n: '. $resultado["nombre"] . '</li>
                    <li>Nombre de la biblioteca digital a la que pertenece : '. $resultado["nombrebd"] . '</li>
                    <li>Fecha de alta de la biblioteca digital: '. $resultado["fechaalta"] .'</li>
                    <li>Fecha de baja de la biblioteca digital: '. $resultado["fechabaja"] .'</li>
                    <li>Descripcion: ' .$resultado["descripcion"] . '</li>
                
                </ul>';
                
            $seccion = $resultado['nombrebd'];
            $descripcion = $resultado['descripcion'];
            echo '
        </article>
        
        <form id="formulario" action="procesarEdicionSeccion.php" method="post" name="formularioEdicionSeccion" onsubmit="return validarEdicionSeccion();">

        <fieldset>
            <legend>Formulario de edici&oacute;n de la secci&oacute;n.</legend>
                         
            <label for="titulo">T&iacute;tulo: *</label>
            <input type="text" name="titulo" id="titulo" list="seleccionRecurso" required><br><br>

            <datalist id="seleccionSeccion">';

            //Obtenemos todas las secciones disponibles en la biblioteca actual en la que nos encontramos.
            try{
                $sql = "SELECT nombre FROM ".BIBLIOTECAS_DIGITALES;
                $resultado = $conexion->query($sql);
            }catch(PDOException $e){
                echo $e;
                die();
                $conexion = null;
            }

            foreach($resultado as $fila){
                echo '<option value="'. $fila['nombre'] .'">';
            }
                
        echo '</datalist>
            <label for="seccion">Seccion: *</label>
            <input type="text" name="seccion" id="seccion" list="seleccionSeccion" placeholder="'. $seccion .'"><br><br>

            <label for="fechaFinalizacionAlta">   Fecha de finalizaci&oacute;n *</label>
            <input type="date" id="fechaFinalizacionAlta" name="fechaFinalizacionAlta" required /><br><br>
        
            <label for="Descripcion">Descripci&oacute;n *</label> <br>
            <textarea name="Descripcion" id="Descripcion" rows="8" cols="80" required>'. $descripcion .'</textarea><br><br>

        </fieldset>
        <input type="submit" name="Enviar" class="boton">
        <input type="reset" name="Reset" class="boton">
        </form>
        ';
    }
    

?>