/**
 * @brief esta función sirve para mostrar un ventana con un mensaje de alerta.
 * @param  mensaje mensaje a dar de alerta 
 */

function alerta(mensaje) {
    alert(mensaje);
}

function validarLogin() {
    let usuario = document.formularioLogin.usuario.value;

    if (usuario == "") {
        window.onload = alerta("Campo Usuario vacío.");
        document.formularioLogin.usuario.focus();
        return false;
    } else if (usuario > 50) {
        window.onload = alerta("Campo Usuario demasiado extenso.");
        document.formularioLogin.usuario.focus();
        return false;
    }

    let password = document.formularioLogin.password.value;
    if (password == "") {
        window.onload = alerta("Campo Password vacío.");
        document.formularioLogin.password.focus();
        return false;
    } else if (password > 50) {
        window.onload = alerta("Campo Password demasiado extenso.");
        document.formularioLogin.password.focus();
        return false;
    }
    return true;

}
/**
 * @brief función de validación de formulario de alta de usuario.
 */
function validarFormularioAltaUsuario() {

    //Nombre:
    let nombre = document.formularioAltaUsuario.nombre.value;

    if (nombre == "") {
        window.onload = alerta("Campo Nombre vacío.");
        document.formularioAltaUsuario.nombre.focus();
        return false;
    } else if (nombre > 50) {
        window.onload = alerta("Nombre demasiado largo");
        document.formularioAltaUsuario.nombre.focus();
        return false;
    }

    //Apellidos: 
    let apellidos = document.formularioAltaUsuario.apellidos.value;

    if (apellidos == "") {
        window.onload = alerta("Campo Apellidos vacío.");
        document.formularioAltaUsuario.nombre.focus();
        return false;
    } else if (apellidos > 50) {
        window.onload = alerta("Apellidos demasiados largos");
        document.formularioAltaUsuario.nombre.focus();
        return false;
    }

    //Fecha Nacimiento.
    let fechaNacimiento = document.formularioAltaUsuario.fechaNacimiento.value;
    if (fechaNacimiento == "") {
        window.onload = alerta("Campo Fecha de Nacimiento vacío");
        document.formularioAltaUsuario.fechaNacimiento.focus();
        return false;
    } //no hace falta comprobar el formato puesto lo devulve siempre en el formato adecuado

    //DNI
    let dni = document.formularioAltaUsuario.DNI.value;
    if (dni = "") {
        window.onload = alerta("Campo dni vacío");
        document.formularioAltaUsuario.DNI.focus();
        return false;
    }

    //EMAIL
    let email = document.formularioAltaUsuario.email.value;
    if (!(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(email))) {
        window.onload = alerta("La dirección de email " + email + " no es correcta.");
        document.formularioAltaUsuario.email.focus();
        return false;
    } else if (email == "") {
        window.onload = alerta("La dirección de email es incorrecta.");
        document.formularioAltaUsuario.email.focus();
        return false;
    } else if (email.length > 100) {
        window.onload = alerta("La dirección de email es demasiada extensa.");
        document.formularioAltaUsuario.email.focus();
        return false;
    }

    //Telefono
    let telf = document.formularioAltaUsuario.telefono.value;
    if (telf != "") {
        if (!(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(telf))) {
            window.onload = alerta("Telefono introducido no correcto, tiene que introducirse procedencia de teléfono");
            document.formularioAltaUsuario.telefono.focus();
            return false;
        } else if (telf.length > 20) {
            window.onload = alerta("Telefono introducido no existe supera los 20 dígitos");
            document.formularioAltaUsuario.telefono.focus();
            return false;
        }
    } else if (telf = "") {
        window.onload = alerta("Telefono no introducido");
        document.formularioAltaUsuario.telefono.focus();
        return false;
    }
    //Usuarios
    let usuario = document.formularioAltaUsuario.usuario.value;

    //Concatenemos con else if para evitar mostrar repetidas ventanas referidas a una cosa
    //Comprobamos si el campo está vacío, en verdad no hace falta al tener definido required.
    if (usuario == "") {
        //mostramos el mensaje cuando la ventana este cargada
        window.onload = alerta("Campo Usuario vacío");
        document.formularioAltaUsuario.usuario.focus();
        return false;
    } else if (usuario.length < 2) { //Imponemos la resticción de que el usuario tenga al menos 3 caracteres.
        window.onload = alerta("Campo Usuario demasiado corto");
        document.formularioAltaUsuario.usuario.focus();
        return false;
    } else if (usuario.length > 50) {
        window.onload = alerta("Campo Usuario demasiado largo");
        document.formularioAltaUsuario.usuario.focus();
        return false;
    }

    //Contraseña: 
    let password = document.formularioAltaUsuario.password.value;

    if (password == "") {
        window.onload = alerta("Campo contraseña vacío.");
        document.formularioAltaUsuario.password.focus();
        return false;
    } else if (password.length < 6) {
        window.onload = alerta("Contaseña demasiada corta")
        document.formularioAltaUsuario.password.focus();
        return false;
    } else if (password > 50) {
        window.onload = alerta("Contraseña demasiado larga");
        document.formularioAltaUsuario.password.focus();
        return false;
    } else if (password.indexof(" ") == -1) { //comprobemos que no tiene espacios
        window.onload = alerta("La contraseña no puede contener espacios");
        document.formularioAltaUsuario.password.focus();
        return false;
    }
    return true;
}

