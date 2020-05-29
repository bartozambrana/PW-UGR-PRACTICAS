<?php 
    //Incluimos los ficheros necesarios
    require_once("configuracion.php");
    require_once("conexion.php");
    require_once("tratamientoCadenas.php");

    //Variables
    $nombre = $_POST['nombre'];
    $fechaAlta = $_POST["fechaDeAlta"];
    $fechaBaja = $_POST["fechaFinalizacionAlta"];
    $descripcion = $_POST['descripcion'];
    $seccion = $_POST['seccion'];
    $resumen = $_POST['resumen'];
    $bd = $_POST['bd'];

    //Comprobamos que dicho recurso no existe
    try{
        $sql = "SELECT nombre FROM " . RECURSOS . " WHERE nombre = :nombre";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre",$nombre);
        $sentencia->execute();

    }catch(PDOException $e){
        echo $e;
        $conexion = null;
        die();
    }

    $resultado = $sentencia->fetchAll();
    if( count($resultado) == 0){
        //Comprobamos que la sección introducida exista en esta biblioteca digital:
        try{
            $sql = "SELECT nombre FROM " . SECCIONES . " WHERE nombre = :nombre AND nombrebd = :bd ";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(":nombre",quitarAcentos($seccion));
            $sentencia->bindValue(":bd",quitarAcentos($bd));
            $sentencia->execute();
    
        }catch(PDOException $e){
            echo $e;
            $conexion = null;
            die();
        }

        $resultado = $sentencia->fetchAll();
        if( count($resultado) == 1){
            try{
                $sql = "INSERT INTO " . RECURSOS . "(nombre, fechaalta, fechabaja, urlImagen, seccion, descripcion, resumen) 
                VALUES(:nombre,:fechaalta,:fechabaja,:imagen,:seccion,:descripcion,:resumen)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindValue(":nombre",$nombre);
                $sentencia->bindValue(":fechaalta", $fechaAlta);
                $sentencia->bindValue(":fechabaja", $fechaBaja);
                $sentencia->bindValue(":imagen", "./imagenes/piratasDelCaribe.jpeg");
                $sentencia->bindValue(":seccion",  quitarAcentos($seccion));
                $sentencia->bindValue(":descripcion", $descripcion);
                $sentencia->bindValue(":resumen", $resumen);
                $sentencia->execute();
        
                $conexion = null;
        
            }catch(PDOException $e){
                echo $e;
                $conexion = null;
                die();
            }
        
            header("Location: bd1.php?correcto=1&bd=". $_POST['bd']);
        }else{
            $conexion = null;
            header("Location: altarecurso.php?utilizado=2&bd=". $_POST['bd']);
        }

        
    }else{
        $conexion = null;
        header("Location: altarecurso.php?utilizado=1&bd=". $_POST['bd']);
    }

    
?>