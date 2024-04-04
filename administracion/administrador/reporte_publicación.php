<?php
$link = include('../../php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

// Consulta a la base de datos
$consulta = "SELECT * FROM publicaciones_pendientes ORDER BY idPub DESC LIMIT 3";
$registros = mysqli_query($link, $consulta); // Utiliza la conexión obtenida desde el archivo de conexión

// Verifica si la consulta se ejecutó correctamente
if (!$registros) {
  die('Error en la consulta: ' . mysqli_error($link));
}

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
       //header("Location: ../home.php");
        exit();
    }
} else {
    // Si no se proporcionó un ID de publicación, redireccionar a la página principal
    //header("Location: ../home.php");
    exit();
}

// Cierra la conexión después de realizar la consulta
mysqli_close($link);

// Inicia la sesión después de cerrar la conexión
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotec - Reporte publicación</title>

   

    <!--En esta seccion se incluyen las hojas de estilos-->
    <link rel="icon" href="../../images/icons/tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
    <link rel="stylesheet" href="../../css/normalizar.css">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/hover-min.css">
    <link rel="stylesheet" href="../../css/animate.css">
    <link rel="stylesheet" href="../../css/sidebars.css">
    <link rel="stylesheet" href="../../publicacion/style.css">
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
        <div class="container" style="margin-left:7.8vmax;">
            <!-- Logo y título -->
            <div class="logo col-5" >
                <img src="../../images/icons/flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
                <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span>
                <span>- Reportes publicación</span></b></h4>
            </div>
    </header>

    <div class="container-fluid" >
        <div class="row" >
            <!-- Barra de navegación izquierda -->
            <div class="flex-shrink-0 p-3 hola" style="width: 15%; background-color: #F07B12; ">
                <ul class="list-unstyled" id="menu-lateral">
                    <li class="mb-1">
                        <button class="btn d-inline-flex align-items-start rounded border-5 col-1" id="letrabardos"  style="color: black; font-weight: bold;">
                            Publicaciones Pendientes
                        </button>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" style="color: black; font-weight: bold;">
                          Reportes
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Comentarios</a></li>
                            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Publicaciones</a></li>
                          </ul>
                        </div>
                      </li>
                    <hr class="my-2"> <!-- Línea divisora -->
                    <li class="mb-1">
                        <button class="btn d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" style="color: black; font-weight: bold;">
                            <span style="margin-top:0.3vmax; margin-left: 0.4vmax;">Cerrar Sesión</span>
                        </button>
                    </li>
                    <hr class="my-2"> <!-- Línea divisora -->
                </ul>
            </div>
            
            <!-- Contenido principal -->


            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="font-weight:normal; margin-left: 1%;">
                
                    <div class="container mt-5 mb-5" >
                        <div class="row" >
                            <div class="col-md-11" style="margin-left: 4%;">
                                <!-- Detalles de la publicación -->
                                <div class="card card-details" style="background-color: rgba(255, 0, 0, 0.13);">
                                    <div class="card-header " style="background-color: rgb(167, 4, 4);">
                                    </div>
                                    
                                    <!-- Botón para ver archivo adjunto -->
                                    <div class="row">
                                        <div class="col mt-1 mb-2" >
                                            <h3 class="pl-1  mb-2" style="margin-left: 2vmax;"> Reporte de publicación</h3>
                                            <h5><Span style="margin-left: 2vmax;"><b>Tipo de reporte: </b></Span><span>Tiene: XXXx</span></h5> 
                                        </div>
                                        <div class="col text-end mt-4 mb-3  align-items-end" style="margin-right: 2vmax;">
                                            <a href="#"  class="btn btn-success btn-sm">
                                                <i class="bi bi-check2 mr-2"></i> Rechazar reporte
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash3 mr-2"></i> Eliminar publicacion
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--PUBLICACIÓN-->


                    <div class="container mt-4 mb-5">
                        <div class="row" >
                            <div class="col-md-8" style="width: 92%; margin-left: 4%;">
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


            </main>
    

   
     <script src ="../../js/fadeout.js"></script>
            
     <footer class="animate__animated animate__heartBeat animate__delay-2s py-3 text-light bg-primary">
        <div class="container" >
            <p class="mb-1">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>