<?php
  //Reanudamos la sesión iniciada
  session_start();

  //Obtenemos las librerías necesarias para realizar la conexión y las variables definidas para llamar a las tablas.
  require_once('configuracion.php');
  require_once('conexion.php');

  //Obtenemos las variables del formulario
  $usuario = $_POST['usuario'];
  $contrasenia = $_POST['password'];

  //Intentamos realizar la consulta.
  try{
    $sql = "SELECT usuario FROM " . USUARIOS . " WHERE usuario = :nick AND password = :contrasenia";
    $sentencia = $conexion->prepare($sql);
  	$sentencia->bindValue(":nick",$usuario);
  	$sentencia->bindValue(":contrasenia", $contrasenia);
  	$sentencia->execute();
    
  	if(!empty($sentencia->fetch())){
      $_SESSION['usuario'] = $usuario;
  		header("Location: gestorbd.php");
  	}
  	else{
      $_SESSION['incorrecto'] = "usuarioIncorrecto";
      header("Location: index.php");
  	}
  }catch(PDOException $e){
    echo "Operración incorrecta : " .$e->getMessage();
    die();
    $conexion = null;
  }

?>
