// pinta tantas estrellas llenas como el valor recibido y deja el resto vacías
function pintarEstrellas(contenedor, valor) {
    const estrellas = contenedor.querySelectorAll(".estrella");
    estrellas.forEach((s, index) => {
        if (index < valor) {
            s.classList.remove("bi-star");
            s.classList.add("bi-star-fill");
        } else {
            s.classList.remove("bi-star-fill");
            s.classList.add("bi-star");
        }
    });
}

document.addEventListener("mouseover", function (e) {
    const estrella = e.target.closest(".estrella");
    if (!estrella) return;
    const contenedor = estrella.closest(".contenedor-estrellas");
    if (!contenedor) return;

    // al pasar el mouse se previsualiza la valoración hasta esa estrella
    const valorHover = parseInt(estrella.getAttribute("data-valor"));
    pintarEstrellas(contenedor, valorHover);
});

document.addEventListener("mouseout", function (e) {
    const contenedor = e.target.closest(".contenedor-estrellas");
    if (!contenedor) return;
     // si el mouse sigue dentro del mismo contenedor no se repinta, así no parpadea
    if (e.relatedTarget && contenedor.contains(e.relatedTarget)) return;

    const tarjeta = contenedor.closest(".card");
    const inputValor = tarjeta.querySelector(".input-valor");
    // al salir se vuelve a mostrar el valor que estaba guardado
    const valorSeleccionado = parseInt(inputValor.value) || 0;
    
    pintarEstrellas(contenedor, valorSeleccionado);
});

document.addEventListener("click", function (e) {
    const estrella = e.target.closest(".estrella");
    if (!estrella) return;
    const contenedor = estrella.closest(".contenedor-estrellas");
    if (!contenedor) return;

    const tarjeta = contenedor.closest(".card");
    const valorSeleccionado = parseInt(estrella.getAttribute("data-valor"));
    
     // el valor elegido queda guardado en el input oculto, que es lo que se manda al enviar
    const inputValor = tarjeta.querySelector(".input-valor");
    if (inputValor) inputValor.value = valorSeleccionado;

    pintarEstrellas(contenedor, valorSeleccionado);
});