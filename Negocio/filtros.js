class Filtro {

    // recorre las tarjetas y muestra solo las que coinciden con el filtro elegido
    static aplicar(selectorTarjetas, atributo, seleccionado) {
        document.querySelectorAll(selectorTarjetas).forEach(function (tarjeta) {
            const valor = tarjeta.getAttribute(atributo);

            // si el filtro es "todos" muestra todo, si no, solo lo que coincide
            if (seleccionado === "todos" || valor === seleccionado) {
                tarjeta.style.display = "block";
            } else {
                tarjeta.style.display = "none";
            }
        });
    }
}

class FiltroDocumentos {

    // filtro actual: por defecto muestra todo y sin texto de búsqueda
    static categoria = "todos";
    static texto = "";

    static iniciar() {
    
          // cada link de categoría cambia el filtro y vuelve a aplicar
        document.querySelectorAll(".categoria-link").forEach(function (enlace) {
            enlace.addEventListener("click", function (e) {
                // evita que el link salte al principio de la página
                e.preventDefault();
                FiltroDocumentos.categoria = this.getAttribute("data-filtro");
                FiltroDocumentos.aplicar();
            });
        });

        
        const buscador = document.getElementById("buscador");
        if (buscador) {
            // filtra a medida que se escribe en el buscador
            buscador.addEventListener("input", function () {
                FiltroDocumentos.texto = FiltroDocumentos.normalizar(this.value);
                FiltroDocumentos.aplicar();
            });
        }
    }

    // pasa el texto a minúsculas y le saca los acentos, así la búsqueda no falla por eso
    static normalizar(texto) {
        return texto.trim().toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }

    static aplicar() {
        // cuenta cuántas tarjetas quedan visibles
        let visibles = 0;

        document.querySelectorAll(".tarjeta-documento").forEach(function (tarjeta) {
            const categoria = tarjeta.getAttribute("data-categoria");
            const nombre = FiltroDocumentos.normalizar(tarjeta.querySelector("h5").textContent);

            // tiene que coincidir la categoría y además el texto buscado
            const coincideCategoria = FiltroDocumentos.categoria === "todos" || categoria === FiltroDocumentos.categoria;
            const coincideTexto = nombre.includes(FiltroDocumentos.texto);

            if (coincideCategoria && coincideTexto) {
                tarjeta.style.display = "";
                visibles++;
            } else {
                tarjeta.style.display = "none";
            }
        });

        const aviso = document.getElementById("sinResultados");
        if (aviso) {
             // el aviso de "sin resultados" se muestra solo si no quedó ninguna tarjeta
            aviso.classList.toggle("d-none", visibles > 0);
        }
    }
}
class FiltroEncuestas {

    static iniciar() {
        const enlaces = document.querySelectorAll(".categoria-link");

        enlaces.forEach(function (enlace) {
            enlace.addEventListener("click", function (e) {
                e.preventDefault();

                // se le quita el "active" a todos los links y se lo pone al clickeado
                enlaces.forEach(function (otro) {
                    otro.classList.remove("active");
                });
                this.classList.add("active");

                Filtro.aplicar(".seccion-tema", "data-tema", this.getAttribute("data-filtro"));
            });
        });

        if (enlaces.length > 0) {
            enlaces[0].click();
        }
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // el filtro de documentos solo se activa si la página tiene tarjetas
    if (document.querySelector(".tarjeta-documento")) {
        FiltroDocumentos.iniciar();
    }
   if (document.querySelector(".seccion-tema")) {
    // el de encuestas solo si hay secciones de tema
    FiltroEncuestas.iniciar();
}
});