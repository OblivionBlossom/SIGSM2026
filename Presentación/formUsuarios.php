<?php
include("controladoresBD.php");

session_start();
// solo un administrador puede entrar a esta página, si no vuelve al panel
if (!isset($_SESSION["cargo"]) || $_SESSION["cargo"] != "Administrador") {
    header("Location: adminDocumentos.php");
    exit();
}

// al enviar el formulario se da de alta el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ControladorFuncionarios::insertar();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #e9ecef;">
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-white border shadow">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4" style="font-family: serif;">Nuevo usuario</h4>
                    <form id="formUsuarios" action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-dark fw-bold small">Cédula</label>
                            <input type="text" inputmode="numeric" id="ci" name="CI" class="form-control bg-info-subtle text-muted" placeholder="Ej: 12345678">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark fw-bold small">Nombre</label>
                            <input type="text" id="nombre" name="Nombre" maxlength="20" class="form-control bg-info-subtle text-muted" placeholder="Ej: Ana Pérez">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark fw-bold small">Usuario</label>
                            <input type="text" id="usuario" name="Usuario" maxlength="20" class="form-control bg-info-subtle text-muted" placeholder="Ej: aperez">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark fw-bold small">Contraseña</label>
                            <input type="password" id="pass" name="Pass" maxlength="20" class="form-control bg-info-subtle text-muted">
                            <div class="form-check mt-2">
                                <!--el checkbox cambia el tipo del input para mostrar u ocultar la contraseña-->
                                <input class="form-check-input" type="checkbox" id="verPass" onchange="document.getElementById('pass').type = this.checked ? 'text' : 'password';">
                                <label class="form-check-label small text-muted" for="verPass">Mostrar contraseña</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark fw-bold small">Cargo</label>
                            <input type="text" id="cargo" name="Cargo" maxlength="20" class="form-control bg-info-subtle text-muted" placeholder="Ej: Administrador">
                        </div>
                        <div class="d-flex gap-3 col-10 mx-auto mt-4">
                            <button type="submit" class="btn btn-primary text-white fw-bold p-2 flex-fill shadow-sm" style="background-color: #9ec5fe; border-color: #9ec5fe;" onmouseover="this.style.backgroundColor='#6ea8fe'; this.style.borderColor='#6ea8fe';" onmouseout="this.style.backgroundColor='#9ec5fe'; this.style.borderColor='#9ec5fe';">
                                Guardar
                            </button>
                            <a href="adminDocumentos.php" class="btn btn-outline-info fw-bold p-2 flex-fill">
                                Cancelar
                            </a>
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
