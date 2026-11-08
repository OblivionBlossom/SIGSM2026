<?php
session_start();

// si no hay nadie logueado, al login
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

include 'controladoresBD.php';
include_once 'filtros.php';

// si se envió el formulario: con nombre en la URL es una modificación, sin nombre es un alta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_GET['nombre'])) {
        $nombreOriginal = $_GET['nombre'];
        ControladorDocumentos::modificar($nombreOriginal);
    } else {
        ControladorDocumentos::insertar();
    }
}

// valores por defecto, modo alta
$nombredoc = $fecha = $tipod = $categoria = $depto = $rutapdf = $email = "";
$textoTituloPagina = "Carga de documento";
$textoHeader = "Cargar Documento";
$textoBoton = "Cargar documento";
$color = "bg-info text-white";
$colorCancelar = "btn-outline-info";
$nombreOriginal = "";

// si hay nombre en la URL se pasa a modo edición
if (!empty($_GET['nombre'])) {
    $nombreOriginal = $_GET['nombre'];

    // cambian los textos y los colores para que se note que se está editando
    $textoTituloPagina = "Editar Documento";
    $textoHeader = "Editar Documento";
    $textoBoton = "Actualizar documento";
    $color = "bg-warning text-dark"; 
    $colorCancelar = "btn-outline-warning";

    // se buscan los datos del documento y se precargan los campos
    include("BD.php");
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
                    //Usamos la variable $color 
                    <div class="card-header <?php echo $color; ?> p-3">
                         <h5 class="mb-0 fw-bold d-flex align-items-center">
                            <img src="logoHospi.jpg" alt="Hospital" class="me-2" style="height: 24px; width: auto; object-fit: contain;">
                            <?php echo $textoHeader; ?>
                         </h5>
                    </div>
                    <div class="card-body p-4">
                        //el enctype es obligatorio para que el pdf se pueda subir
                        <form id="formDocumentos" action="" method="POST" enctype="multipart/form-data">
                            //guarda la ruta del pdf actual, así al modificar sin subir otro no se pierde
                            <input type="hidden" name="rutaActual" value="<?php echo htmlspecialchars($rutapdf); ?>">
                            <div class="mb-3">
                                <label class="form-label text-dark fw-bold small">Nombre de Documento</label>
                                <input type="text" id="nombredocumento" name="Nombredocumento" class="form-control bg-info-subtle text-muted" value="<?php echo htmlspecialchars($nombredoc); ?>" placeholder="Ej: prostatectomía radical">
                                <label class="form-label text-dark fw-bold small">Departamento (servicio del hospital)</label>
                                <input type="text" id="departamento" name="Departamento" list="listaDepartamentos" maxlength="20" autocomplete="off" class="form-control bg-info-subtle text-muted" value="<?php echo htmlspecialchars($depto); ?>" placeholder="Escribí o elegí un departamento">
                                <?php GestorOpciones::datalist('Departamento', 'listaDepartamentos'); ?>
                                <label class="form-label text-dark fw-bold small">Tipo de documento</label>
                                <input type="text" id="tipod" name="TipoD" list="listaTipos" maxlength="20" autocomplete="off" class="form-control bg-info-subtle text-muted" value="<?php echo htmlspecialchars($tipod); ?>" placeholder="Escribí o elegí un tipo">
                                <?php GestorOpciones::datalist('TipoD', 'listaTipos'); ?>
                                <label class="form-label text-dark fw-bold small">Categoría</label>
                                <input type="text" id="categoria" name="Categoria" list="listaCategorias" maxlength="20" autocomplete="off" class="form-control bg-info-subtle text-muted" value="<?php echo htmlspecialchars($categoria); ?>" placeholder="Escribí o elegí una categoría">
                                <?php GestorOpciones::datalist('Categoria', 'listaCategorias'); ?>
                                <label class="form-label text-dark fw-bold small">Fecha</label>
                                <input type="date" id="fecha" name="Fecha" class="form-control bg-info-subtle text-muted" value="<?php echo htmlspecialchars($fecha); ?>">
                                <label class="form-label text-dark fw-bold small">Email de departamento</label>
                                <input type="email" id="email" name="Email" class="form-control bg-info-subtle text-muted" value="<?php echo htmlspecialchars($email); ?>" placeholder="departamento@hc.edu.uy">            
                                <label for="formFile" class="form-label text-dark fw-bold small">Archivo PDF</label>
                                <input class="form-control bg-info-subtle text-muted" type="file" id="formFile" name="Rutapdf">            
                                <div class="d-flex gap-3 col-8 mx-auto mt-4">
                                    <button type="submit" class="btn <?php echo $color; ?> fw-bold p-2 flex-fill">
                                        <?php echo $textoBoton; ?>
                                    </button>
                                    <a href="adminDocumentos.php" class="btn <?php echo $colorCancelar; ?> fw-bold p-2 flex-fill">
                                        Cancelar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <script src="validaciones.js"></script>
</body>
</html>