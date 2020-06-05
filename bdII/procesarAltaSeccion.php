<?php
    //Obtener ficheros necesarios
    require_once("configuracion.php");
    require_once("conexion.php");


    //Establecemos las variables necesarias
    $nombre = $_POST['titulo'];
    $fechaAlta = $_POST["fechaDeAlta"];
    $fechaBaja = $_POST["fechaFinalizacionAlta"];
    $descripcion = $_POST["Descripcion"];
    $bd = $_POST["bd"];

    //Comprobamos que la sección a introducir no exista:
    try{
        $sql = "SELECT nombre FROM ".SECCIONES." WHERE nombre = :nombre AND nombrebd = :bd";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre",$nombre);
        $sentencia->bindValue(":bd", $bd);
        $sentencia->execute();
    }catch(PDOException $e){
        echo $e;
        $conexion = null;
        die();
    }
    
    $resultado = $sentencia->fetchAll();
    if( count($resultado) == 0){
       //insertamos la sección 
       try{
        $sql = "INSERT INTO " . SECCIONES . "(nombre, fechaalta, fechabaja, descripcion, nombrebd) VALUES(:nombre,:fechaalta,:fechabaja,:descripcion,:nombrebd)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre",$nombre);
        $sentencia->bindValue(":fechaalta", $fechaAlta);
        $sentencia->bindValue(":fechabaja", $fechaBaja);
        $sentencia->bindValue(":descripcion", $descripcion);
        $sentencia->bindValue(":nombrebd", $bd);
        $sentencia->execute();
        }catch(PDOException $e){
            echo $e;
            $conexion = null;
            die();
        }
        header("Location: bd1.php?correcto=4&bd=". $bd);
    }else{
        $conexion = null;
        header("Location: altaseccion.php?utilizado=1&bd=". $bd);
    }
    
    
?>