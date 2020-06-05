<?php 

    //Obtención de los ficheros necesarios: 
    require_once("configuracion.php");
    require_once("conexion.php");

    //Obtención de variables: 
    $nombreSeccion = $_POST['titulo'];
    $fechaBaja = $_POST["fechaFinalizacionAlta"];
    $descripcion = $_POST["Descripcion"];
    $bd = $_POST['bd'];
    $nombreSeccionAntiguo = $_POST['seccion'];

    //Comprobamos en primer lugar que no hay una sección con el mismo nombre dentro de la misma biblioteca digital: 
    try{
        $sql = "SELECT nombre FROM ".SECCIONES." WHERE nombre = :nombre AND nombrebd = :bd";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre", $nombreSeccion);
        $sentencia->bindValue(":bd", $bd);
        $sentencia->execute();
    }catch(PDOException $e){
        echo $e;
        $conexion = null;
        die();
    }

    $resultado = $sentencia->fetchAll();

    if(count($resultado) == 0){
        //Realizamos la actualización de valores:
        try{
            if(empty($descripcion)){
                $sql = "UPDATE ". SECCIONES . " SET nombre = :nombre, fechabaja = :fechabaja, WHERE nombre = :nombreseccion AND nombrebd = :bd";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindValue(":nombre",$nombreSeccion);
                $sentencia->bindValue(":fechabaja", $fechaBaja);
                $sentencia->bindValue(":bd", $bd);
                $sentencia->bindValue(":nombreseccion", $nombreSeccionAntiguo);
            }else{
                $sql = "UPDATE ". SECCIONES . " SET nombre = :nombre, fechabaja = :fechabaja, descripcion = :descripcion WHERE nombre = :nombreseccion AND nombrebd = :bd";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindValue(":nombre",$nombreSeccion);
                $sentencia->bindValue(":fechabaja", $fechaBaja);
                $sentencia->bindValue(":descripcion", $descripcion);
                $sentencia->bindValue(":bd", $bd);
                $sentencia->bindValue(":nombreseccion", $nombreSeccionAntiguo);
            }
            $sentencia->execute();
        }catch(PDOException $e){
            echo $e;
            $conexion = null;
            die();
        }
        header("Location: bd1.php?correcto=6&bd=".$bd);
    }else{
        header("Location: editarseccion.php?utilizado=1&bd=".$bd."&seleccionseccion=".$nombreSeccion);
    }
?>