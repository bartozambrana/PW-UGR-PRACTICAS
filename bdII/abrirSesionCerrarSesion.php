<?php
  funcion AbrirSesionCerrarSesion(){
    if(!empty($_SESSION['usuario'])){
      echo '<form action = "abrirSesion.php" method = "POST" >
      <label for="usuario" id="enunciadoUsuario">Usuario </label><br>
      <input type="text" name="usuario" id="usuario" required><br><br>

      <label for="password" id="enunciadoPassword">Contrase&ntilde;a</label><br>
      <input type="text" name="password" id="password" placeholder="Contrase&ntilde;a"><br><br>
      '
    }

  }
 ?>
