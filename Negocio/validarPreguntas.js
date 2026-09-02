document.getElementById("formPreguntas").addEventListener("submit", function(event) {
    const idPregunta = document.getElementById("idpregunta").value.trim();
    const tema = document.getElementById("tema").value.trim();
    const orden = document.getElementById("orden").value.trim();
    const tipo = document.getElementById("tipo").value.trim();
    const textoPregunta = document.getElementById("textopregunta").value.trim();

    if (idPregunta === "" || isNaN(idPregunta)) {
        alert("Por favor, ingresa un ID de pregunta válido.");
        event.preventDefault();
        return;
    }
    if (tema === "") {
        alert("Por favor, ingresa un tema.");
        event.preventDefault();
        return;
    }
    if (orden === "" || isNaN(orden)) {
        alert("Por favor, ingresa un número de orden válido.");
        event.preventDefault();
        return;
    }
    if (tipo === "") {
        alert("Por favor, ingresa el tipo de pregunta.");
        event.preventDefault();
        return;
    }
    if (textoPregunta === "") {
        alert("Por favor, escribe el texto de la pregunta.");
        event.preventDefault();
        return;
    }
});

window.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('exito') === '1') {
        alert("¡Pregunta cargada con éxito!");
    }
});