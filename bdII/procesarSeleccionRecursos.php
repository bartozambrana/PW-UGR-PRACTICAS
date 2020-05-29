<?php
    //Obtenemos los ficheros necesarios: 
    require_once("configuracion.php");
    require_once("conexion.php");
    require_once("tratamientoCadenas.php");
    //Definimos las variables.
    $recursoSeleccionado = $_POST['recurso'] ;
    $bd = $_POST['bd'];
    //Comprobamos que no se haya introducido un recurso que no aparece en la lista.
    try{
        $sql = "SELECT nombre FROM ". RECURSOS . " WHERE nombre = :nombre";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre",quitarAcentos($recursoSeleccionado));
        $sentencia->execute();
    }catch(PDOException $e){
        echo $e;
        $conexion = null;
        die();
    }
    
    $resultado = $sentencia->fetchAll();
    if(count($resultado) == 0){
        header("Location: editarrecurso.php?utilizado=2&bd=". $bd);
    }else{
        header("Location: editarrecurso.php?recursoseleccionado=". $recursoSeleccionado ."&bd=". $bd);
    }
?>