<?php
include 'controladoresBD.php';

// al enviar el formulario se validan las credenciales contra la base
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ControladorFuncionarios::login();
}
?>
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
                <a class="btn btn-link text-dark text-decoration-none fw-medium" href="documentos.php">Documentos</a>
                <a class="btn btn-link text-dark text-decoration-none fw-medium" href="encuestas.php">Encuestas</a>
                <span class="text-dark fw-bold fs-5">Login</span>
            </div>
        </div>
    </div>
    <section class="container-fluid d-flex align-items-center py-5" style="background-image: url('imagenFondo.jpeg'); background-size: cover; background-position: center; min-height: 80vh;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-5">
                    <div class="bg-white p-5 rounded shadow-lg">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold fs-3" style="font-family: serif;">Inicio de sesión Medico</h2>
                            <p class="text-muted small">ingresa con tus credenciales</p>
                        </div>
                    <form id="formLogin" action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Nombre de usuario</label>
                            <input type="text" name="login" class="form-control" placeholder="Usuario" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Contraseña</label>
                            <input type="password" name="pass" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="d-grid">
                             <button type="submit" class="btn btn-primary text-white fw-bold px-5 py-2 shadow-sm" style="background-color: #9ec5fe; border-color: #9ec5fe;" onmouseover="this.style.backgroundColor='#6ea8fe'; this.style.borderColor='#6ea8fe';" onmouseout="this.style.backgroundColor='#9ec5fe'; this.style.borderColor='#9ec5fe';">
                                   Iniciar sesión
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <script src="validaciones.js"></script>
</body>
</html>