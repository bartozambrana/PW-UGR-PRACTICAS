<?php 

    function comprobarYsubir($campo){
        $error = -1;
         //Comprobamos si hay más de un elemento seleccionado, o no está definido
         if(!isset($_FILES[$campo]['error']) || is_array($_FILES[$campo]['error'])){
            throw new RuntimeException("Error más de un elemento seleccionado, o no definido");
            $error = 1;           
        }
        
        //echo $_FILES[$campo]['name'];
        //Comprobamos los distintos errores posibles: 
        switch ($_FILES[$campo]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                $error = 2;
            break;
            case UPLOAD_ERR_FORM_SIZE:
                $error = 3;
            break;
            default:
                $error = 4;
            
        }
        if($error == -1){
                // //Comprobamos que se trata de una imagen:
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES[$campo]['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                $error = 5;
            }

            $dir_subida = 'home/pw26504270/public_html/bdII/imagenes/';
            $fichero_subido = $dir_subida . basename($_FILES[$campo]['name']);

            // if(!move_uploaded_file($_FILES[$campo]['tmp_name'], $fichero_subido)){
            //     echo "Error en la subida de fichero " . '<br>' . 'Directorio actual de ejecución: ' . getcwd() .'<br>' ;
            //     print_r($_FILES);
            //     exit();
            // }

        }
        
        
        return $error;
    }

?>