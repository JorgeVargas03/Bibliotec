<?php
$link = include('php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

// Consulta a la base de datos
$consulta = "SELECT titulo_Pub, descrip_Pub FROM publicacion";
$registros = mysqli_query($link, $consulta); // Utiliza la conexión obtenida desde el archivo de conexión

// Verifica si la consulta se ejecutó correctamente
if (!$registros) {
    die('Error en la consulta: ' . mysqli_error($link));
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
    <title>BiblioTec - Home</title>

    <!--En esta seccion se incluyen las hojas de estilos-->
    <link rel="icon" href="images/icons/tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
    <link rel="stylesheet" href="css/normalizar.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/hover-min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!--Inicia Bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!--Termmina Bootstrap-->
</head>
<body>
    <header>
    <div class="menu-mobile">
    <div class="cabecera navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="barra navbar-brand">
          <a href="#" class="logo">
            <img src="images/icons/flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
            <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span></h4>
          </a>
        </div>
    </div>
    </div>
    </header>
    <!--Aqui se muestra un apartado para los productos que se venderan-->
    <div class="container-fluid">
        <div class="row">
            <!-- Barra de navegación izquierda -->
        <nav class="col-md-3 col-lg-2 d-md-block bgcol sidebar navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">
        <div class="sidebar-sticky">
            <ul class="nav flex-column nav-texto-negro">
                <li class="nav-item active">
                    <a class="nav-link" href="#" id="colSide">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle bg-orange" href="#" id="carrerasDropdown colSide" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Carreras</a>
                    <div class="dropdown-menu" aria-labelledby="carrerasDropdown">
                        <a class="dropdown-item" href="#">Carrera 1</a>
                        <a class="dropdown-item" href="#">Carrera 2</a>
                        <a class="dropdown-item" href="#">Carrera 3</a>
                    </div>
                </li>
                <li class="nav-item dropdown bg-transparent">
                    <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Perfil</a>
                    <div class="dropdown-menu" aria-labelledby="perfilDropdown">
                        <a class="dropdown-item" href="#">Editar Perfil</a>
                        <a class="dropdown-item" href="#">Cambiar Contraseña</a>
                    </div>
                </li>
                <li class="nav-item dropdown bg-transparent">
                    <a class="nav-link dropdown-toggle" href="#" id="contactoDropdown colSide" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Contacto</a>
                    <div class="dropdown-menu" aria-labelledby="contactoDropdown">
                        <a class="dropdown-item" href="#">Información de Contacto</a>
                        <a class="dropdown-item" href="#">Formulario de Contacto</a>
                    </div>
                </li>
            </ul>
            </div>
            </div>
            </nav>

            <!-- Contenido principal -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="container mt-3">
                    <h2>Últimas Publicaciones</h2>
                    <?php
                    while ($fila=mysqli_fetch_array($registros)){
                        ?>
                    <div class="publicacion">
                        <h3><?php echo ($fila['titulo_Pub']);?></h3>
                        <p><?php echo ($fila['descrip_Pub']);?></p>
                        <a href="#">Ver más</a>
                    </div>
                    <?php
                    }
                    ?>
                    <!-- Contenido principal 
                    <div class="publicacion">
                        <h3>Título de la Publicación 2</h3>
                        <p>Descripción breve de la publicación.</p>
                        <a href="#">Ver más</a>
                    </div>
                    <div class="publicacion">
                        <h3>Título de la Publicación 3</h3>
                        <p>Descripción breve de la publicación.</p>
                        <a href="#">Ver más</a>
                    </div>-->
                </div>
            </main>
        </div>
    </div>

    <footer class="animate__animated animate__heartBeat animate__delay-2s py-3 text-light bg-primary">
        <div class="container">
            <p class="mb-0">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>