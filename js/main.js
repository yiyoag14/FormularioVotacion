/**
 * Valida que el campo nombre no esté vacío.
 * @param {HTMLElement} nombre - El elemento input del nombre.
 * @returns {boolean} - Retorna true si es válido, de lo contrario false.
 */
function validarNombre(nombre) {
    var esValido = nombre.value.trim() !== "";
    if (!esValido) {
        mostrarMensajeError(nombre, "El campo 'Nombre y Apellido' es obligatorio.");
    } else {
        mostrarMensajeExito(nombre, "Nombre válido.");
    }
    return esValido;
}

/**
 * Valida que el alias cumpla con un formato específico (al menos 6 caracteres, incluyendo letras y números).
 * @param {HTMLElement} alias - El elemento input del alias.
 * @returns {boolean} - Retorna true si es válido, de lo contrario false.
 */
function validarAlias(alias) {
    const regex = /^(?=.*[0-9])(?=.*[a-zA-Z]).{6,}$/;
    const esValido = regex.test(alias.value);

    if (esValido) {
        mostrarMensajeExito(alias, "Alias válido.");
    } else {
        mostrarMensajeError(alias, "El alias debe contener al menos 6 caracteres, incluyendo letras y números.");
    }
    return esValido;
}

/**
 * Valida que el RUT (Registro Único Tributario) ingresado sea chileno.
 * @param {HTMLElement} rut - El elemento input del RUT.
 * @returns {boolean} - Retorna true si es válido, de lo contrario false.
 */
function validarRUT(rut) {
    var valor = rut.value.replace('.', '').replace('-', ''); 
    var cuerpo = valor.slice(0, -1);
    var dv = valor.slice(-1).toUpperCase();
    var suma = 0;
    var multiplo = 2;
    var dvEsperado;

    rut.value = cuerpo + '-' + dv;  

    if(cuerpo.length < 7) { 
        mostrarMensajeError(rut, "RUT Incompleto.");
        return false;
    }

    for(let i=1; i <= cuerpo.length; i++) {
        let index = multiplo * valor.charAt(cuerpo.length - i);
        suma += index;
        multiplo = (multiplo < 7) ? multiplo + 1 : 2;
    }

    dvEsperado = 11 - (suma % 11);
    dv = (dv === 'K') ? 10 : parseInt(dv);
    dv = (dv === 0) ? 11 : dv;

    if(dvEsperado !== dv) { 
        mostrarMensajeError(rut, "RUT Inválido.");
        return false;
    } else {
        mostrarMensajeExito(rut, "RUT Válido.");
        return true;
    }
}

/**
 * Valida que el email cumpla con un formato de correo electrónico estándar.
 * @param {HTMLElement} email - El elemento input del email.
 * @returns {boolean} - Retorna true si es válido, de lo contrario false.
 */
function validarEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const esValido = regex.test(email.value);

    if (esValido) {
        mostrarMensajeExito(email, "Email válido.");
    } else {
        mostrarMensajeError(email, "Email no válido.");
    }
    return esValido;
}

/**
 * Valida que se hayan seleccionado al menos dos checkboxes.
 * @returns {boolean} - Retorna true si la validación es exitosa, de lo contrario false.
 */
function validarCheckbox() {
    const checkboxes = document.querySelectorAll('input[name="entero[]"]:checked');
    
    if (checkboxes.length < 2) {
        mostrarMensajeError({ id: 'entero' }, "Debes seleccionar al menos dos opciones.");
        return false;
    } else {
        mostrarMensajeExito({ id: 'entero' }, "Selección válida.");
        return true;
    }
}

/**
 * Muestra un mensaje de error asociado a un input.
 * @param {HTMLElement} input - El elemento input donde ocurrió el error.
 * @param {string} message - El mensaje de error a mostrar.
 */
function mostrarMensajeError(input, message) {
    const errorMessage = document.getElementById(input.id + "Error");
    errorMessage.textContent = message;
    errorMessage.style.color = "red";
}

/**
 * Muestra un mensaje de éxito asociado a un input.
 * @param {HTMLElement} input - El elemento input donde se validó correctamente.
 * @param {string} message - El mensaje de éxito a mostrar.
 */
function mostrarMensajeExito(input, message) {
    const successMessage = document.getElementById(input.id + "Error");
    successMessage.textContent = message;
    successMessage.style.color = "green";
}
