<?php 

    //Establecimiento de los ficheros necesarios:
    require_once("configuracion.php");
    require_once("conexion.php");
    //Establecimiento de variables
    $bd = $_POST["nombreBD"];

    //Realización de la actualización
    try{
        $sql = "DELETE ". BIBLIOTECAS_DIGITALES .".* FROM " . BIBLIOTECAS_DIGITALES ." WHERE nombre = :nombre";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre",$bd);
        $sentencia->execute();
        $conexion = null;

        header("Location: gestorbd.php");
    }catch(PDOException $e){
        echo $e . "nombre biblioteca digital ". $bd;
        $conexion = null;
        die();
    }
?>