<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vista de documento</title>
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
                <a class="btn btn-link text-dark text-decoration-none fw-medium" href="https://www.hc.edu.uy/home" target="_blank">General</a>
                <span class="text-dark fw-bold fs-5">Documentos</span>
                <a class="btn btn-link text-dark text-decoration-none fw-medium" href="encuestas.php">Encuestas</a>
                <a class="btn btn-link text-dark text-decoration-none fw-medium" href="login.php">Acceso</a>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 mb-4">
        <img src="documentosFt.jpeg" alt="Centro de documentos y encuestas" class="w-100" style="height: 400px; object-fit: cover;">
    </div>
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" id="buscador" class="form-control border-start-0 bg-white py-2" placeholder="Buscar documentos..." aria-label="Buscar">
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-3 mb-4">
                <h6 class="fw-bold text-secondary mb-3 text-uppercase fs-6 ps-2">Categorías</h6>
                <div class="list-group list-group-flush">
                    <?php 
                        // menú de categorías sacadas de la base, en su versión para la vista pública
                        include_once 'filtros.php';
                        GestorFiltros::mostrarMenuSutil();
                    ?>
                </div>
            </div>
            <div class="col-md-9">
                <?php 
                    // acá va false porque es la vista pública: las tarjetas salen sin botones de editar ni eliminar
                    $es_admin = false;
                    include_once 'tarjetas.php';
                    TarjetasDocumentos::mostrar($es_admin); 
                ?>
                 //este aviso lo muestra el js cuando el filtro no encuentra nada
                <p id="sinResultados" class="text-muted d-none">No se encontraron documentos.</p>
            </div>
        </div>
    </div>
   <footer class="p-5 bg-light border-top">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center gap-2">
                    <i class="bi bi-telephone-fill fs-3 text-dark"></i>
                    <h3 class="fw-bold m-0 fs-4">Información de contacto:</h3>
                </div>
            </div>
            <div class="row g-4 mb-4">
                <div class="col-md-6 d-flex flex-column gap-4">
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-geo-alt-fill fs-4 text-dark mt-1"></i>
                        <div>
                            <h6 class="fw-bold mb-1">UBICACION:</h6>
                            <p class="mb-0 text-secondary">
                                Hospital de Clínicas "Dr. Manuel Quintela"<br>
                                Av. Italia s/n<br>
                                Montevideo, Uruguay - CP 11600</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-telephone-fill fs-4 text-dark mt-1"></i>
                        <div>
                            <h6 class="fw-bold mb-1">TELEFONO:</h6>
                            <p class="mb-0 text-secondary">
                                Central Telefónica: 1953<br>
                                Agenda y Atención al Usuario: 0800 1953</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex flex-column gap-4">
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-envelope-fill fs-4 text-dark mt-1"></i>
                        <div>
                            <h6 class="fw-bold mb-1">EMAIL GENERAL:</h6>
                            <p class="mb-0 text-secondary">atencionalusuario@hc.edu.uy</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-envelope-fill fs-4 text-dark mt-1"></i>
                        <div>
                            <h6 class="fw-bold mb-1">GMAIL DEL DEPARTAMENTO:</h6>
                            <p class="mb-0 text-secondary">gmail departamento</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end align-items-center gap-3">
                    <a href="https://www.instagram.com/hclinicasuy" target="_blank" class="text-dark fs-4 text-decoration-none">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/user/CETECIHCURUGUAY" target="_blank" class="text-dark fs-4 text-decoration-none">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="https://x.com/hcmquintela" target="_blank" class="text-dark fs-4 text-decoration-none">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script src="filtros.js"></script>
</body>
</html>