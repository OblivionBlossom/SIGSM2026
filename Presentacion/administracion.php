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
            <div class="col d-flex align-items-center justify-content-evenly p-4">
                <div class="dropdown">
                    <button class="btn btn-link text-dark text-decoration-none dropdown-toggle fw-medium" type="button" data-bs-toggle="dropdown" aria-expanded="false">Principal</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.html">Volver a pagina Principal</a></li>
                    </ul>
                </div>
                <span class="text-dark fw-bold fs-5">Documentos</span>
                <div class="dropdown">
                    <button class="btn btn-link text-dark text-decoration-none dropdown-toggle fw-medium" type="button" data-bs-toggle="dropdown" aria-expanded="false">Encuestas</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="editarPreguntas.html">Editar encuesta</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="btn btn-light border d-flex align-items-center text-dark text-decoration-none px-3 py-1 rounded dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fw-bold me-2">USUARIO_1</span>
                        <i class="bi bi-person-circle fs-2 text-dark"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-white border-end p-3" style="min-height: 100vh;">
                <p class="text-dark fw-bold mb-3">Áreas del hospital:</p>
                <div class="list-group list-group-flush gap-2">
                    <a href="#" class="list-group-item list-group-item-action bg-info-subtle text-dark border-0 p-2 text-center fw-bold"> Cardiologia</a>
                    <a href="#" class="list-group-item list-group-item-action bg-info-subtle text-dark border-0 p-2 text-center fw-bold">pediatria:</a>
                    <a href="#" class="list-group-item list-group-item-action bg-info-subtle text-dark border-0 p-2 text-center fw-bold">Opción 3</a>
                    <a href="#" class="list-group-item list-group-item-action bg-info-subtle text-dark border-0 p-2 text-center fw-bold">Opción 4</a>
                    <a href="#" class="list-group-item list-group-item-action bg-info-subtle text-dark border-0 p-2 text-center fw-bold">Opción 5</a>
                    <a href="#" class="list-group-item list-group-item-action bg-info-subtle text-dark border-0 p-2 text-center fw-bold mt-5">encuesta</a>
                </div>
            </div>
            <div class="col-md-10 p-4 bg-light">
                <div class="mb-4" style="width: 400px;">
                    <div class="input-group flex-nowrap shadow-sm">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control border-start-0 bg-white" placeholder="Buscar documento :" aria-label="Buscar">
                    </div>
                </div>
               <?php 
                    $es_admin = true;
                    include 'obtener_tarjetas.php'; 
                ?>
                <div>
                    <a href="formularioDocumento.php" class="btn text-white fw-bold px-4 py-2 d-inline-flex align-items-center gap-2 text-decoration-none" style="background-color: #6c9bc2;">
                        <i class="bi bi-file-earmark-arrow-up fs-5"></i> Cargar Archivo
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>