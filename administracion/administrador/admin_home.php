<?php
include('../../php/functions.php');
$link = include('../../php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

// Consulta a la base de datos
$consulta = "SELECT p.*, u.nom_Us, u.apell_Us FROM publicacion p
              JOIN usuario u ON p.id_Usuario = u.idUsuario
              WHERE estado_Pub = 0
              ORDER BY p.idPub ASC";
$registros = mysqli_query($link, $consulta); // Utiliza la conexión obtenida desde el archivo de conexión

// Verifica si la consulta se ejecutó correctamente
if (!$registros) {
  die('Error en la consulta: ' . mysqli_error($link));
}

// Cierra la conexión después de realizar la consulta
mysqli_close($link);

// Inicia la sesión después de cerrar la conexión
session_start();


// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["rol"] !== "admin") {
  header("location: ../../index.php");
  exit;
}

// Verificar si se ha enviado una solicitud para cerrar sesión
if(isset($_GET["logout"]) && $_GET["logout"] === "true") {
  // Destruir todas las variables de sesión
  session_unset();
  
  // Destruir la sesión
  session_destroy();
  
  // Redirigir al usuario al inicio de sesión
  header("location: ../../index.php");
  exit;
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BiblioTec - AdminHome</title>

  <!--En esta seccion se incluyen las hojas de estilos-->
  <link rel="icon" href="../../images\icons\tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
  <link rel="stylesheet" href="../../css/normalizar.css">
  <link rel="stylesheet" href="../../css/estilos.css">
  <link rel="stylesheet" href="../../css/hover-min.css">
  <link rel="stylesheet" href="../../css/animate.css">
  <link rel="stylesheet" href="../../css/sidebars.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!--Inicia Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
    <div class="container" style="margin-left:7.8vmax;" >
      <!-- Logo y título -->
      <div class="logo">
        <img src="../../images/icons/flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
        <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span></h4>
    </div>
  </header>

  <div class="container-fluid" >
    <div class="row" >
        <!-- Barra de navegación izquierda -->
        <div class="flex-shrink-0 p-3 hola" style="width: 15%; background-color: #F07B12; ">
            <ul class="list-unstyled" id="menu-lateral" style="padding-bottom: 300px">
            <li class="mb-1">
                  <a class="nav-link align-items-center" href="admin_home.php" id="letrabardos" style="margin-left:10px">Publicaciones Pendiendes</a>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" style="color: black; font-weight: bold;">
                      Reportes
                    </button>
                    <div class="collapse" id="dashboard-collapse">
                      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="rep_comentario_pendiente.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Comentarios</a></li>
                        <li><a href="rep_publicacion_pendiente.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Publicaciones</a></li>
                      </ul>
                    </div>
                  </li>
                <hr class="my-2"> <!-- Línea divisora -->
                <li class="mb-1">
                    <button class="btn d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" style="color: black; font-weight: bold;">
                    <a class="nav-link align-items-center" href="admin_home.php?logout=true" id="letrabar">Cerrar sesión</a>
                    </button>
                </li>
                <hr class="my-2"> <!-- Línea divisora -->
                <li class="mb-1">
                  <a class="nav-link align-items-center" href="stats.php" id="letrabardos" style="margin-left:10px">Estadísticas de BiblioTec</a>
                </li>
            </ul>
        </div>
      
      <!-- Contenido principal -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-2">
      <div class="container mt-2 mb-3">
          <h2 style="user-select: none;font-size: 2vmax;text-shadow: 2px 2px 4px rgba(114, 114, 114, 0.4);
          margin-top: 0.5vmax;"><b>Publicaciones pendientes</b></h2>
          <?php while ($fila = mysqli_fetch_array($registros)) : ?>
            <div class="publicacion card mb-4 mt-4">
              <div class="card-body ">
              <div class="card-header d-flex justify-content-between align-items-end" style="background-color: #F7C200; color: #000000;">
                Pendiente 
                 <a class="col-sm-1.5" style="background-color: #2A88FF ; color: #FFFFFF;" name="fade" href="publicacion_pendiente.php?id=<?php echo ($fila['idPub']); ?>" class="btn btn-primary btn-sm">
                Revisar</a>
                </div>
                <h3 class="card-title display-6 mt-2"><b><?php echo $fila['titulo_Pub']; ?></b></h3>
                <p class="card-text lead"><?php echo $fila['descrip_Pub']; ?></p>
              </div>
              <div class="card-footer d-flex text-muted justify-content-between align-items-end">
                <span class="card-text comment-date mb-0">Publicado por: <?php echo $fila['nom_Us'] . " " . $fila['apell_Us']; ?></span>
                <span class="card-text comment-date mb-0">Fecha de publicación: <?php echo functions::convertirFecha($fila['fecha_Pub']); ?></span>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </main>
    </div>
  </div>

  <script src ="../../js/fadeout.js">
  </script>

  <footer class="animate__animated animate__heartBeat animate__delay-2s py-3 text-light bg-primary">
        <div class="container" >
            <p class="mb-1">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
        </div>
    </footer>
  
</body>

</html>