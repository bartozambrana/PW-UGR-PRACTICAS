<?php 
    function quitarAcentos($cadena){
        $resultado = str_replace("í","&iacute;",$cadena);
        $resultado = str_replace("á","&aacute;",$resultado);
        $resultado = str_replace("é","&eacute;",$resultado);
        $resultado = str_replace("ó","&oacute;",$resultado);
        $resultado = str_replace("ú","&uacute;",$resultado);
        $resultado = str_replace("ñ","&ntilde;",$resultado);
        return $resultado;
    }
?>