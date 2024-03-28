<?php
// Incluir el archivo de conexión a la base de datos
$link = include('../conexion.php');

// Verificar si se proporcionó un ID de publicación
if(isset($_GET['id'])) {
    // Obtener el ID de la publicación desde el parámetro GET
    $idPub = $_GET['id'];

    // Consultar la base de datos para obtener la información completa de la publicación
    $query = "SELECT p.*, u.nom_Us, u.apell_Us FROM publicacion p
              JOIN usuario u ON p.id_Usuario = u.idUsuario
              WHERE p.idPub = $idPub";
    $result = mysqli_query($link, $query);

    // Verificar si se encontró la publicación
    if(mysqli_num_rows($result) == 1) {
        $publicacion = mysqli_fetch_assoc($result);

        // Consultar los comentarios asociados a esta publicación
        $query_comentarios = "SELECT c.*, u.nom_Us, u.apell_Us FROM comentario c
                              JOIN usuario u ON c.idUsuario = u.idUsuario
                              WHERE c.idPub = $idPub";
        $result_comentarios = mysqli_query($link, $query_comentarios);
    } else {
        // Si no se encontró la publicación, redireccionar a la página principal
        header("Location: home.php");
        exit();
    }
} else {
    // Si no se proporcionó un ID de publicación, redireccionar a la página principal
    header("Location: home.php");
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($link);

// Iniciar sesión
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioTec - Home</title>

    <!--En esta seccion se incluyen las hojas de estilos-->
    <link rel="icon" href="../../images/icons/tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
    <link rel="stylesheet" href="../../css/normalizar.css">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/hover-min.css">
    <link rel="stylesheet" href="../../css/animate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!--Inicia Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Termmina Bootstrap-->
</head>
<body>

<!-- Header -->
<header class="bg-primary py-2">
    <div class="container">
        <div class="logo">
            <img src="../../images/icons/flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
            <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span></h4>
        </div>
    </div>
</header>

<!-- Contenido de la página -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <!-- Detalles de la publicación -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $publicacion['titulo_Pub']; ?></h5>
                    <p class="card-text">Por: <?php echo $publicacion['nom_Us'] . "-" . $publicacion['apell_Us']; ?></p>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $publicacion['descrip_Pub']; ?></p>
                    <!-- Mostrar otros detalles de la publicación -->
                    <p class="card-text">Fecha de Publicación: <?php echo $publicacion['fecha_Pub']; ?></p>
                    <p class="card-text">Calificación: <?php echo $publicacion['calif_Pub']; ?></p>
                    <p class="card-text">Carrera: <?php echo $publicacion['carrera_Pub']; ?></p>
                    <p class="card-text">Materia: <?php echo $publicacion['materia_Pub']; ?></p>
                    <p class="card-text">Tipo de Publicación: <?php echo $publicacion['tipo_pub']; ?></p>
                    <!-- Enlace para ver el archivo adjunto -->
                    <a href="<?php echo $publicacion['archivo_Pub']; ?>" target="_blank" class="btn btn-primary">Ver Archivo Adjunto</a>
                </div>
            </div>

            <!-- Sección de comentarios -->
            <div class="mt-4">
                <h5>Comentarios</h5>
                <!-- Formulario para agregar comentarios -->
                <form action="procesar_comentario.php" method="POST">
                    <div class="mb-3">
                        <label for="comentario" class="form-label">Agregar Comentario:</label>
                        <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="id_publicacion" value="<?php echo $publicacion['idPub']; ?>">
                    <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                </form>

                <!-- Mostrar comentarios existentes -->
                <?php while ($comentario = mysqli_fetch_assoc($result_comentarios)): ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <p class="card-text"><b><?php echo $comentario['nom_Us'] . "-" . $comentario['apell_Us']; ?>:</b></p>
                            <p class="card-text"><?php echo $comentario['text_Coment']; ?></p>
                            <p class="card-text">Fecha: <?php echo $comentario['fecha_Coment']; ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="py-3 text-light bg-primary">
    <div class="container">
        <p class="mb-0">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
    </div>
</footer>

<!-- Scripts de Bootstrap y otros scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>