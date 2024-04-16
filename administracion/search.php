<?php
include('../php/functions.php');
$link = include('../php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

// Consulta a la base de datos

// Verifica si la consulta se ejecutó correctamente

if (isset($_GET['carrera'])) {
  // Obtener el ID de la publicación desde el parámetro GET
  $carrera = $_GET['carrera'];

  // Consultar la base de datos para obtener la información completa de la publicación
  $consulta = "SELECT p.*, u.nom_Us, u.apell_Us FROM publicacion p
              JOIN usuario u ON p.id_Usuario = u.idUsuario
              WHERE carrera_Pub = '$carrera'
              ORDER BY p.idPub";
  $consulta2 = "SELECT DISTINCT materia_Pub from publicacion WHERE carrera_Pub = '$carrera'";
  $result = mysqli_query($link, $consulta);
  $result2 = mysqli_query($link, $consulta2);
} else {
  // Si no se proporcionó un ID de publicación, redireccionar a la página principal
  header("Location: ../home.php");
  exit();
}


// Cierra la conexión después de realizar la consulta
mysqli_close($link);

// Inicia la sesión después de cerrar la conexión
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BiblioTec - Búsqueda</title>

  <!--En esta seccion se incluyen las hojas de estilos-->
  <link rel="icon" href="../images/icons/tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
  <link rel="stylesheet" href="../css/normalizar.css">
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" href="../css/hover-min.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/sidebars.css">
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
    <div class="container d-flex align-items-center">
      <!-- Logo y título -->
      <div class="logo">
        <img src="../images/icons/flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
        <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span></h4>
        <form class="position-relative search-field " style="margin-top: -0.8%;">
          <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
          <a href='search.php'><i class="bi bi-search search-icon"></i></a>

        </form>
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
            <a class="nav-link align-items-center" href="../home.php" id="letrabar">Inicio</a>
          </li>
          <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" style="color: black; font-weight: bold;">
              Carreras
            </button>
            <div class="collapse" id="dashboard-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="search.php?carrera=Arquitectura" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Arquitectura</a></li>
                <li><a href="search.php?carrera=Ing. Bioquimica" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Ingeniería Bioquímica</a></li>
                <li><a href="search.php?carrera=Ing. Civil" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Civil</a></li>
                <li><a href="search.php?carrera=Ing. Electrica" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Eléctrica</a></li>
                <li><a href="search.php?carrera=Ing. Gestion Empresarial" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ing. en Gestión Empresarial</a></li>
                <li><a href="search.php?carrera=Ing. Sistemas Computacionales" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ing. en Sistemas Computacionales</a></li>
                <li><a href="search.php?carrera=Ing. Industrial" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Industrial</a></li>
                <li><a href="search.php?carrera=Ing. Mecatronica" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Mecatrónica</a></li>
                <li><a href="search.php?carrera=Ing. Quimica" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Química</a></li>
                <li><a href="search.php?carrera=Lic. Administracion" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Licenciatura en Administración</a></li>
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
                <li><a href="Perfil/infoperfil.html" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Mi Perfil</a></li>
                <li><a href="../home.php?logout=true" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Cerrar Sesión</a></li>
              </ul>
            </div>
          </li>
          <hr class="my-2"> <!-- Línea divisora -->
          <li class="mb-1 mt-3">
            <a class="nav-link align-items-center" name ="fade" href="publicacion/publicar.php" id="letrabardos" style="margin-left:10px">Nueva publicación</a>
          </li>
        </ul>
      </div>
      <!-- Contenido principal -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <br>  
      <div class="container">
          <h2>Búsqueda</h2>
          <form>
            <div class="row align-items-center justify-content-center">
              <div class="col-md-5 mb-3">
                <label for="categorySelect" class="form-label">Materia</label>
                <select class="form-select" id="categorySelect">
                  <option selected>Seleccione una categoría...</option>
                  <?php 
                    $contador = 1;
                    while ($fila2 = mysqli_fetch_array($result2)) : ?>
                      <option value=<?php $contador?>><?php echo $fila2['materia_Pub']; ?></option>
                    <?php $contador++; ?>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="col-md-5 mb-3">
                <label for="categorySelect" class="form-label">Tipo de Recurso</label>
                <select class="form-select" id="categorySelect">
                  <option selected>Seleccione una categoría...</option>
                  <option value="1">Apuntes y Tareas</option>
                  <option value="2">Recursos Bibliográficos</option>
                </select>
              </div>
          </form>
        <div class="d-flex justify-content-center align-items-center mb-3">
            <button type="submit" class="btn btn-primary px-4">Buscar</button>
        </div>
        <br> 
        </div>
                <!--Esta parte contiene los aportes coincidentes-->
        <div>
        <?php while ($fila = mysqli_fetch_array($result)) : ?>
            <div class="publicacion card mb-4">
              <div class="card-body">
                <h3 class="card-title display-6"><b><?php echo $fila['titulo_Pub']; ?></b></h3>
                <p class="card-text lead"><?php echo $fila['descrip_Pub']; ?></p>
                <a name="fade" href="publicacion/publicacion_detalle.php?id=<?php echo $fila['idPub']; ?>" class="btn btn-primary btn-sm"><b>Leer más</b></a>
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
  </main>
    </div>
  </div>
  
  <script src ="js/fadeout.js"></script>
  <footer class="animate__animated animate__heartBeat animate__delay-2s py-3 text-light bg-primary">
    <div class="container">
      <p class="mb-1">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
    </div>
  </footer>
  
</body>

</html>