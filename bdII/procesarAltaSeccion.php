<?php 
    require_once("configuracion.php");
    require_once("conexion.php");
    require_once("tratamientoCadenas.php");

    $nombre = quitarAcentos($_POST['titulo']);
    $fechaAlta = $_POST["fechaDeAlta"];
    $fechaBaja = $_POST["fechaFinalizacionAlta"];
    $descripcion = quitarAcentos($_POST["Descripcion"]);
    $bd = quitarAcentos($_POST["bd"]);

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
        // header("Location: altaseccion.php?error=1");
    }
    header("Location: bd1.php?correcto=4&bd=". $_POST['bd']);
?>