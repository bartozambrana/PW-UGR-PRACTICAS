<?php 

    //Establecimiento de los ficheros necesarios:
    require_once("configuracion.php");
    require_once("conexion.php");
    require_once("tratamientoCadenas.php");
    //Establecimiento de variables
    $bd = quitarAcentos($_POST["nombreBD"]);
    $descripcion = $_POST["Descripcion"];
    $descripcion = quitarAcentos($descripcion);
    $fechaFinalizacion  =$_POST["fechaFinalizacionAlta"];
    echo $descripcion . '<br> ' . $fechaFinalizacion . '<br> ' . $bd . '<br> ';
    //Realización de la actualización
    try{

        $sql = "UPDATE ". BIBLIOTECAS_DIGITALES ." SET descripcion =:descripcion , fechabaja = :fechabaja  WHERE nombre = :nombre";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":descripcion", $descripcion);
        $sentencia->bindValue(":fechabaja", $fechaFinalizacion);
        $sentencia->bindValue(":nombre",$bd);
        $sentencia->execute();

    }catch(PDOException $e){
        echo $e . "nombre biblioteca digital ". $bd;
        $conexion = null;
        die();
    }
    header("Location: gestorbd.php?correcto=3");
?>