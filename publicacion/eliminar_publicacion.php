<?php
// Incluye el archivo de conexión a la base de datos
$conexion = include('../../php/conexion.php');

// Verifica si se ha enviado el ID de la publicación a eliminar
if (isset($_POST['idpub'])) {
    $idPublicacion = $_POST['idpub'];

    // Prepara la consulta SQL para eliminar la publicación
    $consulta = "DELETE FROM `publicacion` WHERE `idPub` = $idPublicacion";

    // Ejecuta la consulta
    if (mysqli_query($conexion, $consulta)) {
        // Redirige al usuario a la página de perfil con un mensaje de éxito
        header("Location: ../administracion/Perfil/infoperfil.php?mensaje=Publicacion eliminada exitosamente");
        exit();
    } else {
        // Redirige al usuario a la página de perfil con un mensaje de error
        header("Location: ../administracion/Perfil/infoperfil.php?mensaje=Error al eliminar la publicacion");
        exit();
    }
} else {
    // Si no se ha enviado el ID de la publicación, redirige al usuario a la página de perfil
    header("Location: ../administracion/Perfil/infoperfil.php");
    exit();
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
