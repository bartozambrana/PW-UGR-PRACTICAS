<?php 
    //Obtenemos todos los valores
    require_once("tratamientoCadenas.php");
    require_once("configuracion.php");
    require_once("conexion.php");
    //Creamos las variables necesarias:
    $bd = $_POST['bd'];
    $nombreRecurso = $_POST['recurso'];

    //Comprobamos si el recurso introducido existe en primer lugar
    try{
        $sql = "SELECT nombre FROM " . RECURSOS . " WHERE nombre = :nombre";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre",quitarAcentos($nombreRecurso));
        $sentencia->execute();
    }catch(PDOException $e){
        echo $e;
        $conexion = null;
        die();
    }

    //Si el resultado tiene un tamaño de 1 indica que el recurso existe, en caso contrario no existe.
    $resultado = $sentencia->fetchAll();
    if( count($resultado) == 1){
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
        header("Location: bd1.php?bd=". $bd . "&correcto=2" );
    }else{
        //el recurso no existe, luego establecemos la variable $conexion a nulo y lo indicamos.
        header("Location: borrarrecursos.php?bd=". $bd ."&utilizado=1");
    }
    
?>