/**
 * @brief Función de validación de todos los campos del formulario de edición de biblioteca digital.
 */

function validarEditarBibliotecaDigital() {

    let fechaFinalizacion = document.formularioEditarBibliotecaDigital.fechaFinalizacionAlta.value;
    if (fechaFinalizacion == "") {
        window.onload = alerta("El campo Fecha de Finalización de Alta está vacío");
        document.formularioEditarBibliotecaDigital.fechaFinalizacionAlta.focus();
        return false;
    }

    let descripcion = document.formularioEditarBibliotecaDigital.Descripcion.value;
    if (descripcion == "") {
        window.onload = alerta("El campo Descripciñon está vacío");
        document.formularioEditarBibliotecaDigital.Descripcion.focus();
        return false;
    } else if (descripcion.length > 400) {
        window.onload = alerta("El campo Descripciñon demasiado extenso");
        document.formularioEditarBibliotecaDigital.Descripcion.focus();
        return false;
    }

    return true;

}

/**
 * @brief Función de validación de todos los campos del formulario de edición de usuario.
 */

function validarModificarUsuario() {

    let email = document.formularioEdicionUsuario.email.value;
    if (!(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(email))) {
        window.onload = alerta("La dirección de email " + email + " no es correcta.");
        document.formularioEdicionUsuario.email.focus();
        return false;
    } else if (email == "") {
        window.onload = alerta("La dirección de email es incorrecta.");
        document.formularioEdicionUsuario.email.focus();
        return false;
    } else if (email.length > 100) {
        window.onload = alerta("La dirección de email es demasiada extensa.");
        document.formularioEdicionUsuario.email.focus();
        return false;
    }

    let telefono = document.formularioEdicionUsuario.telefono.value;
    if (telefono != "") {
        if (!(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(telefono))) {
            window.onload = alerta("Telefono introducido no correcto");
            document.formularioEdicionUsuario.telefono.focus();
            return false;
        } else if (telefono.length > 20) {
            window.onload = alerta("Telefono introducido no correcto, supera los 20 dígitos");
            document.formularioEdicionUsuario.telefono.focus();
            return false;
        }
    }

    let fechaNacimiento = document.formularioEdicionUsuario.fechaNacimiento.value;
    if (fechaNacimiento == "") {
        window.onload = alerta("Campo Fecha de Nacimiento vacío");
        document.formularioEdicionUsuario.fechaNacimiento.focus();
        return false;
    } //no hace falta comprobar el formato puesto lo devulve siempre en el formato adecuado

    return true;

}

/**
 * @brief Función de validación de todos los campos del formulario de edición de usuario.
 */

