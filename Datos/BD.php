<?php
    $host = "localhost";
    $usuario = "root";
    $contra = "";
    $bd = "hospital_documentos"; 
    $conexion = new mysqli($host, $usuario, $contra, $bd);
   
    if ($conexion->connect_errno) {
        die("Error con la conexión: " . $conexion->connect_error);
    }

    $conexion->set_charset("utf8mb4");
?>