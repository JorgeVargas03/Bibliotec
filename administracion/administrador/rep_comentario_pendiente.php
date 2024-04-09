<?php
$link = include('../../php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

// Consulta a la base de datos
$query_rc = "SELECT * FROM 	reportecomentario ORDER BY idReporteCom DESC LIMIT 3";
$query_c = "SELECT * FROM comentario WHERE idComent IN (SELECT idComent FROM reportecomentario)";
$query_u = "SELECT nom_Us, apell_Us FROM usuario WHERE idUsuario = (SELECT idUsuario FROM comentario WHERE idComent IN (SELECT idComent FROM reportecomentario))";
$registros_rc = mysqli_query($link, $query_rc); // Utiliza la conexión obtenida desde el archivo de conexión
$registros_c = mysqli_query($link, $query_c);
$registros_u = mysqli_query($link, $query_u);
// Verifica si la consulta se ejecutó correctamente
if (!$registros_rc) {
  die('Error en la consulta: ' . mysqli_error($link));
}
if (!$registros_c) {
  die('Error en la consulta: ' . mysqli_error($link));
}
if (!$registros_u) {
  die('Error en la consulta: ' . mysqli_error($link));
}
// Cierra la conexión después de realizar la consulta
mysqli_close($link);

// Inicia la sesión después de cerrar la conexiónE
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador - Reportes</title>

  <!--En esta seccion se incluyen las hojas de estilos-->
  <link rel="icon" href="../../images/icons/tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
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
            </ul>
        </div>
      
      <!-- Contenido principal -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <!-- REPORTE PUBLICACION -->
        <div class="container mt-3">
          <h2 style="user-select: none;font-size: 2vmax;text-shadow: 2px 2px 4px rgba(114, 114, 114, 0.4);
          margin-top: 0.5vmax;"><b>Comentarios Reportados</b></h2>
          <?php
          while ($fila = mysqli_fetch_array($registros_rc) and $fila2 = mysqli_fetch_array($registros_c) and $fila3 = mysqli_fetch_array($registros_u)) {
          ?>
            <div class="publicacion reportada">
              <p>Usuario: <?php echo $fila3['nom_Us']; ?>  <?php echo $fila3['apell_Us'];?></p>
              <p>Comentario: <?php echo ($fila2['text_Coment']); ?></p>
              <p>Motivo: <?php echo ($fila['motivo_Report']); ?></p>
              <p>Fecha de Reporte: <?php echo ($fila['fecha_Report']); ?></p>
              <!-- Botón Ver más que despliega los detalles -->
              <!-- Botón Ver más que redirige a la página de detalles de la publicación -->
              <a name ="fade" href="reporte_comentario.php?id=<?php echo $fila['idComent']; ?>" class="btn btn-primary">Revisar</a>
              <!-- Detalles de la publicación dentro de un acordeón -->
              <!-- AQUI ESTABAN LOS DETALLES DE LA PUBLICACION -->
            </div>
          <?php
          }
          ?>
        </div>
      </main>
    </div>
  </div>

  <script src ="../../js/fadeout.js"></script>

  <footer class="animate__animated animate__heartBeat animate__delay-2s py-3 text-light bg-primary">
        <div class="container" >
            <p class="mb-1">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>