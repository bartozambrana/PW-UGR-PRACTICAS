<?php 
    session_start();
    //Establecimiento de los ficheros necesarios:
    require_once("configuracion.php");
    require_once("conexion.php");
    //Establecimiento de variables
    $email = $_POST["email"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
    $telf = $_POST["telefono"];
    $usuario = $_SESSION['usuario'];
    //Realización de la actualización
    try{

        $sql = "UPDATE ". USUARIOS ." SET email =:email, fNacimiento = :fecha, telf = :telf  WHERE usuario = :usuario";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":email", $email);
        $sentencia->bindValue(":fecha", $fechaNacimiento);
        $sentencia->bindValue(":telf", $telf);
        $sentencia->bindValue(":usuario",$usuario);
        $sentencia->execute();

        $_SESSION['email'] = $email;
        $_SESSION['fechaNacimiento'] = $fechaNacimiento;
        $_SESSION['telefono'] = $telf;

    }catch(PDOException $e){
        echo $e;
        $conexion = null;
        die();
    }
    header("Location: gestorbd.php");
?>