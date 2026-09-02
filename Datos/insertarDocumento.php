<?php
$nombredoc  = $_POST["Nombredocumento"];
$depto      = $_POST["Departamento"];
$tipod      = $_POST["TipoD"];
$categoria  = $_POST["Categoria"];
$fecha      = $_POST["Fecha"];
$email      = $_POST["Email"];

$nombreArchivo  = $_FILES['Rutapdf']['name'];
$rutaTemporal   = $_FILES['Rutapdf']['tmp_name'];
$rutaDestino    = "uploads/" . $nombreArchivo;

if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}
move_uploaded_file($rutaTemporal, $rutaDestino);

include 'CRUD.php';
GestorDocumentos::insertar($nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email);
?>