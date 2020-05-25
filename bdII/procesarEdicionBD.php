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
        // $data = [
        //     'descripcion' => $descripcion,
        //     'fechabaja' => $fechaFinalizacion,
        //     'nombre' => $bd
        // ];
        // $sql = "UPDATE ". BIBLIOTECAS_DIGITALES ." SET descripcion = :descripcion, fechabaja = :fechabaja  WHERE nombre = :nombre";
        // $sentencia = $conexion->prepare($sql);
        // $sentencia->execute($data);

        $sql = "UPDATE ". BIBLIOTECAS_DIGITALES ." SET descripcion =:descripcion , fechabaja = :fechabaja  WHERE nombre = :nombre";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":descripcion", $descripcion);
        $sentencia->bindValue(":fechabaja", $fechaFinalizacion);
        $sentencia->bindValue(":nombre",$bd);
        $sentencia->execute();
        
        // $sql = "UPDATE bd1 SET descripcion = '" . $descripcion . "', fechabaja = '".$fechaFinalizacion ."' WHERE nombre = '". $bd ."'";
        // echo $sql;
        // $conexion->query($sql);
    }catch(PDOException $e){
        echo $e . "nombre biblioteca digital ". $bd;
        $conexion = null;
        die();
    }
    header("Location: gestorbd.php");
?>