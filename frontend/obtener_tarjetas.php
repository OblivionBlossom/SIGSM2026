<?php
include 'bd.php';
$sql = "SELECT * FROM documentos";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    if ($es_admin == true) {
        echo '<p class="text-dark fw-bold mb-3">Documentos de cardiologia:</p>';
    }
    while ($fila = $resultado->fetch_assoc()) {
        $nombreDoc  = $fila['Nombredocumento'] ?? '';
        $tipoDoc    = $fila['TipoD'] ?? '';
        $rutaPdf    = $fila['Rutapdf'] ?? '#';
?>
        <div class="card bg-body-secondary border-0 p-3 mb-2" style="max-width: 600px;">
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
                               <a href="eliminarDocumento.php?nombre=<?php echo $nombreDoc; ?>" class="text-danger fs-4" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este documento?');"><i class="bi bi-trash"></i></a>
                                <a href="formularioDocumento.php?nombre=<?php echo $nombreDoc; ?>" class="text-dark fs-4" title="Actualizar"><i class="bi bi-pencil-square"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
    }
} else {
    if ($es_admin == true) {
        echo '<p class="text-dark fw-bold mb-3">No hay documentos de cardiología cargados.</p>';
    }
}
$conexion->close();
?>