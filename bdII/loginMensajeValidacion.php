<?php
    //Requiere que el documento donde se utilice tenga un session_start();
    function formularioLogin(){
        //Usuario no logueado
        if(!isset($_SESSION['usuario'])){
            echo '<form id="formularioLogin" name="formularioLogin" method="post" action="login.php" onsubmit="return validarLogin();">

                    <label for="usuario" id="enunciadoUsuario">Usuario </label><br>
                    <input type="text" name="usuario" id="usuario"  ><br><br>
  
                    <label for="password" id="enunciadoPassword">Contrase&ntilde;a</label><br>
                    <input type="password" name="password" id="password" ><br><br>
  
                    <input type="submit" class="boton" value="Enviar"/><br>
                    </form>' .
                    '<a href="altagestor.php" class="enlace2"> Registrate </a>' ;
            if(isset($_SESSION['incorrecto'])){
                echo '<script>
                        window.onload=function() {
                            alert("Usuario No Registrado");
                        }
                      </script>';
            }
        }else{ //Usuario logueado
            echo '  <h2 id="subtituloCabecera"> '. $_SESSION['usuario'] . '</h2>
                    <aside>
                        <a href="./editargestor.php" class="enlace2">Edici&oacute;n</a>
                        <a href="./logout.php" class="enlace2"> Cerrar Sesi&oacute;n </a>
                    </aside>';

        }
        
    }
    
?>