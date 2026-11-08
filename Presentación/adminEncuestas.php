<?php
session_start();
include 'controladoresBD.php';

// si viene ?logout=1 se cierra la sesión
if (isset($_GET['logout'])) {
    ControladorFuncionarios::logout();
}

// Si no hay nadie logueado, al login
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

// Para el menú: si es administrador hay 4 opciones, si no, 3
$esAdmin = isset($_SESSION["cargo"]) && $_SESSION["cargo"] == "Administrador";

// el ancho de cada opción depende de cuántas haya, así quedan repartidas
$columna = "col-4";
if ($esAdmin) {
    $columna = "col-3";
}

// si viene ?eliminar= con un id, se borra esa pregunta
if (!empty($_GET['eliminar'])) {
    ControladorPreguntas::eliminar($_GET['eliminar']);
}

// si el formulario se envió: con IDpregunta en la URL es una modificación, sin id es un alta nueva
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_GET['IDpregunta'])) {
        $idOriginal = $_GET['IDpregunta'];
        ControladorPreguntas::modificar($idOriginal);
    } else {
        ControladorPreguntas::insertar();
    }
}

// Inicializar variables en modo crear
$idpregunta = $temas = $orden = $textopregunta = "";
$textoTituloPagina = "Cargar preguntas";
$textoBoton = "Agregar pregunta";
$idOriginal = "";

    // si hay id en la URL se pasa a modo edición
    if (!empty($_GET['IDpregunta'])) {
    $idOriginal = $_GET['IDpregunta'];

    // Cambiamos textos a modo edición
    $textoTituloPagina = "Modificar pregunta";
    $textoBoton = "Guardar cambios";

    // Rellenar inputs con los datos de la base de datos
    include("BD.php");
    $sql = "SELECT IDpregunta, Temas, Orden, Textopregunta FROM preguntas WHERE IDpregunta = ?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bind_param("i", $idOriginal);
    $sentencia->execute();
    // bind_result deja las columnas en esas variables, que después se usan como value de los inputs
    $sentencia->bind_result($idpregunta, $temas, $orden, $textopregunta);
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
    <title>Editar y Cargar Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
 <div class="container-fluid border-bottom p-2" style="background-color: #f8f9fa;">
    <div class="row align-items-center">
        <div class="col-auto ps-3">
            <img src="logoHospi.jpg" alt="Hospital" height="80">
        </div>
        <div class="col p-4">
            <div class="row align-items-center text-center">
                <div class="<?php echo $columna; ?>">
                    <a class="btn btn-link text-dark text-decoration-none fw-medium" href="adminDocumentos.php">Documentos</a>
                </div>
                <div class="<?php echo $columna; ?>">
                    <span class="text-dark fw-bold fs-5">Encuestas</span>
                </div>
                <?php if ($esAdmin) { ?>
                //la opción de alta de usuarios solo aparece para administradores
                <div class="<?php echo $columna; ?>">
                    <a class="btn btn-link text-dark text-decoration-none fw-medium" href="formUsuarios.php">Alta de usuarios</a>
                </div>
                <?php } ?>
                <div class="<?php echo $columna; ?> d-flex justify-content-center">
                    <div class="dropdown">
                        <a class="btn btn-light border d-flex align-items-center text-dark text-decoration-none px-3 py-1 rounded dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fw-bold me-2"><?php echo htmlspecialchars($_SESSION["usuario"]); ?></span>
                            <i class="bi bi-person-circle fs-2 text-dark"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="?logout=1">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container my-5">
        <div class="row g-5">
            <div class="col-md-7">
                <h4 class="fw-bold mb-4" style="font-family: serif;">Editar preguntas:</h4>
                <?php 
                    // listado con las preguntas ya cargadas y sus botones de editar y eliminar
                    include 'Tarjetas.php';
                    TarjetasPreguntasAdmin::mostrar(); 
                ?>
            </div>
            <div class="col-md-5">
                <div class="border p-4 rounded bg-white shadow-sm">
                    //el título y el texto del botón cambian según se esté creando o editando
                    <h4 class="fw-bold mb-4" style="font-family: serif;"><?php echo $textoTituloPagina; ?></h4>
                    <form id="formPreguntas" action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tema</label>
                            <input type="text" id="tema" name="Temas" class="form-control bg-light" value="<?php echo htmlspecialchars($temas); ?>" placeholder="Ej: Satisfaccion">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Orden</label>
                            <input type="number" id="orden" name="Orden" class="form-control bg-light" value="<?php echo $orden; ?>" placeholder="Ej: 1">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pregunta</label>
                            <input type="text" id="textopregunta" name="Textopregunta" class="form-control bg-light" value="<?php echo htmlspecialchars($textopregunta); ?>" placeholder="Escribí la pregunta acá...">
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary text-white fw-bold px-5 py-2 shadow-sm" style="background-color: #9ec5fe; border-color: #9ec5fe;" onmouseover="this.style.backgroundColor='#6ea8fe'; this.style.borderColor='#6ea8fe';" onmouseout="this.style.backgroundColor='#9ec5fe'; this.style.borderColor='#9ec5fe';">
                                <?php echo $textoBoton; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="validaciones.js"></script>
</body>
</html>