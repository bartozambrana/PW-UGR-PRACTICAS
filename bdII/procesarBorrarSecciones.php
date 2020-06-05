<?php 
    //Obtenemos todos los valores
    require_once("configuracion.php");
    require_once("conexion.php");

    //Establecemos las variables necesarias.
    $bd = $_POST['bd'];
    $nombreSeccion = $_POST['seccion'];

    //Comprobamos que el nombre de sección introducido existe:
    try{
        $sql = "SELECT nombre FROM " . SECCIONES ." WHERE nombre = :seccion AND nombrebd = :bd";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":seccion",$nombreSeccion);
        $sentencia->bindValue(":bd",$bd);
        $sentencia->execute();
    }catch(PDOException $e){
        echo $e ;
        $conexion = null;
        die();
    }
    //Si tenemos un resultado, eso indica que el nombre introducido es correcto.a
    $resultado = $sentencia->fetchAll();

    if( count($resultado) == 1){
        try{
            $sql = "DELETE ". SECCIONES .".* FROM " . SECCIONES ." WHERE nombre = :seccion AND nombrebd = :bd";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(":seccion",$nombreSeccion);
            $sentencia->bindValue(":bd",$bd);
            $sentencia->execute();
            $conexion = null;
    
            
        }catch(PDOException $e){
            echo $e ;
            $conexion = null;
            die();
        }
        header("Location: bd1.php?bd=". $bd . "&correcto=5" );
    }else{
        header("Location: borrarseccion.php?bd=". $bd ."&utilizado=1");
    }
    
    
?>