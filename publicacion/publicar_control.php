<?php
include('../php/conexion.php');

session_start();

$carpetaUsuario = "../repo_archivos/" . $_SESSION['idU'];
// Crear la carpeta si no existe
if (!is_dir($carpetaUsuario)) {
    if (!mkdir($carpetaUsuario, 0777, true)) {
        die('Error al crear la carpeta');
    }
}

// Verificar el tamaño del archivo
$tamanoMaximo = 2 * 1024 * 1024; // 2 MB en bytes
if ($_FILES['archivo']['size'] > $tamanoMaximo) {
    echo "El tamaño del archivo excede el límite permitido (2 MB).";
} else {
    // Archivo 
    // Obtener nombre temporal y nombre de archivo
    $archivoTemporal = $_FILES['archivo']['tmp_name'];
    $nombreArchivo = $_FILES['archivo']['name'];

    $rutaArchivo = $carpetaUsuario . '/' . $nombreArchivo;

    // Verificar si el archivo se ha subido correctamente
    if (move_uploaded_file($archivoTemporal, $rutaArchivo)) {
        echo "El archivo se ha subido correctamente.";

        // Insertar en la base de datos solo si el archivo se ha subido correctamente
        $titulo = $_POST['titulo'];
        $idUsuario = $_SESSION['idU'];
        $fechaActual = date("Y-m-d");
        $carrera = $_POST['cbx_carrera']; 
        $descripcion = $_POST['descripcion']; 
        $materia = $_POST['cbx_materia'];
        $tipo = $_POST['tipo'];
        $nulo =  0;

        // insercion
        $inserta = "INSERT INTO publicacion (id_Usuario, titulo_Pub, fecha_pub, descrip_Pub, calif_Pub, carrera_Pub, materia_Pub, tipo_pub, archivo_Pub) VALUES (?,?,?,?,?,?,?,?,?)";
        if ($stmt = $link->prepare($inserta)) {
            // Vincular parámetros
            $stmt->bind_param("issssssss", $idUsuario, $titulo, $fechaActual ,$descripcion, $nulo, $carrera, $materia, $tipo, $rutaArchivo);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Los datos se han guardado correctamente.";
            } else {
                echo "Error al guardar los datos: " . $link->error;
            }

            // Cerrar la consulta preparada
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $link->error;
        }
    } else {
        echo "Error al subir el archivo. No se ha realizado ninguna inserción en la base de datos.";
    }
}

// Cerrar la conexión
$link->close();

?>
