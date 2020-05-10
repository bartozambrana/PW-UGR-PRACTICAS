<?php
  //Establecemos una conexión con la BD.
  $user = 'pw26504270';
  $pass = '26504270';
  $dsn = 'mysql:host=localhost;dbname=db26504270_pw1920';

  try{
    $conexion = new PDO($dsn,$user,$pass);
    $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  } catch ( PDOException $e ) {
    echo "Conexión fallida: " . $e->getMessage();
  }
?>