<?php
$idpregunta    = $_POST["IDpregunta"];
$temas         = $_POST["Temas"];
$orden         = $_POST["Orden"];
$textopregunta = $_POST["Textopregunta"];
$tipo          = $_POST["Tipo"];

include 'CRUD.php';
GestorPreguntas::insertar($idpregunta, $temas, $orden, $textopregunta, $tipo);
?>