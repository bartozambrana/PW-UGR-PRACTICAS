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
?>