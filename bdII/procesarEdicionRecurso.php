<?php 

    //Obtención de los ficheros necesarios: 
    require_once("configuracion.php");
    require_once("conexion.php");
    

    //Obtención de variables: 
    $nombreRecurso = $_POST['titulo'];
    $fechaBaja = $_POST["fechaFinalizacionAlta"];
    $descripcion = $_POST["Descripcion"];
    $seccion = $_POST['seccion'];
    $resumen = $_POST["Resumen"];
    $bd = $_POST['bd'];


    //Comprobamos en primer lugar que no hay una sección con el mismo nombre dentro de la misma biblioteca digital: 
    try{
        $sql = "SELECT nombre FROM ".RECURSOS." WHERE nombre = :nombre";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre", $nombreRecurso);
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
                $sql = "UPDATE ". RECURSOS . " SET nombre = :nombre, fechabaja = :fechabaja, WHERE nombre = :nombreseccion AND nombrebd = :bd";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindValue(":nombre",$nombreSeccion);
                $sentencia->bindValue(":fechabaja", $fechaBaja);
                $sentencia->bindValue(":bd", $bd);
                $sentencia->bindValue(":nombreseccion", $nombreSeccionAntiguo);
            }else{
                $sql = "UPDATE ". RECURSOS . " SET nombre = :nombre, fechabaja = :fechabaja, descripcion = :descripcion WHERE nombre = :nombreseccion AND nombrebd = :bd";
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
        header("Location: bd1.php?correcto=3&bd=".$bd);
    }else{
        header("Location: editarrecurso.php?utilizado=1&bd=".$bd."&recursoseleccionado=".$nombreRecurso);
    }
?>o