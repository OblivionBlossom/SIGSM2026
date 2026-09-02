<?php
include 'CRUD.php';

//Inicializar variables en modo crear
$nombredoc = $fecha = $tipod = $categoria = $depto = $rutapdf = $email = "";
$accionFormulario = "insertarDocumento.php";

//Textos y colores en modo crear
$textoTituloPagina = "Carga de documento";
$textoHeader = "Cargar Documento";
$textoBoton = "Cargar documento";
$color = "bg-info text-white";

//Condicion para saber si es modo editar o crear
if (!empty($_GET['nombre'])) {
    $nombreOriginal = $_GET['nombre'];
    $accionFormulario = "modificar.php?nombre=";

    //Textos y colores en modo editar
    $textoTituloPagina = "Editar Documento";
    $textoHeader = "Editar Documento";
    $textoBoton = "Actualizar documento";
    $color = "bg-warning text-dark"; 

    //Rellenar inputs con los datos de la base
    include("bd.php");
    $sql = "SELECT * FROM documentos WHERE Nombredocumento = ?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bind_param("s", $nombreOriginal);
    $sentencia->execute();
    $sentencia->bind_result($nombredoc, $fecha, $tipod, $categoria, $depto, $rutapdf, $email);
    $sentencia->fetch();    
    $sentencia->close();
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $textoTituloPagina; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-light shadow-sm">
                    <!-- Usamos la variable $color -->
                    <div class="card-header <?php echo $color; ?> p-3">
                       <h5 class="mb-0 fw-bold d-flex align-items-center">
                           <img src="logoHospi.jpg" alt="Hospital" class="me-2" style="height: 24px; width: auto; object-fit: contain;">
                           <?php echo $textoHeader; ?>
                       </h5>
                    </div>
                    <div class="card-body p-4">
                        <form id="formDocumentos" action="<?php echo $accionFormulario; ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label text-dark fw-bold small">Nombre de Documento</label>
                                <input type="text" id="nombredocumento" name="Nombredocumento" class="form-control bg-info-subtle text-muted" value="<?php echo htmlspecialchars($nombredoc); ?>" placeholder="Ej: prostatectomía radical">
                                <label class="form-label text-dark fw-bold small">Departamento (servicio del hospital)</label>
                                <select id="departamento" name="Departamento" class="form-select bg-info-subtle text-muted">
                                    <option selected>Selecciona una categoría</option>
                                    <option value="1" class="bg-white text-dark">Opcion1</option>
                                    <option value="2" class="bg-white text-dark">Opcion2</option>
                                </select>    
                                <label class="form-label text-dark fw-bold small">Tipo de documento</label>
                                <select id="tipod" name="TipoD" class="form-select bg-info-subtle text-muted">
                                    <option selected>Estudio-Prevencion</option>
                                    <option value="Estudio" class="bg-white text-dark">Estudio</option>
                                    <option value="Prevencion" class="bg-white text-dark">Prevencion</option>
                                </select>  
                                <label class="form-label text-dark fw-bold small">Categoría</label>
                                <select id="categoria" name="Categoria" class="form-select bg-info-subtle text-muted">
                                    <option selected>Selecciona una categoría</option>
                                    <option value="Cirugia" class="bg-white text-dark">Cirugía</option>
                                    <option value="Diagnostico" class="bg-white text-dark">Diagnóstico</option>
                                    <option value="Protocolo" class="bg-white text-dark">Protocolo</option>
                                </select>
                                <label class="form-label text-dark fw-bold small">Fecha</label>
                                <input type="date" id="fecha" name="Fecha" class="form-control bg-info-subtle text-muted" value="<?php echo htmlspecialchars($fecha); ?>">
                                <label class="form-label text-dark fw-bold small">Email de departamento</label>
                                <input type="email" id="email" name="Email" class="form-control bg-info-subtle text-muted" value="<?php echo htmlspecialchars($email); ?>" placeholder="departamento@hc.edu.uy">            
                                <label for="formFile" class="form-label text-dark fw-bold small">Archivo PDF</label>
                                <input class="form-control bg-info-subtle text-muted" type="file" id="formFile" name="Rutapdf">            
                                <div class="d-grid col-6 mx-auto  mt-4">                                
                                    <button type="submit" class="btn <?php echo $color; ?> fw-bold p-2">
                                        <?php echo $textoBoton; ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="validarDocumentos.js"></script>
</body>
</html>