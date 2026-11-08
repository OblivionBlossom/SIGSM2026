class Validador {

     // muestra el mensaje y frena el envío del formulario
    static error(event, mensaje) {
        alert(mensaje);
        event.preventDefault();
    }

    // lee el ?exito=1 de la URL y avisa que salió bien
    static avisoExito(mensaje) {
        const params = new URLSearchParams(window.location.search);
        if (params.get("exito") === "1") {
            alert(mensaje);
        }
    }
}

class ValidarDocumentos {

    static validar(event) {
        const nombreDoc = document.getElementById("nombredocumento").value.trim();
        const departamento = document.getElementById("departamento").value;
        const tipoD = document.getElementById("tipod").value;
        const categoria = document.getElementById("categoria").value;
        const fecha = document.getElementById("fecha").value;
        const email = document.getElementById("email").value;
        const archivo = document.getElementById("formFile").value;

        // el campo de ruta actual solo existe al modificar, así se sabe si ya tenía un pdf
        const campoRuta = document.getElementById("rutaActual");
        const rutaActual = campoRuta ? campoRuta.value : "";

        if (nombreDoc === "") {
            return Validador.error(event, "Por favor, ingresa el nombre del documento.");
        }
        if (departamento === "") {
            return Validador.error(event, "Por favor, ingresa un departamento.");
        }
        if (tipoD === "") {
            return Validador.error(event, "Por favor, ingresa el tipo de documento.");
        }
        if (categoria === "") {
            return Validador.error(event, "Por favor, ingresa una categoría.");
        }
        if (fecha === "") {
            return Validador.error(event, "Por favor, ingresa una fecha.");
        }
        // control básico del mail: largo mínimo y que tenga arroba y punto
        if (email.length < 8 || !email.includes("@") || !email.includes(".")) {
            return Validador.error(event, 'El eMail debe tener al menos 8 caracteres y contener "@" y ".".');
        }
          // si no eligió archivo nuevo pero ya había uno guardado, se permite
        if (archivo === "" && rutaActual === "") {
            return Validador.error(event, "Por favor, selecciona un archivo PDF.");
        }
        if (archivo !== "" && !archivo.toLowerCase().endsWith(".pdf")) {
            return Validador.error(event, "El archivo seleccionado debe ser un PDF.");
        }
    }
}

class ValidarEncuestas {

    static validar(event) {
        const tema = document.getElementById("tema").value.trim();
        const orden = document.getElementById("orden").value.trim();
        const textoPregunta = document.getElementById("textopregunta").value.trim();

        if (tema === "") {
            return Validador.error(event, "Por favor, ingresa un tema.");
        }
        // isNaN rechaza cualquier cosa que no sea un número
        if (orden === "" || isNaN(orden)) {
            return Validador.error(event, "Por favor, ingresa un número de orden válido.");
        }
        if (textoPregunta === "") {
            return Validador.error(event, "Por favor, escribe el texto de la pregunta.");
        }
    }
}

class ValidarUsuarios {

    static validar(event) {
        const ci = document.getElementById("ci").value.trim();
        const nombre = document.getElementById("nombre").value.trim();
        const usuario = document.getElementById("usuario").value.trim();
        const pass = document.getElementById("pass").value;
        const cargo = document.getElementById("cargo").value.trim();

        if (ci === "") {
            return Validador.error(event, "Por favor, ingresa la cédula.");
        }
        // la cédula solo admite números y hasta 9 dígitos
        if (!/^[0-9]+$/.test(ci) || ci.length > 9) {
            return Validador.error(event, "La cédula debe tener solo números (hasta 9 dígitos).");
        }
        if (nombre === "") {
            return Validador.error(event, "Por favor, ingresa el nombre.");
        }
        if (usuario === "") {
            return Validador.error(event, "Por favor, ingresa el usuario.");
        }
        if (pass === "") {
            return Validador.error(event, "Por favor, ingresa la contraseña.");
        }
        if (pass.length < 6) {
            return Validador.error(event, "La contraseña debe tener al menos 6 caracteres.");
        }
        if (cargo === "") {
            return Validador.error(event, "Por favor, ingresa el cargo.");
        }
    }

    static mostrarError() {
        const params = new URLSearchParams(window.location.search);
        // el error 2 lo devuelve el insertar cuando la cédula ya está en uso
        if (params.get("error") === "2") {
            alert("Ya existe un usuario con esa cédula.");
        }
    }
}

class ValidarLogin {

    static mostrarError() {
        const params = new URLSearchParams(window.location.search);
        // el error 1 lo devuelve validarLogin cuando el usuario o la clave no coinciden
        if (params.get("error") === "1") {
            alert("El usuario o la contraseña no existen.");
        }
    }
}

class ValidarRespuestas {

    static validar(event) {
        const secciones = document.querySelectorAll("#formRespuestas .seccion-tema");

        // se busca la sección visible, que es el tema que el usuario está respondiendo
        const visible = Array.from(secciones).find(function (s) {
            return s.style.display !== "none";
        });

        if (!visible) {
            return Validador.error(event, "No hay preguntas para enviar.");
        }

        const inputs = visible.querySelectorAll(".input-valor");
        for (const input of inputs) {
            if (input.value === "") {
                 // lleva al usuario hasta la tarjeta que le falta responder
                input.closest(".card").scrollIntoView({ behavior: "smooth", block: "center" });
                return Validador.error(event, "Por favor, responde todas las preguntas de este tema antes de enviar.");
            }
        }

        // las secciones de otros temas se desactivan, así solo se envían las respuestas del tema visible
        secciones.forEach(function (s) {
            if (s !== visible) {
                s.querySelectorAll(".input-valor").forEach(function (input) {
                    input.disabled = true;
                });
            }
        });
    }
}

window.addEventListener("DOMContentLoaded", function () {

    // cada formulario se valida solo si existe en la página
    const formDocumentos = document.getElementById("formDocumentos");
    if (formDocumentos) {
        formDocumentos.addEventListener("submit", ValidarDocumentos.validar);
        Validador.avisoExito("¡Documento cargado con éxito!");
    }

    const formPreguntas = document.getElementById("formPreguntas");
    if (formPreguntas) {
        formPreguntas.addEventListener("submit", ValidarEncuestas.validar);
        Validador.avisoExito("¡Pregunta cargada con éxito!");
    }

    const formUsuarios = document.getElementById("formUsuarios");
    if (formUsuarios) {
        formUsuarios.addEventListener("submit", ValidarUsuarios.validar);
        Validador.avisoExito("¡Usuario creado con éxito!");
        ValidarUsuarios.mostrarError();
    }

    if (document.getElementById("formLogin")) {
        ValidarLogin.mostrarError();
    }

    const formRespuestas = document.getElementById("formRespuestas");
    if (formRespuestas) {
        formRespuestas.addEventListener("submit", ValidarRespuestas.validar);
        Validador.avisoExito("¡Gracias por responder la encuesta!");
    }
});