<?php
class GestorFiltros {

    public static function mostrarMenuSutil() {
        self::mostrarMenuBase('text-secondary text-decoration-none py-2 bg-transparent');
    }

    public static function mostrarMenuPastillas() {
        self::mostrarMenuBase('bg-info-subtle text-dark border-0 p-2 text-center fw-bold');
    }

    private static function mostrarMenuBase($clasesCss) {
        include("BD.php");
        
         // primer ítem fijo, muestra todos los documentos sin filtrar
        echo '<a href="#" class="list-group-item list-group-item-action border-0 ' . $clasesCss . ' categoria-link" data-filtro="todos">Todos</a>';

         // se traen las categorías sin repetir, salteando las vacías
        $sqlCat = "SELECT DISTINCT Categoria FROM documentos WHERE Categoria IS NOT NULL AND Categoria != '' ORDER BY Categoria ASC";
        $resultadoCat = $conexion->query($sqlCat);

        if ($resultadoCat && $resultadoCat->num_rows > 0) {
            while ($filaCat = $resultadoCat->fetch_assoc()) {

                // se escapan los caracteres especiales por si la categoría trae comillas o <>
                $nombreCategoria = htmlspecialchars($filaCat['Categoria']);
                // un link por cada categoría, con la categoría como valor del filtro
                echo '<a href="#" class="list-group-item list-group-item-action border-0 ' . $clasesCss . ' categoria-link" data-filtro="' . $nombreCategoria . '">' . $nombreCategoria . '</a>';
            }
        }
        $conexion->close();
    }
}

class GestorFiltrosEncuestas {

    public static function MenuUsuarios() {
        include("BD.php");

        $clasesCss = 'text-secondary text-decoration-none py-2 bg-transparent';

        $sql = "SELECT DISTINCT Temas FROM preguntas WHERE Temas IS NOT NULL AND Temas != '' ORDER BY Temas ASC";
        $resultado = $conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $tema = htmlspecialchars($fila['Temas']);
                echo '<a href="#" class="list-group-item list-group-item-action border-0 ' . $clasesCss . ' categoria-link" data-filtro="' . $tema . '">' . $tema . '</a>';
            }
        } else {
             // si no hay temas cargados se muestra un aviso en lugar del menú
            echo '<p class="text-muted ps-2">No hay preguntas cargadas en este momento.</p>';
        }

        $conexion->close();
    }
}

class GestorOpciones {

    public static function datalist($columna, $idLista) {
          
        // solo se aceptan estas tres columnas
        $permitidas = ["Departamento", "TipoD", "Categoria"];
        if (!in_array($columna, $permitidas)) {
            return;
        }

        include("BD.php");

        $sql = "SELECT DISTINCT $columna FROM documentos WHERE $columna != '' ORDER BY $columna ASC";
        $resultado = $conexion->query($sql);

        // se arma el datalist con una opción por cada valor encontrado
        echo '<datalist id="' . $idLista . '">';
        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                echo '<option value="' . htmlspecialchars($fila[$columna]) . '">';
            }
        }
        echo '</datalist>';

        $conexion->close();
    }
}
?>