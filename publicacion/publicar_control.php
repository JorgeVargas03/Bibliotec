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

    // Obtener las etiquetas del formulario
    $etiquetas = $_POST['etiquetas'];
    // Separar las etiquetas por el espacio en blanco
    $arrayEtiquetas = explode(' ', $etiquetas);

    // insercion
    $inserta = "INSERT INTO publicacion (id_Usuario, titulo_Pub, fecha_pub, descrip_Pub, calif_Pub, carrera_Pub, materia_Pub, tipo_pub, estado_Pub, archivo_Pub) VALUES (?,?,?,?,?,?,?,?,?,?)";
    if ($stmt = $link->prepare($inserta)) {
        // Vincular parámetros
        $stmt->bind_param("isssssssss", $idUsuario, $titulo, $fechaActual ,$descripcion, $nulo, $carrera, $materia, $tipo, $nulo, $rutaArchivo);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Obtener el ID de la última inserción
            $idPublicacion = $stmt->insert_id;

            // Insertar etiquetas en la tabla tag_publicacion
            foreach ($arrayEtiquetas as $etiqueta) {
                // Verificar si la etiqueta no está vacía
                if (!empty($etiqueta)) {
                    // Quitar el símbolo '#' de la etiqueta
                    $etiquetaSinSimbolo = substr($etiqueta, 1);
                    // Insertar la etiqueta en la tabla
                    $insertarEtiqueta = "INSERT INTO tag_publicacion (idPub, nombreTag) VALUES (?, ?)";
                    if ($stmtEtiqueta = $link->prepare($insertarEtiqueta)) {
                        // Vincular parámetros
                        $stmtEtiqueta->bind_param("is", $idPublicacion, $etiquetaSinSimbolo);
                        // Ejecutar la consulta para insertar la etiqueta
                        $stmtEtiqueta->execute();
                    }
                }
            }

            $_SESSION["alert_message"] = "La publicación se ha mandado a revisión.";
            header("location: publicar.php"); // Redirigir de vuelta al formulario de inicio de sesión
            exit;
        } else {
            $_SESSION["alert_message"] = "Error en la preparación de la consulta: " . $link->error;
            header("location: publicar.php"); // Redirigir de vuelta al formulario de inicio de sesión
            exit;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        $_SESSION["alert_message"] = "Error en la preparación de la consulta: " . $link->error;
        header("location: publicar.php"); // Redirigir de vuelta al formulario de inicio de sesión
        exit;
    }
} else {
    $_SESSION["alert_message"] = "Error al subir el archivo.";
    header("location: publicar.php"); // Redirigir de vuelta al formulario de inicio de sesión
    exit;
}

// Cerrar la conexión
$link->close();

?>
