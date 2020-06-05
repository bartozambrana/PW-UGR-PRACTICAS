<?php 
    require_once("conexion.php");
    require_once("configuracion.php");
    require_once("subidaFichero.php");

    //Comprobamos el campo de la selección de imagen
    $error = comprobarYsubir("foto");

    if($error != -1){
        switch($error){
            case 1: //Error más de un elemento seleccionado, o no definido
                header("Location: crearbd.php?error=1");
            break;

            case 2: //Documento no seleccionado
                header("Location: crearbd.php?error=2");
            break;

            case 3: //Supera el tamaño límite
                header("Location: crearbd.php?error=3");
            break;

            case 4: //Algún error ocurrió.
                header("Location: crearbd.php?error=4");
            break;

            case 5: //No es una imagen
                header("Location: crearbd.php?error=5");
            break;
        }
    }else{
        //Obención de variables:
        $nombre = $_POST['titulo'];
        $fechaAlta = $_POST["fechaDeAlta"];
        $fechaBaja = $_POST["fechaFinalizacionAlta"];
        $descripcion = $_POST["Descripcion"];

        //Comprobamos si la biblioteca digiral a introducir ya existe: 
        try{
            $sql = "SELECT nombre FROM ". BIBLIOTECAS_DIGITALES ." WHERE nombre = :nombre";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindValue(":nombre",$nombre);
                $sentencia->execute();
        }catch(PDOException $e){
            echo $e;
            $conexion = null;
            die();
        }

        $resultado = $sentencia->fetchAll();

        if(count($resultado) == 0){
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
        }else{
            $conexion = null;
            header("Location: crearbd.php?error=6");
        }
    }

?>