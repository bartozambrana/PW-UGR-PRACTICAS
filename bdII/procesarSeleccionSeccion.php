<?php
    $seccionSeleccionada = $_POST['seccion'] ;
    $bd = $_POST['bd'];
    header("Location: editarseccion.php?seleccionseccion=". $seccionSeleccionada ."&bd=". $bd);
?>