<?php
// Incluir el archivo de conexión a la base de datos
$link = include('../php/conexion.php');

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
        header("Location: ../home.php");
        exit();
    }
} else {
    // Si no se proporcionó un ID de publicación, redireccionar a la página principal
    header("Location: ../home.php");
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
    <link rel="icon" href="../images/icons/tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
    <link rel="stylesheet" href="../css/normalizar.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/hover-min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/sidebars.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!--Inicia Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <!--Termmina Bootstrap-->

    <!--iconos-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0" />

    <style>
        @font-face {
            font-family: 'Agrandir';
            src: url('../css/Agrandir.otf') format('otf');
        }

        pre{
            font-family: 'Agrandir', sans-serif;
            font-size: 16px;
        }
    </style>
</head>

<style>
    .material-symbols-outlined {
        color: #F87200;
        text-shadow: 2px 2px 4px rgba(134, 134, 134, 0.2);
        font-variation-settings:
            'FILL' 1,
            'wght' 900,
            'GRAD' 100,
            'opsz' 424
    }
</style>


<body>
    <header class="bg-primary py-2">
        <div class="container d-flex align-items-center">
            <!-- Logo y título -->
            <div class="logo">
                <img src="../images/icons/flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
                <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span></h4>
                <form class="position-relative search-field " style="margin-top: -0.8%;">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                    <a href='#'><i class="bi bi-search search-icon"></i></a>

                </form>
                <button type="button" class="btn btn-warning position-absolute top-0 end-0 me-5 mt-4">Notificaciones
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">99+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </button>
            </div>
            <!-- Campo de búsqueda -->

            <!-- Ícono de notificaciones -->

        </div>
    </header>
    <!--Aqui se muestra un apartado para los productos que se venderan-->

    <!--IMAGEN DE CONTACTO-->
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="people-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </symbol>
    </svg>


    <div class="container-fluid">
        <div class="row">
            <!-- Barra de navegación izquierda -->
            <div class="flex-shrink-0 p-3" style="width: 15%; background-color: #F07B12;">
                <ul class="list-unstyled" id="menu-lateral">
                    <li class="mb-2 mt-2">
                        <a class="nav-link align-items-center" name="fade" href="../home.php" id="letrabar">Inicio</a>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" style="color: black; font-weight: bold;">
                            Carreras
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Arquitectura</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Ingeniería Bioquímica</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Civil</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Eléctrica</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ing. en Gestión Empresarial</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ing. en Sistemas Computacionales</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Industrial</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Mecatrónica</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Química</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Licenciatura en Administración</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" data-bs-toggle="collapse" data-bs-target="#contacto-collapse" aria-expanded="false" style="color: black; font-weight: bold;">
                            Contacto
                        </button>
                        <div class="collapse" id="contacto-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Información de contacto</a></li>
                            </ul>
                        </div>
                    </li>
                    <hr class="my-2"> <!-- Línea divisora -->
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" data-bs-toggle="collapse" data-bs-target="#cuenta-collapse" aria-expanded="false" style="color: black; font-weight: bold;">
                            <svg class="bi pe-none" width="1.3vmax" height="1.3vmax">
                                <use xlink:href="#people-circle" />
                            </svg>
                            <span style="margin-top:0.3vmax; margin-left: 0.4vmax;">Cuenta</span>
                        </button>
                        <div class="collapse" id="cuenta-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Mi Perfil</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    </li>
                    <hr class="my-2"> <!-- Línea divisora -->
                </ul>
            </div>
            <!-- Contenido principal -->


            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="font-weight:normal; margin-left: 1.5%">
                <h3 style=" margin-left: 1.5% ; margin-top: 35px;">
                    <b class="textogran" style="font-size: 2vmax; text-shadow: 2px 2px 4px rgba(114, 114, 114, 0.4);
                    margin-top: 0.5vmax;">Detalles de la Publicación</b>
                    </h2>
                    <div class="container mt-4 mb-5">
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
                                                <p class="card-text"><b>Carrera:</b> <?php echo $publicacion['carrera_Pub']; ?></p>
                                                <p class="card-text"><b>Materia:</b> <?php echo $publicacion['materia_Pub']; ?></p>
                                                <p class="card-text"><b>Tipo de Publicación:</b> <?php echo $publicacion['tipo_pub']; ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Calificación con estrellas -->
                                                <div class="rating mt-3">
                                                    <p class="card-text"><b>Calificación:</b></p>
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
                                    <form action="comentar.php" method="POST">
                                        <div class="mb-3">
                                            <label for="comentario" class="form-label">Agregar Comentario:</label>
                                            <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
                                        </div>
                                        <input type="hidden" name="id_publicacion" value="<?php echo $publicacion['idPub']; ?>">
                                        <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                                    </form>

                                    <!-- Arreglo de rutas de imágenes aleatorias -->
                                    <?php
                                    $imagenes_aleatorias = array();

                                    // Ruta base de las imágenes
                                    $ruta_base = "../images/tigers/";

                                    // Generar el arreglo de rutas de imágenes
                                    for ($i = 1; $i <= 15; $i++) {
                                        $ruta_imagen = $ruta_base . "a" . $i . ".png";
                                        $imagenes_aleatorias[] = $ruta_imagen;
                                    }

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
                                                        <pre class="mb-1"><?php echo $comentario['text_Coment']; ?></pre>
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
            </main>
        </div>
    </div>

    <script src="../js/fadeout.js"></script>

    <footer class="animate__animated animate__heartBeat animate__delay-2s py-3 text-light bg-primary">
        <div class="container">
            <p class="mb-1">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
        </div>
    </footer>
</body>

</html>