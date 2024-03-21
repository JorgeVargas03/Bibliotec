<?php
$link = include('php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

// Consulta a la base de datos
$consulta = "SELECT * FROM publicacion ORDER BY idPub DESC LIMIT 3";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Termmina Bootstrap-->
</head>
<body>
<header class="bg-primary py-2">
        <div class="container d-flex align-items-center">
            <!-- Logo y título -->
            <div class="logo">
                <img src="images/icons/flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
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
    <div class="container-fluid">
        <div class="row">
            <!-- Barra de navegación izquierda -->
            <nav class="col-md-3 col-lg-2 d-md-block bgcol sidebar navbar navbar-expand-md">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="sidebar-sticky">
            <ul class="nav flex-column nav-texto-negro">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php" id="colSide">Inicio</a>
                </li>
                <li class="nav-item dropend bg-orange">
                    <a class="nav-link dropdown-toggle" href="#" id="carrerasDropdown colSide" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Carreras</a>
                    <div class="dropdown-menu" aria-labelledby="carrerasDropdown">
                    <a class="dropdown-item" href="#">Arquitectura</a>
                    <a class="dropdown-item" href="#">Ingeniería Bioquímica</a>
                    <a class="dropdown-item" href="#">Ingeniería Civil</a>
                    <a class="dropdown-item" href="#">Ingeniería Eléctrica</a>
                    <a class="dropdown-item" href="#">Ingeniería en Gestión Empresarial</a>
                    <a class="dropdown-item" href="#">Ingeniería en Sistemas Computacionales</a>
                    <a class="dropdown-item" href="#">Ingeniería Industrial</a>
                    <a class="dropdown-item" href="#">Ingeniería Mecatrónica</a>
                    <a class="dropdown-item" href="#">Ingeniería Química</a>
                    <a class="dropdown-item" href="#">Licenciatura en Administración</a>
                    </div>
                </li>
                <li class="nav-item dropend bg-transparent">
                    <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Perfil</a>
                    <div class="dropdown-menu" aria-labelledby="perfilDropdown">
                        <a class="dropdown-item" href="#">Mi Perfil</a>
                        <a class="dropdown-item" href="#">Editar mi Perfil</a>
                    </div>
                </li>
                <li class="nav-item dropend bg-transparent">
                    <a class="nav-link dropdown-toggle" href="#" id="contactoDropdown colSide" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Contacto</a>
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
        // Array de imágenes disponibles
        $imagenes = ['images/tigers/a1.png', 'images/tigers/a2.png','images/tigers/a3.png'];

        while ($fila=mysqli_fetch_array($registros)){
            // Selecciona una imagen aleatoria de la lista
            $imagen_aleatoria = $imagenes[array_rand($imagenes)];
        ?>
        <div class="publicacion">
            <h3><?php echo ($fila['titulo_Pub']);?></h3>
            <p><?php echo ($fila['descrip_Pub']);?></p>
            <!-- Botón Ver más que despliega los detalles -->
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#detalles<?php echo $fila['idPub']; ?>" aria-expanded="false" aria-controls="detalles<?php echo $fila['idPub']; ?>">
                Ver más
            </button>
            <!-- Detalles de la publicación dentro de un acordeón -->
            <div class="collapse" id="detalles<?php echo $fila['idPub']; ?>">
                <!-- Detalles específicos de la publicación -->
                <div class="card card-body">
                    <!-- Imagen aleatoria como insignia -->
                    <div class="text-center mb-3">
                        <img src="<?php echo $imagen_aleatoria; ?>" class="img-thumbnail" style="max-width: 100px;" alt="Imagen Aleatoria">
                    </div>
                    <p>ID de Usuario: <?php echo $fila['id_Usuario']; ?></p>
                    <p>Fecha de Publicación: <?php echo $fila['fecha_Pub']; ?></p>
                    <p>Calificación: <?php echo $fila['calif_Pub']; ?></p>
                    <p>Carrera: <?php echo $fila['carrera_Pub']; ?></p>
                    <p>Materia: <?php echo $fila['materia_Pub']; ?></p>
                    <p>Tipo de Publicación: <?php echo $fila['tipo_pub']; ?></p>
                    <!-- Si tienes un enlace o archivo adjunto -->
                    <a href="<?php echo $fila['archivo_Pub']; ?>" target="_blank">Ver archivo adjunto</a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</main>
        </div>
    </div>

    <footer class="animate__animated animate__heartBeat animate__delay-2s py-3 text-light bg-primary">
        <div class="container">
            <p class="mb-0">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>