<?php
    $recursoSeleccionado = $_POST['recurso'] ;
    $bd = $_POST['bd'];
    header("Location: editarrecurso.php?recursoseleccionado=". $recursoSeleccionado ."&bd=". $bd);
?>