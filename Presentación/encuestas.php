<?php
include 'controladoresBD.php';

// al enviar el formulario se guardan las respuestas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ControladorRespuestas::insertar();
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
            <div class="col d-flex align-items-center justify-content-evenly p-4">
                <a class="btn btn-link text-dark text-decoration-none fw-medium" href="https://www.hc.edu.uy/home" target="_blank">General</a>
                <a class="btn btn-link text-dark text-decoration-none fw-medium" href="documentos.php">Documentos</a>
                   <span class="text-dark fw-bold fs-5">Encuestas</span>
                <a class="btn btn-link text-dark text-decoration-none fw-medium" href="login.php">Acceso</a>
            </div>
        </div>
    </div>
          <div class="container mt-5 mb-5">
    <div class="row">
            <div class="col-md-2 mb-4">
            <h6 class="fw-bold text-secondary mb-3 text-uppercase fs-6 ps-2">Temas</h6>
            <div class="list-group list-group-flush">
                <?php 
                    // menú de temas sacados de la base, sirve para filtrar las secciones
                    include_once 'filtros.php';
                    GestorFiltrosEncuestas::MenuUsuarios();
                ?>
            </div>
        </div>
        <div class="col-md-10">
            //el id lo usa validaciones.js para controlar el envío
            <form id="formRespuestas" action="" method="POST">
                <?php 
                 // se muestran las preguntas agrupadas por tema, con sus estrellas
                    include_once 'Tarjetas.php';
                    TarjetasPreguntasUsu::mostrar(); 
                ?>
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary text-white fw-bold px-5 py-2 shadow-sm" style="background-color: #9ec5fe; border-color: #9ec5fe;" onmouseover="this.style.backgroundColor='#6ea8fe'; this.style.borderColor='#6ea8fe';" onmouseout="this.style.backgroundColor='#9ec5fe'; this.style.borderColor='#9ec5fe';">
                    Enviar encuesta
                </button>
            </div>
            </form>
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
    <script src="estrellas.js"></script>
    <script src="filtros.js"></script>
    <script src="validaciones.js"></script>
</body>
</html>