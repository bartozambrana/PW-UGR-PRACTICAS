<?php 
    //Obtenemos todos los valores
    require_once("tratamientoCadenas.php");
    require_once("configuracion.php");
    require_once("conexion.php");
    
    try{
        $sql = "DELETE ". SECCIONES .".* FROM " . SECCIONES ." WHERE nombre = :seccion AND nombrebd = :bd";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":seccion",quitarAcentos($_POST['seccion']));
        $sentencia->bindValue(":bd",quitarAcentos($_POST['bd']));
        $sentencia->execute();
        $conexion = null;

        
    }catch(PDOException $e){
        echo $e ;
        $conexion = null;
        die();
    }
    header("Location: bd1.php?bd". quitarAcentos($_POST['bd']) . "&correcto=5" );
?>