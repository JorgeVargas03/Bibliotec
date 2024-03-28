<?php
// Incluir el archivo de conexión a la base de datos
$link = include('../conexion.php');

// Verificar si se proporcionó un ID de publicación
if (isset($_GET['id'])) {
    // Obtener el ID de la publicación desde el parámetro GET
    $idPub = $_GET['id'];

    // Consultar la base de datos para obtener la información completa de la publicación
    $query = "SELECT p.*, u.nom_Us, u.apell_Us FROM publicacion p
              JOIN usuario u ON p.id_Usuario = u.idUsuario
              WHERE p.idPub = $idPub";
    $result = mysqli_query($link, $query);

    // Verificar si se encontró la publicación
    if (mysqli_num_rows($result) == 1) {
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
    <title>BiblioTec - Detalles de la Publicación</title>

    <!--En esta seccion se incluyen las hojas de estilos-->
    <link rel="icon" href="../../images/icons/tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
    <link rel="stylesheet" href="../../css/normalizar.css">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/hover-min.css">
    <link rel="stylesheet" href="../../css/animate.css">
    <link rel="stylesheet" href="style.css">
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
                <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span></b></h4>
            </div>
        </div>
    </header>

    <!-- Contenido de la página -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <!-- Detalles de la publicación -->
                <div class="card card-details">
                    <div class="card-header bg-primary text-light">
                        <h5 class="card-title mb-0"><?php echo $publicacion['titulo_Pub']; ?></h5>
                        <p class="card-text mb-0">Por:<b> <?php echo $publicacion['nom_Us'] . " " . $publicacion['apell_Us']; ?></b></p>
                    </div>
                    <div class="card-body">
                        <!-- Descripción de la publicación -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="bg-light p-3 rounded">
                                    <p class="card-text"><?php echo $publicacion['descrip_Pub']; ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Información adicional de la publicación -->
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-text">Carrera: <?php echo $publicacion['carrera_Pub']; ?></p>
                                <p class="card-text">Materia: <?php echo $publicacion['materia_Pub']; ?></p>
                                <p class="card-text">Tipo de Publicación: <?php echo $publicacion['tipo_pub']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <!-- Calificación con estrellas -->
                                <div class="rating mt-3">
                                    <p class="card-text">Calificación:</p>
                                    <?php
                                    // Calificación actual de la publicación
                                    $calificacion = $publicacion['calif_Pub'];

                                    // Convertir calificación del rango 1-10 a 1-5
                                    $calificacion_estrellas = ceil($calificacion / 2);

                                    // Mostrar estrellas llenas según la calificación
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $calificacion_estrellas) {
                                            echo '<i class="bi bi-star-fill text-warning"></i>';
                                        } else {
                                            echo '<i class="bi bi-star text-warning"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Botón para ver archivo adjunto -->
                    <div class="row">
                        <div class="col text-center mt-3 mb-3">
                            <a href="<?php echo $publicacion['archivo_Pub']; ?>" target="_blank" class="btn btn-primary btn-lg">
                                <i class="bi bi-file-pdf-fill mr-2"></i> Ver Archivo Adjunto
                            </a>
                        </div>
                    </div>
                    <!-- Etiquetas -->
                    <div class="card-footer d-flex justify-content-between align-items-end">
                        <?php
                        // Etiquetas por defecto y colores asignados
                        $etiquetas = array("Etiqueta1", "Etiqueta2", "Etiqueta3");
                        $colores = array("bg-danger", "bg-success", "bg-info");

                        // Iterar sobre las etiquetas y mostrarlas
                        foreach ($etiquetas as $index => $etiqueta) {
                            echo '<span class="badge ' . $colores[$index % count($colores)] . ' mr-1">' . $etiqueta . '</span>';
                        }
                        ?>
                        <!-- Fecha de Publicación -->
                        <p class="card-text comment-date mb-0 align-self-end">Fecha: <?php echo $publicacion['fecha_Pub']; ?></p>
                    </div>
                </div>



                <!-- Sección de comentarios -->
                <div class="mt-5">
                    <h5 class="mb-4">Comentarios</h5>

                    <!-- Formulario para agregar comentarios -->
                    <form action="procesar_comentario.php" method="POST">
                        <div class="mb-3">
                            <label for="comentario" class="form-label">Agregar Comentario:</label>
                            <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="id_publicacion" value="<?php echo $publicacion['idPub']; ?>">
                        <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                    </form>

                    <!-- Arreglo de rutas de imágenes aleatorias -->
                    <?php
                    $imagenes_aleatorias = array(
                        "../../images/tigers/a2.png",
                        "../../images/tigers/a3.png",
                        "../../images/tigers/ia.png",
                        "../../images/tigers/a12.png",
                        // Agrega más imágenes según sea necesario
                    );

                    // Contador para alternar entre las imágenes aleatorias y los avatares
                    $contador = 0;
                    ?>

                    <!-- Mostrar comentarios existentes -->
                    <?php while ($comentario = mysqli_fetch_assoc($result_comentarios)) : ?>
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <?php if ($contador % 2 == 0) : ?>
                                            <!-- Mostrar imagen aleatoria -->
                                            <img src="<?php echo $imagenes_aleatorias[array_rand($imagenes_aleatorias)]; ?>" alt="Imagen Aleatoria" class="rounded-circle" width="50">
                                        <?php else : ?>
                                            <!-- Mostrar avatar -->
                                            <img src="<?php echo $imagenes_aleatorias[array_rand($imagenes_aleatorias)]; ?>" alt="Imagen Aleatoria" class="rounded-circle" width="50">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col">
                                        <h6 class="mb-1"><?php echo $comentario['nom_Us'] . " " . $comentario['apell_Us']; ?></h6>
                                        <p class="mb-1"><?php echo $comentario['text_Coment']; ?></p>
                                        <small class="text-muted"><?php echo $comentario['fecha_Coment']; ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        // Incrementar el contador
                        $contador++;
                        ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-3 text-light bg-primary mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- Scripts de Bootstrap y otros scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>