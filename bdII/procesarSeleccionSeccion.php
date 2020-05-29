<?php
    //Obtención de los ficheros necesarios
    require_once("configuracion.php");
    require_once("conexion.php");
    require_once("tratamientoCadenas.php");
    //Obtención de variables.
    $seccionSeleccionada = $_POST['seccion'] ;
    $bd = $_POST['bd'];
    //Comprobemos que se ha introducido una sección que existe en dicha biblioteca digital.
    try{
        $sql = "SELECT nombre FROM ". SECCIONES . " WHERE nombre = :nombre AND nombrebd = :bd";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre",quitarAcentos($seccionSeleccionada));
        $sentencia->bindValue(":bd",quitarAcentos($bd));
        $sentencia->execute();
    }catch(PDOException $e){
        echo $e;
        $conexion = null;
        die();
    }
    
    $resultado = $sentencia->fetchAll();
    if(count($resultado) == 0){
        header("Location: editarseccion.php?utilizado=2&bd=". $bd);
    }else{
        header("Location: editarseccion.php?seleccionseccion=". $seccionSeleccionada ."&bd=". $bd);
    }

    
?>