<?php
include('../php/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPublicacion = $_POST['idPub'];
    $titulo = $_POST['titulo_Pub'];
    $descripcion = $_POST['descrip_Pub'];
    $carrera = $_POST['carrera_Pub'];
    $materia = $_POST['materia_Pub'];

    // Consulta SQL para actualizar la publicación
    $consulta = "UPDATE publicacion SET 
                 titulo_Pub = '$titulo', 
                 descrip_Pub = '$descripcion', 
                 carrera_Pub = '$carrera', 
                 materia_Pub = '$materia' 
                 WHERE idPub = '$idPublicacion'";

    if (mysqli_query($conexion, $consulta)) {
        header("Location: infoperfil.php?mensaje=Publicación actualizada exitosamente");
        exit();
    } else {
        echo "Error al actualizar la publicación: " . mysqli_error($conexion);
        exit();
    }
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
