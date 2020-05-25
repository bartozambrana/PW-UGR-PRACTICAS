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
    $sql = "SELECT usuario,email,telf,date_format(fNacimiento, '%d/%m/%Y') fNacimiento  FROM " . USUARIOS . " WHERE usuario = :nick AND password = :contrasenia";
    $sentencia = $conexion->prepare($sql);
  	$sentencia->bindValue(":nick",$usuario);
  	$sentencia->bindValue(":contrasenia", $contrasenia);
  	$sentencia->execute();
    $resultado = $sentencia->fetch();
  	if(!empty($resultado)){
      $_SESSION['usuario'] = $usuario;
      $_SESSION['email'] = $resultado['email'];
      $_SESSION['telefono'] = $resultado['telf'];
      $_SESSION['fechaNacimiento'] = $resultado['fNacimiento'];
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
