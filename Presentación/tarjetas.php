<?php
class TarjetasDocumentos {

    // $es_admin decide si las tarjetas llevan los botones de editar y eliminar
    public static function mostrar($es_admin = false) {
        include 'BD.php';
        $sql = "SELECT * FROM documentos";
        $resultado = $conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $nombreDoc  = $fila['Nombredocumento'] ?? '';
                $tipoDoc    = $fila['TipoD'] ?? '';
                $rutaPdf    = $fila['Rutapdf'] ?? '#';
                $categoria  = $fila['Categoria'] ?? '';
?>
            
                //data-categoria es lo que lee el js para filtrar, y el h5 es el texto que usa el buscador 
                <div class="card bg-body-secondary border-0 p-3 mb-2 tarjeta-documento" data-categoria="<?php echo htmlspecialchars($categoria); ?>" style="max-width: 600px;">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-file-earmark fs-1 me-3 text-dark"></i>
                        <div class="w-100">
                            <a href="<?php echo $rutaPdf; ?>" target="_blank" class="text-decoration-none">
                                <h5 class="fw-bold text-dark mb-2"><?php echo $nombreDoc; ?></h5>
                            </a>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="small fw-bold" style="color: #4682B4;"><?php echo $tipoDoc; ?></span>
                                <div class="d-flex gap-3">
                                    <?php if ($es_admin == true) { ?>
                                        //urlencode porque el nombre puede tener espacios o acentos
                                        <a href="?eliminar=<?php echo urlencode($nombreDoc); ?>" class="text-danger fs-4" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este documento?');">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                         <a href="formDocumento.php?nombre=<?php echo $nombreDoc; ?>" class="text-dark fs-4" title="Actualizar"><i class="bi bi-pencil-square"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php 
            }
        } else {
            echo '<p class="text-muted">No hay documentos cargados.</p>';
        }
        $conexion->close();
    }
}

class TarjetasPreguntasAdmin {

    public static function mostrar() {
        include 'BD.php';

        // se ordena por tema y después por número de orden, así salen agrupadas
        $sql = "SELECT * FROM preguntas ORDER BY Temas, Orden ASC";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $temaActual = "";
            $esPrimero = true;
            
            while ($fila = $resultado->fetch_assoc()) {
                $idPregunta = $fila['IDpregunta'] ?? 0;
                $tema       = $fila['Temas'] ?? '';
                $orden      = $fila['Orden'] ?? '';
                $textoPreg  = $fila['Textopregunta'] ?? '';

                // cuando cambia el tema se imprime el título del grupo una sola vez
                if ($temaActual !== $tema) {
                    $temaActual = $tema;
                    // el margen es distinto para el primer grupo, así no queda aire de más arriba
                    $claseMargen = $esPrimero ? "mb-3" : "mt-4 mb-3";
                    $esPrimero = false;
                    echo '<h6 class="fw-bold text-dark ' . $claseMargen . '">Preguntas de ' . htmlspecialchars($tema) . '</h6>';
                }
?>
                <div class="card bg-light border-0 p-2 mb-2 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small fw-bold"><?php echo $orden; ?> | <?php echo htmlspecialchars($textoPreg); ?></span>
                        <div class="d-flex gap-3 fs-5">
                           <a href="adminEncuestas.php?IDpregunta=<?php echo $idPregunta; ?>" class="text-dark" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="adminEncuestas.php?eliminar=<?php echo $idPregunta; ?>" class="text-dark" onclick="return confirm('¿Estás seguro de eliminar esta pregunta?');" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
<?php 
            }
        } else {
            echo '<p class="text-dark fw-bold mb-3">No hay preguntas cargadas en el sistema.</p>';
        }
         $conexion->close();
    }
}

class TarjetasPreguntasUsu {
    public static function mostrar() {
        include("BD.php");

        $sql = "SELECT IDpregunta, Temas, Orden, Textopregunta FROM preguntas ORDER BY Temas, Orden ASC";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $temaActual = "";
            $esPrimero = true;

            while ($fila = $resultado->fetch_assoc()) {
                $idPregunta = $fila['IDpregunta'];
                $tema = $fila['Temas'];
                $textoPregunta = $fila['Textopregunta'];

                // al cambiar de tema se cierra el div anterior y se abre uno nuevo con data-tema
                if ($temaActual !== $tema) {
                     // el primero no tiene div previo que cerrar
                    if (!$esPrimero) {
                        echo '</div>';
                    }
                    $temaActual = $tema;
                    $esPrimero = false;

                    echo '<div class="seccion-tema" data-tema="' . htmlspecialchars($tema) . '">';
                    echo '<h3 class="fw-bold text-center mb-4" style="font-family: serif;">Encuestas de ' . htmlspecialchars($tema) . ':</h3>';
                }
                ?>

                <div class="card bg-light border-0 p-4 mb-4 shadow-sm text-center" data-id-pregunta="<?php echo $idPregunta; ?>">
                    <p class="fw-bold mb-3 small"><?php echo htmlspecialchars($textoPregunta); ?></p>

                    <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
                        <span class="small text-muted text-end" style="width: 110px;">En desacuerdo</span>

                        //cada estrella tiene su valor, y estrellas.js lo guarda en el input de abajo
                        <div class="d-flex gap-3 fs-2 text-warning contenedor-estrellas">
                            <i class="bi bi-star cursor-pointer estrella" data-valor="1"></i>
                            <i class="bi bi-star cursor-pointer estrella" data-valor="2"></i>
                            <i class="bi bi-star cursor-pointer estrella" data-valor="3"></i>
                            <i class="bi bi-star cursor-pointer estrella" data-valor="4"></i>
                            <i class="bi bi-star cursor-pointer estrella" data-valor="5"></i>
                        </div>

                        <span class="small text-muted text-start" style="width: 110px;">De acuerdo</span>
                    </div>

                    //el nombre del input arma el array respuesta[idPregunta] que lee el controlador
                    <input type="hidden" name="respuesta[<?php echo $idPregunta; ?>]" class="input-valor" value="">
                </div>

                <?php
            }
            // cierre del último div de tema
            echo '</div>';
        } else {
            echo '<p class="text-center text-muted">No hay preguntas cargadas en este momento.</p>';
        }

        $conexion->close();
    }
}
?>