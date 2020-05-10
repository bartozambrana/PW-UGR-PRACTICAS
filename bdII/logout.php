<?php 
    //Restauramos la sesión abierta.
    session_start();

    //Cerramos la sesión
    session_destroy();
    header("Location: index.php");
    
?>