<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Bartolomé Zambrana Pérez">
    <link rel="stylesheet" type="text/css" href="./estilos.css">
    <script type="text/javascript" src="./validacion.js"></script>
    <title>Alta de Usuarios</title>
</head>

<body>
    <!-- Cabecera -->
    <header>
        <!--logo-->
        <section class="encabezado">
            <img src="./imagenes/logo.jpg" id="logoCabecera" alt="Logo del gestor">
        </section>

        <!--Nombre del gestor -->
        <section class="encabezado">
            <h1 id="tituloCabecera">Contenido digital Netflix</h1>
        </section>

        <!--Indicación de donde nos encontramos-->
        <section class="encabezado">
            <h2 id="subtituloCabecera">Alta de usuarios</h2>
        </section>

    </header>

    <!-- Cuerpo de la página -->
    <main>
        <!-- Navegador por si se quiere volver al inicio del todo-->
        <nav>
            <a href="./index.php" class="enlace1">Inicio</a>
        </nav>


        <section>
            <?php 
                if(isset($_GET["usuarioOcupado"]) && $_GET["usuarioOcupado"] == "utilizado"){
                    echo '<script>
                            window.onload=function() {
                                alert("Usuario ya utilizado");
                            }
                         </script>';
                    
                }
            ?>
            <!-- Formulario para dar de alta a un usuario -->
            <form id="formularioCentrado" action="altaUsuario.php" method="post" name="formularioAltaUsuario" onsubmit="return validarFormularioAltaUsuario();">
                <fieldset>
                    <legend>Datos Personales</legend>

                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" name="nombre" value="<?php if(isset($_GET["nombre"])) echo $_GET["nombre"]; else echo''; ?>" /><br><br>

                    <label for="apellidos">Apellidos *</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?php if(isset($_GET["apellidos"])) echo $_GET["apellidos"]; else echo''; ?>" /><br><br>

                    <label for="fechaNacimiento">Fecha de nacimiento *</label>
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php if(isset($_GET["fechaNacimiento"])) echo $_GET["fechaNacimiento"]; else echo''; ?>" /><br><br>

                    <label for="DNI">DNI *</label>
                    <input type="text" id="DNI" name="DNI" maxlength="9" value="<?php if(isset($_GET["DNI"])) echo $_GET["DNI"]; else echo'';?>" /><br><br>
                    <!--Establecemos máxima longitud nueve puesto que es el tamaño del DNI -->
                    <label for="email">Email *</label>
                    <input type="text" id="email" name="email" value="<?php if(isset($_GET["email"])) echo $_GET["email"]; else echo'';?>" /><br><br>

                    <label for="telefono">Tel&eacute;fono de contacto </label>
                    <input type="text" id="telefono" name="telefono" value="<?php if(isset($_GET["telefono"])) echo $_GET["telefono"]; else echo'';?>" /><br><br>

                    <label for="usuario">Nombre de Usuario *</label>
                    <input type="text" id="usuario" name="usuario" />
                    <br><br>

                    <label for="password">Contrase&ntilde;a *</label>
                    <input type="password" id="password" name="password" /><br><br>


                </fieldset>
                <input type="submit" name="Enviar" class="boton">
                <input type="reset" name="Reset" class="boton">
            </form>
        </section>


    </main>

    <!-- Pie de página -->
    <footer>

        <section>
            <h1 id="tituloPiePagina">Contacto-C&oacute;mo se hizo. </h1>
            <p id="fondoClaroParrafoPiePagina">En el siguiente enlace puede encontrar información del desarrollador del sitio web <a href="contacto.html" class="enlace2">Contacto</a> as&iacute; como se tomaron las decisiones en el proceso de desarrollo <a href="como_se_hizo.pdf" class="enlace2">C&oacute;mo se Hizo</a>
            </p>
        </section>

    </footer>

</body>

</html>