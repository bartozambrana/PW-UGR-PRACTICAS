<?php 
    require_once("conexion.php");
    require_once("configuracion.php");
    try{
        //Comprobamos si hay más de un elementp seleccionado, o no está definido
        if(!isset($_FILES['seleccionImagenBD']['error']) || is_array($_FILES['seleccionImagenBD']['error'])){
            throw new RuntimeException("Error más de un elemento seleccionado, o no definido");           
        }
        
        //echo $_FILES['seleccionImagenBD']['name'];
        //Comprobamos los distintos errores posibles: 
        switch ($_FILES['seleccionImagenBD']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('Documento no seleccionado.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Supera el tamaño límite');
            default:
                throw new RuntimeException('Algún error ocurrió.');
        }

        // //Comprobamos que se trata de una imagen:
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
            $finfo->file($_FILES['seleccionImagenBD']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        )) {
            throw new RuntimeException('No es una imagen');
        }

        $dir_subida = './imagenes/';
        $fichero_subido = $dir_subida . basename($_FILES['seleccionImagenBD']['name']);

        // if(!move_uploaded_file($_FILES['seleccionImagenBD']['tmp_name'], $fichero_subido)){
        //     echo "Error en la subida de fichero " . '<br>' . 'Directorio actual de ejecución: ' . getcwd() .'<br>' ;
        //     print_r($_FILES);
        //     exit();
        // }

        //Obención de variables:

        $nombre = $_POST['titulo'];
        $fechaAlta = $_POST["fechaDeAlta"];
        $fechaBaja = $_POST["fechaFinalizacionAlta"];
        $descripcion = $_POST["Descripcion"]; 


        try{
            $sql = "INSERT INTO ". BIBLIOTECAS_DIGITALES ." (nombre,fechaalta,fechabaja,descripcion,urlImagen) VALUES(:nombre,:fechaalta,:fechabaja,:descripcion,:imagen)";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(":nombre",$nombre);
            $sentencia->bindValue(":fechaalta", $fechaAlta);
            $sentencia->bindValue(":fechabaja", $fechaBaja);
            $sentencia->bindValue(":imagen", "./imagenes/documentales.jpg");
            $sentencia->bindValue(":descripcion", $descripcion);
            $sentencia->execute();

            $conexion = null;
        }catch(PDOException $e){
            echo $e;
            $conexion = null;
            die();
        }
        header("Location: gestorbd.php?correcto=1");
        //Realizamos la inserción de los demás datos
    }catch(RuntimeException $e){
        echo $e->getMessage();
    }


?>