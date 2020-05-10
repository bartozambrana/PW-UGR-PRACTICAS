<?php

    function formularioLogin(){
        if(!isset($_SESSION['usuario'])){
            echo '<form id="formularioLogin" method="post" action="login.php">

                    <label for="usuario" id="enunciadoUsuario">Usuario </label><br>
                    <input type="text" name="usuario" id="usuario" ><br><br>
  
                    <label for="password" id="enunciadoPassword">Contrase&ntilde;a</label><br>
                    <input type="text" name="password" id="password"><br><br>
  

                    <input type="submit" class="boton" value="Enviar" />
                    </form>';
            if(!empty($_SESSION['incorrecto'])){
                echo '<script>
                        window.onload=function() {
                            alert("Usuario No Registrado");
                        }
                      </script>';
            }
        }else{
            echo '  <h2 id="subtituloCabecera"> '. $_SESSION['usuario'] . '</h2>
                    <aside>
                        <a href="./altagestor.html" class="enlace2">Alta</a>
                        <a href="./borrargestor.html" class="enlace2">Baja</a>
                        <a href="./editargestor.html" class="enlace2">Edici&oacute;n</a>
                        <a href="./logout.php" class="enlace2"> Cerrar Sesi&oacute;n </a>
                    </aside>';

        }
        
    }
    
?>