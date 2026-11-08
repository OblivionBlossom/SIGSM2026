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

// si viene ?eliminar= con un nombre, se borra ese documento
if (!empty($_GET['eliminar'])) {
    ControladorDocumentos::eliminar($_GET['eliminar']);
}

// Para el menú: si es administrador hay 4 opciones, si no, 3
$esAdmin = isset($_SESSION["cargo"]) && $_SESSION["cargo"] == "Administrador";

// el ancho de cada opción depende de cuántas haya, así quedan repartidas
$columna = "col-4";
if ($esAdmin) {
    $columna = "col-3";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de administracion</title>
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
                    <span class="text-dark fw-bold fs-5">Documentos</span>
                </div>
                <div class="<?php echo $columna; ?>">
                    <a class="btn btn-link text-dark text-decoration-none fw-medium" href="adminEncuestas.php">Encuestas</a>
                </div>
                <?php if ($esAdmin) { ?>
                <!--la opción de alta de usuarios solo aparece para administradores-->
                <div class="<?php echo $columna; ?>">
                    <a class="btn btn-link text-dark text-decoration-none fw-medium" href="formUsuarios.php">Alta de usuarios</a>
                </div>
                <?php } ?>
                <div class="<?php echo $columna; ?> d-flex justify-content-center">
                    <div class="dropdown">
                        <a class="btn btn-light border d-flex align-items-center text-dark text-decoration-none px-3 py-1 rounded dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!--nombre del usuario logueado, escapado por si trae caracteres raros-->
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
<div class="container-fluid">
    <div class="row">
       <div class="col-md-2 bg-white border-end p-3" style="min-height: 100vh;">
            <p class="text-dark fw-bold mb-3">Áreas del hospital:</p>
            <div class="list-group list-group-flush gap-2">
                <?php 
                    // se arma el menú de categorías sacadas de la base
                    include_once 'filtros.php';
                    GestorFiltros::mostrarMenuPastillas();
                ?>
            </div>
        </div>
        <div class="col-md-10 p-4 bg-light">
            <div class="mb-4" style="width: 400px;">
                <div class="input-group flex-nowrap shadow-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" id="buscador" class="form-control border-start-0 bg-white py-2" placeholder="Buscar documentos..." aria-label="Buscar">
                </div>
            </div>
            <?php 
                // acá se muestran siempre las tarjetas con el botón de editar, porque es el panel del admin
                $es_admin = true;
                include 'tarjetas.php';
                TarjetasDocumentos::mostrar($es_admin); 
            ?>
             <!--este aviso lo muestra el js cuando el filtro no encuentra nada-->
             <p id="sinResultados" class="text-muted d-none">No se encontraron documentos.</p>
            <div>
                <a href="formDocumento.php" class="btn text-white fw-bold px-4 py-2 d-inline-flex align-items-center gap-2 text-decoration-none" style="background-color: #6c9bc2;">
                    <i class="bi bi-file-earmark-arrow-up fs-5"></i> Cargar Archivo
                </a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="filtros.js"></script>
</body>
</html>
