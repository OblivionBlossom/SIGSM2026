<?php
class GestorDocumentos {

    public static function insertar($nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email) {
        include("bd.php");
        
        $sql = "INSERT INTO documentos (Nombredocumento, Fecha, TipoD, Categoria, Departamento, Rutapdf, Email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("sssssss", $nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
         header("Location: administracion.php");
        exit();
    }

    public static function eliminar($nombreDoc) {
        include("bd.php");
        
        $sql = "DELETE FROM documentos WHERE Nombredocumento = ?";  
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("s", $nombreDoc);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
        header("Location: administracion.php");
        exit();
    }

    public static function modificar($nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email, $nombreOriginal) {
        include("bd.php");
        
        $sql = "UPDATE documentos SET Nombredocumento = ?, Fecha = ?, TipoD = ?, Categoria = ?, Departamento = ?, Rutapdf = ?, Email = ? WHERE Nombredocumento = ?";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("ssssssss", $nombredoc, $fecha, $tipod, $categoria, $depto, $rutaDestino, $email, $nombreOriginal);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
        header("Location: administracion.php");
        exit();
    }
    }

    class GestorPreguntas {

 public static function insertar($idpregunta, $temas, $orden, $textopregunta, $tipo) {
        include("bd.php");
        
        $sql = "INSERT INTO preguntas (IDpregunta, Temas, Orden, Textopregunta, Tipo) VALUES (?, ?, ?, ?, ?)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("isiss", $idpregunta, $temas, $orden, $textopregunta, $tipo);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
        header("Location: editarPreguntas.php?exito=1");
        exit();
    }

    public static function eliminar($idPregunta) {
        include("bd.php");
        
        $sql = "DELETE FROM preguntas WHERE IDpregunta = ?";  
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("i", $idPregunta);
        $sentencia->execute();
        
        $sentencia->close();
        $conexion->close();
        
        header("Location: editarPreguntas.html");
        exit();
    }
}
?>