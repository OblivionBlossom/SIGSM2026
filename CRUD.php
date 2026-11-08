<?php
class GestorDocumentos {

    public static function insertar($nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email) {
        include("BD.php");
        
        $sql = "INSERT INTO documentos (Nombredocumento, Fecha, TipoD, Categoria, Departamento, Rutapdf, Email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        // se prepara la consulta con ? en lugar de los valores
        $sentencia = $conexion->prepare($sql);
        // s = string, i = entero. va un caracter por cada ? del insert, en el mismo orden
        $sentencia->bind_param("sssssss", $nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
         // vuelve al listado de documentos
         header("Location: adminDocumentos.php");
        exit();
    }

    public static function eliminar($nombreDoc) {
        include("BD.php");
        
        // se borra el documento que coincida con ese nombre
        $sql = "DELETE FROM documentos WHERE Nombredocumento = ?";  
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("s", $nombreDoc);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
        header("Location: adminDocumentos.php");
        exit();
    }

    public static function modificar($nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email, $nombreOriginal) {
        include("BD.php");
        
        // se actualizan los datos del documento, buscándolo por el nombre original
        $sql = "UPDATE documentos SET Nombredocumento = ?, Fecha = ?, TipoD = ?, Categoria = ?, Departamento = ?, Rutapdf = ?, Email = ? WHERE Nombredocumento = ?";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("ssssssss", $nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email, $nombreOriginal);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
        header("Location: adminDocumentos.php");
        exit();
    }
    }

class GestorPreguntas {

    public static function insertar($temas, $orden, $textopregunta) {
        include("BD.php");
        
        $sql = "INSERT INTO preguntas (Temas, Orden, Textopregunta) VALUES (?, ?, ?)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("sis",$temas, $orden, $textopregunta);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
        // vuelve al listado de encuestas avisando que salió bien
        header("Location: adminEncuestas.php?exito=1");
        exit();
    }

    public static function eliminar($idPregunta) {
        include("BD.php");
        
        $sql = "DELETE FROM preguntas WHERE IDpregunta = ?";  
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("i", $idPregunta);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
        header("Location: adminEncuestas.php");
        exit();
    }

    public static function modificar($temas, $orden, $textopregunta, $idOriginal) {
        include("BD.php");
        
        $sql = "UPDATE preguntas SET Temas = ?, Orden = ?, Textopregunta = ? WHERE IDpregunta = ?";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("sisi", $temas, $orden, $textopregunta, $idOriginal);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
        header("Location: adminEncuestas.php");
        exit();
    }
}

class GestorRespuestas {

    public static function insertarVarias($respuestas) {
        include("BD.php");

        $sql = "INSERT INTO respuesta (IDpregunta, Valoracion) VALUES (?, ?)";
        $sentencia = $conexion->prepare($sql);

        // se recorre cada respuesta del formulario y se inserta una por una
        foreach ($respuestas as $idpregunta => $valoracion) {
            $sentencia->bind_param("is", $idpregunta, $valoracion);
            $sentencia->execute();
        }

        $sentencia->close();
        $conexion->close();

        header("Location: encuestas.php?exito=1");
        exit();
    }
}

class GestorFuncionarios {

    public static function validarLogin($usuIngresado, $pass) {
        include("BD.php");

        // se busca el usuario en la base y se trae su contraseña guardada (el hash) y su cargo
        $sql = "SELECT `Contraseña`, Cargo FROM funcionario WHERE Usuario = ?";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("s", $usuIngresado);
        $sentencia->execute();
        $sentencia->bind_result($hash, $cargo);

         // fetch devuelve false si no encontró el usuario. password_verify compara la
        // contraseña escrita con el hash guardado
        if ($sentencia->fetch() && password_verify($pass, $hash)) {
            $sentencia->close();
            $conexion->close();

            // se guardan el usuario y el cargo en la sesión para mantenerlo logueado
            session_start();
            $_SESSION["usuario"] = $usuIngresado;
            $_SESSION["cargo"] = $cargo;

            header("Location: adminDocumentos.php");
            exit();
        }

        $sentencia->close();
        $conexion->close();

        // si no encontró el usuario o la contraseña no coincide, vuelve al login con error
        header("Location: login.php?error=1");
        exit();
    }

    public static function insertar($ci, $usuIngresado, $pass, $cargo, $nombre) {
        include("BD.php");

        // se fija si ya hay un funcionario con esa cédula
        $sql = "SELECT CI FROM funcionario WHERE CI = ?";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("i", $ci);
        $sentencia->execute();

        // fetch devuelve false si no hay ningún registro con esa cédula
        if ($sentencia->fetch()) {
            $sentencia->close();
            $conexion->close();

            header("Location: formUsuarios.php?error=2");
            exit();
        }
        $sentencia->close();

        // se encripta la contraseña antes de guardarla
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO funcionario (CI, Usuario, `Contraseña`, Cargo, Nombre) VALUES (?, ?, ?, ?, ?)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("issss", $ci, $usuIngresado, $hash, $cargo, $nombre);
        $sentencia->execute();

        $sentencia->close();
        $conexion->close();

        header("Location: adminDocumentos.php?exito=1");
        exit();
    }

    public static function cerrarSesion() {
          // se destruye la sesión y se vuelve al login
        session_start();
        session_destroy();

        header("Location: login.php");
        exit();
    }
}
?>