<?php
include 'CRUD.php';

$nombreOriginal = $_GET['nombre'];
$nombredoc      = $_POST["Nombredocumento"];
$depto          = $_POST["Departamento"];
$tipod          = $_POST["TipoD"];
$categoria      = $_POST["Categoria"];
$fecha          = $_POST["Fecha"];
$email          = $_POST["Email"];

if (!empty($_FILES['Rutapdf']['name'])) {
    $nombreArchivo  = $_FILES['Rutapdf']['name'];
    $rutaTemporal   = $_FILES['Rutapdf']['tmp_name'];
    $rutaDestino    = "uploads/" . $nombreArchivo;

    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }
    move_uploaded_file($rutaTemporal, $rutaDestino);
} else {
    $rutaDestino = $_POST['rutaActual']; 
}

GestorDocumentos::modificar($nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email, $nombreOriginal);
?>