<?php 
    //Obtenemos todos los valores
    require_once("tratamientoCadenas.php");
    require_once("configuracion.php");
    require_once("conexion.php");
    
    try{
        $sql = "DELETE ". RECURSOS .".* FROM " . RECURSOS ." WHERE nombre = :nombre";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre",quitarAcentos($_POST['recurso']));
        $sentencia->execute();
        $conexion = null;

        
    }catch(PDOException $e){
        echo $e ;
        $conexion = null;
        die();
    }
    header("Location: bd1.php?bd=". $_POST['bd'] . "&correcto=2" );
?>