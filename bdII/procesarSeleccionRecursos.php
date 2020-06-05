<?php
    //Obtenemos los ficheros necesarios: 
    require_once("configuracion.php");
    require_once("conexion.php");
    //Definimos las variables.
    $recursoSeleccionado = $_POST['recurso'] ;
    $bd = $_POST['bd'];
    //Comprobamos que no se haya introducido un recurso que no aparece en la lista.
    try{
        $sql = "SELECT recursos.nombre FROM ". RECURSOS . ", ". BIBLIOTECAS_DIGITALES ." WHERE recursos.nombre = :nombre AND bd1.nombre = :bd ";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":nombre",$recursoSeleccionado);
        $sentencia->bindValue(":bd",$bd);
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