function validarCrearBD() {

    let nombre = document.formularioCrearBD.titulo.value;
    if (nombre == "") {
        window.onload = alerta("Campo Título de la BD vacío");
        document.formularioCrearBD.titulo.focus();
        return false;
    } else if (nombre.length > 20) {
        window.onload = alerta("Nombre de Biblioteca digital demasiado extenso");
        document.formularioCrearBD.titulo.focus();
        return false;
    }

    let foto = document.formularioCrearBD.foto.value;
    console.log("entro");
    if (foto == "") {
        window.onload = alerta("Campo de selección de fotografía vacío");
        document.formularioCrearBD.foto.focus();
        return false;
    }


    let fechaDeAlta = document.formularioCrearBD.fechaDeAlta.value;
    if (fechaDeAlta == "") {
        window.onload = alerta("Campo Fecha de Alta de la BD vacío");
        document.formularioCrearBD.fechaDeAlta.focus();
        return false;
    }

    let fechaFinalizacionAlta = document.formularioCrearBD.fechaFinalizacionAlta.value;
    if (fechaFinalizacionAlta == "") {
        window.onload = alerta("Campo Fecha de Finalización de Alta de la BD vacío");
        document.formularioCrearBD.fechaFinalizacionAlta.focus();
        return false;
    }

    let descripcion = document.formularioCrearBD.Descripcion.value;
    if (descripcion == "") {
        window.onload = alerta("El campo Descripciñon está vacío");
        document.formularioCrearBD.Descripcion.focus();
        return false;
    } else if (descripcion.length > 400) {
        window.onload = alerta("El campo Descripciñon demasiado extenso");
        document.formularioCrearBD.Descripcion.focus();
        return false;
    }
    return true;

}

function validarEdicionSeccion() {
    let nombre = document.formularioEdicionSeccion.titulo.value;
    if (nombre == "") {
        window.onload = alerta("Campo Título de la Sección vacío");
        document.formularioEdicionSeccion.titulo.focus();
        return false;
    } else if (nombre.length > 60) {
        window.onload = alerta("Nombre de sección demasiado extenso");
        document.formularioEdicionSeccion.titulo.focus();
        return false;
    }


    let fechaFinalizacionAlta = document.formularioEdicionSeccion.fechaFinalizacionAlta.value;
    if (fechaFinalizacionAlta == "") {
        window.onload = alerta("Campo Fecha de Finalización de la Sección vacío");
        document.formularioEdicionSeccion.fechaFinalizacionAlta.focus();
        return false;
    }

    let descripcion = document.formularioEdicionSeccion.Descripcion.value;
    if (descripcion.length > 400) {
        window.onload = alerta("El campo Descripciñon demasiado extenso");
        document.formularioEdicionSeccion.Descripcion.focus();
        return false;
    }
    return true;
}

function validarEdicionRecurso() {
    let nombre = document.formularioEdicionRecursos.titulo.value;
    if (nombre == "") {
        window.onload = alerta("Campo Título vacío");
        document.formularioEdicionRecursos.titulo.focus();
        return false;
    } else if (nombre.length > 140) {
        window.onload = alerta("Campo Título demasiado extenso");
        document.formularioEdicionRecursos.titulo.focus();
        return false;
    }

    //No hace falta validar nada adicional, ya se encuentra validado al crear la sección
    let seccion = document.formularioEdicionRecursos.seccion.value;
    if (seccion == "") {
        window.onload = alerta("Campo Sección vacío");
        document.formularioEdicionRecursos.seccion.focus();
    }

    let fechaFinalizacionAlta = document.formularioEdicionRecursos.fechaFinalizacionAlta.value;
    if (fechaFinalizacionAlta == "") {
        window.onload = alerta("Campo Fecha de Finalización de la Sección vacío");
        document.formularioEdicionRecursos.fechaFinalizacionAlta.focus();
        return false;
    }

    let descripcion = document.formularioEdicionRecursos.Descripcion.value;
    if (descripcion == "") {
        window.onload = alerta("El campo Descripción vacío");
        document.formularioEdicionRecursos.Descripcion.focus();
        return false;
    } else if (descripcion.length > 600) {
        window.onload = alerta("El campo Descripción demasiado extenso");
        document.formularioEdicionRecursos.Descripcion.focus();
        return false;
    }

    let resumen = document.formularioEdicionRecursos.Resumen.value;
    if (resumen == "") {
        window.onload = alerta("El campo Descripción vacío");
        document.formularioEdicionRecursos.Resumen.focus();
        return false;
    } else if (resumen.length > 700) {
        window.onload = alerta("El campo Descripción demasiado extenso");
        document.formularioEdicionRecursos.Resumen.focus();
        return false;
    }
    return true;
}

