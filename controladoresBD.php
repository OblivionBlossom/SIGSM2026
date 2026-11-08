<?php
include 'CRUD.php';

class ControladorDocumentos {

    public static function insertar() {
        $nombredoc  = $_POST["Nombredocumento"];
        $depto      = $_POST["Departamento"];
        $tipod      = $_POST["TipoD"];
        $categoria  = $_POST["Categoria"];
        $fecha      = $_POST["Fecha"];
        $email      = $_POST["Email"];

        // nombre del archivo pdf que se subió desde el formulario.
        $nombreArchivo  = $_FILES['Rutapdf']['name'];
        // ubicación temporal donde php deja el archivo mientras procesa la subida.
        $rutaTemporal   = $_FILES['Rutapdf']['tmp_name'];
           // ruta final donde se va a guardar el archivo, dentro de la carpeta uploads.
        $rutaDestino    = "uploads/" . $nombreArchivo;

         // si no existe la carpeta uploads se crea.
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }
        // mueve el pdf de la carpeta temporal a uploads
        move_uploaded_file($rutaTemporal, $rutaDestino);

        GestorDocumentos::insertar($nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email);
    }

    public static function eliminar($nombre) {
        GestorDocumentos::eliminar($nombre);
    }

    public static function modificar($nombreOriginal) {
        $nombredoc      = $_POST["Nombredocumento"];
        $depto          = $_POST["Departamento"];
        $tipod          = $_POST["TipoD"];
        $categoria      = $_POST["Categoria"];
        $fecha          = $_POST["Fecha"];
        $email          = $_POST["Email"];

        // si se subió un pdf nuevo se reemplaza. si no se subió nada se mantiene la ruta anterior
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
    }
}

class ControladorPreguntas {

    public static function insertar() {
        $temas         = $_POST["Temas"];
        $orden         = $_POST["Orden"];
        $textopregunta = $_POST["Textopregunta"];

        GestorPreguntas::insertar($temas, $orden, $textopregunta);
    }

    public static function eliminar($idpregunta) {
        GestorPreguntas::eliminar($idpregunta); 
    }

    public static function modificar($idOriginal) {
        $temas         = $_POST["Temas"];
        $orden         = $_POST["Orden"];
        $textopregunta = $_POST["Textopregunta"];

        GestorPreguntas::modificar($temas, $orden, $textopregunta, $idOriginal);
    }
}

class ControladorRespuestas {

    public static function insertar() {
        // se verifica que llegaron respuestas y que sean un array. si no, se vuelve a encuestas
        if (isset($_POST["respuesta"]) && is_array($_POST["respuesta"])) {
            GestorRespuestas::insertarVarias($_POST["respuesta"]);
        } else {
            header("Location: encuestas.php");
            exit();
        }
    }
}

class ControladorFuncionarios {
    public static function login() {
         // se controla que estén los dos campos antes de consultar la base.
        if (isset($_POST['login']) && isset($_POST['pass'])) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];

            GestorFuncionarios::validarLogin($login, $pass);
        }
    }
    
    public static function insertar() {
        if (isset($_POST['CI']) && isset($_POST['Usuario']) && isset($_POST['Pass']) && isset($_POST['Cargo']) && isset($_POST['Nombre'])) {
            GestorFuncionarios::insertar($_POST['CI'], $_POST['Usuario'], $_POST['Pass'], $_POST['Cargo'], $_POST['Nombre']);
        }
    }

       public static function logout() {
        GestorFuncionarios::cerrarSesion();
    }
}
?>