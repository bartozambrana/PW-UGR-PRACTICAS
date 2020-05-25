<?php 
    require_once("configuracion.php");
    require_once("conexion.php");

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
    $dni = $_POST["DNI"];
    $email = $_POST["email"];
    $telf = $_POST["telefono"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    try{
        $sql2 = "SELECT * FROM ". USUARIOS ." WHERE usuario = :usuario";
        $sentencia2 = $conexion ->prepare($sql2);
        $sentencia2->bindvalue(":usuario",$usuario);
        $sentencia2->execute();

        if(empty($sentencia2->fetch())){
            //Registramos el usuario
            try{
                $sql = "INSERT INTO " . USUARIOS . "(dni, usuario, nombre, apellidos, fNacimiento, email, password, telf) VALUES(:dni,:usuario,:nombre,:apellidos,:fechaNacimiento,:email,:password,:telf)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindValue(":dni",$dni);
                $sentencia->bindValue(":usuario", $usuario);
                $sentencia->bindValue(":nombre", $nombre);
                $sentencia->bindValue(":apellidos", $apellidos);
                $sentencia->bindValue(":fechaNacimiento", $fechaNacimiento);
                $sentencia->bindValue(":email", $email);
                $sentencia->bindValue(":password", $password);
                $sentencia->bindValue(":telf", $telf);
                $sentencia->execute();
            }catch(PDOException $e){
                echo "Operración de inserccion : " .$e->getMessage();
                die();
                $conexion = null;
              }
              header("Location: index.php");
        }else{
            //Notificamos que ese usuario ya se encuentra utilizado
            $usado = "utilizado";
            header("Location: altagestor.php?usuarioOcupado=$usado&nombre=$nombre&apellidos=$apellidos&fechaNacimiento=$fechaNacimiento&DNI=$dni&telefono=$telf&email=$email");
        }
    }catch(PDOException $e2){
        echo "Operración de comprobación de usuario : " .$e2->getMessage();
        die();
        $conexion = null;
    }

    

  
?>