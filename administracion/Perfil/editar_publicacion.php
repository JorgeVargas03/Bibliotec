<?php
    include('../../php/conexion.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idPub = $_POST['idPub'];
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];

        // Consulta para actualizar la publicación
        $sql = "UPDATE publicacion SET titulo_Pub=?, descrip_Pub=? WHERE idPub=?";
        $stmt = mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param($stmt, "ssi", $titulo, $contenido, $idPub);
        
        if(mysqli_stmt_execute($stmt)){
            echo "<script language = 'JavaScript'>
                    alert('La publicacion ha sido actualizada');
                    location.assign('index.php');
                    </script>";
        } else {
            echo "<script language = 'JavaScript'>
                    alert('Error al actualizar la publicacion');
                    </script>";
        }
    } else {
        $idPub = $_GET['idPub'];

        // Consulta para obtener los datos de la publicación a editar
        $sql = "SELECT * FROM publicacion WHERE idPub=?";
        $stmt = mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idPub);
        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);
        $publicacion = mysqli_fetch_assoc($resultado);

        // Formulario para editar la publicación
        echo "<!DOCTYPE html>
              <html>
              <head>
                  <title>Editar Publicación</title>
              </head>
              <body>
              
                  <h2>Editar Publicación</h2>
              
                  <form action='editar_publicacion.php' method='post'>
                      <input type='hidden' name='idPub' value='" . $publicacion['idPub'] . "'>
                      <label>Título:</label>
                      <input type='text' name='titulo' value='" . $publicacion['titulo_Pub'] . "'><br><br>
                      
                      <label>Contenido:</label><br>
                      <textarea name='contenido' rows='4' cols='50'>" . $publicacion['descrip_Pub'] . "</textarea><br><br>
                      
                      <input type='submit' value='Actualizar'>
                  </form>
              
              </body>
              </html>";
    }
?>
