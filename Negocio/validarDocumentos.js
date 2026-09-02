document.getElementById("formDocumentos").addEventListener("submit", function(event) {
    const nombreDoc = document.getElementById("nombredocumento").value.trim();
    const departamento = document.getElementById("departamento").value;
    const tipoD = document.getElementById("tipod").value;
    const categoria = document.getElementById("categoria").value;
    const fecha = document.getElementById("fecha").value;
    const email = document.getElementById("email").value;
    const archivo = document.getElementById("formFile").value;

    if (nombreDoc === "") {
        alert("Por favor, ingresa el nombre del documento.");
        event.preventDefault();
        return;
    }
    if (departamento === "" || departamento.includes("Selecciona")) {
        alert("Por favor, selecciona un departamento.");
        event.preventDefault();
        return;
    }
    if (tipoD === "" || tipoD.includes("Estudio-Prevencion")) {
        alert("Por favor, selecciona el tipo de documento.");
        event.preventDefault();
        return;
    }
    if (categoria === "" || categoria.includes("Selecciona")) {
        alert("Por favor, selecciona una categoría.");
        event.preventDefault();
        return;
    }
    if (fecha === "") {
        alert("Por favor, ingresa una fecha.");
        event.preventDefault();
        return;
    }
    if (email.length < 8 || !email.includes('@') || !email.includes('.')) {
        alert('El eMail debe tener al menos 8 caracteres y contener "@" y "."');
        event.preventDefault();
        return;
    }
    if (archivo === "") {
        alert("Por favor, selecciona un archivo PDF.");
        event.preventDefault();
        return;
    } else if (!archivo.toLowerCase().endsWith('.pdf')) {
        alert("El archivo seleccionado debe ser un PDF.");
        event.preventDefault();
        return;
    }
});

window.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('exito') === '1') {
        alert("¡Documento cargado con éxito!");
    }
});
