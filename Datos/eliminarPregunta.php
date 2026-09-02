<?php
$idpregunta = $_GET["IDpregunta"];

include 'CRUD.php';
GestorPreguntas::eliminar($idpregunta); 
?>