function validarAltaRecurso() {
    let foto = document.formularioAltaRecurso.seleccionRecurso.value;
    if (foto == "") {
        window.onload = alerta("Foto no Seleccionada");
        document.formularioAltaRecurso.seleccionRecurso.focus();
        return false;
    }

    let nombre = document.formularioAltaRecurso.nombre.value;
    if (nombre == "") {
        window.onload = alerta("Campo nombre vacío");
        document.formularioAltaRecurso.nombre.focus();
        return false;
    } else if (nombre.length > 140) {
        window.onload = alerta("Nombre Demasiado Extenso");
        document.formularioAltaRecurso.nombre.focus();
        return false;
    }

    let seccion = document.formularioAltaRecurso.seccion.value;
    if (seccion == "") {
        window.onload = alerta("Campo Sección vacío");
        document.formularioAltaRecurso.seccion.focus();
        return false;
    }

    let fechaAlta = document.formularioAltaRecurso.fechaDeAlta.value;
    if (fechaAlta == "") {
        window.onload = alerta("Campo Fecha de Alta vacío");
        document.formularioAltaRecurso.fechaDeAlta.focus();
        return false;
    }

    let fechaFinalizacionAlta = document.formularioAltaRecurso.fechaFinalizacionAlta.value;
    if (fechaFinalizacionAlta == "") {
        window.onload = alerta("Campo Fecha de Baja vacío");
        document.formularioAltaRecurso.fechaFinalizacionAlta.focus();
        return false;
    }

    let descripcion = document.formularioAltaRecurso.descripcion.value;
    if (descripcion == "") {
        window.onload = alerta("El campo Descripción vacío");
        document.formularioAltaRecurso.descripcion.focus();
        return false;
    } else if (descripcion.length > 600) {
        window.onload = alerta("El campo Descripción demasiado extenso");
        document.formularioAltaRecurso.descripcion.focus();
        return false;
    }

    let resumen = document.formularioAltaRecurso.resumen.value;
    if (resumen == "") {
        window.onload = alerta("El campo Descripción vacío");
        document.formularioAltaRecurso.resumen.focus();
        return false;
    } else if (resumen.length > 700) {
        window.onload = alerta("El campo Descripción demasiado extenso");
        document.formularioAltaRecurso.resumen.focus();
        return false;
    }
    return true;
}

function validarAltaSeccion() {


    let nombre = document.formularioAltaSeccion.titulo.value;
    if (nombre == "") {
        window.onload = alerta("Campo titulo vacío");
        document.formularioAltaSeccion.titulo.focus();
        return false;
    } else if (nombre.length > 60) {
        window.onload = alerta("Título Demasiado Extenso");
        document.formularioAltaSeccion.titulo.focus();
        return false;
    }



    let fechaAlta = document.formularioAltaSeccion.fechaDeAlta.value;
    if (fechaAlta == "") {
        window.onload = alerta("Campo Fecha de Alta vacío");
        document.formularioAltaSeccion.fechaDeAlta.focus();
        return false;
    }

    let fechaFinalizacionAlta = document.formularioAltaSeccion.fechaFinalizacionAlta.value;
    if (fechaFinalizacionAlta == "") {
        window.onload = alerta("Campo Fecha de Baja vacío");
        document.formularioAltaSeccion.fechaFinalizacionAlta.focus();
        return false;
    }

    let descripcion = document.formularioAltaSeccion.Descripcion.value;
    if (descripcion.length > 400) {
        window.onload = alerta("El campo Descripción demasiado extenso");
        document.formularioAltaSeccion.Descripcion.focus();
        return false;
    }

    return true;
}