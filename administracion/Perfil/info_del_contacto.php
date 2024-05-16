<?php
include('../../php/functions.php');
$link = include('../../php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

// Inicia la sesión después de cerrar la conexión
session_start();





// Cierra la conexión después de realizar la consulta
mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioTec - Home</title>

    <!--En esta seccion se incluyen las hojas de estilos-->
    <link rel="icon" href="../../images\icons\tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
    <link rel="stylesheet" href="../../css/normalizar.css">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/hover-min.css">
    <link rel="stylesheet" href="../../css/animate.css">
    <link rel="stylesheet" href="../../css/sidebars.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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

    <style>
        .contenedor {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .imagen {
            height: 180px;
            margin-right: 93px;
        }

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 300,
                'GRAD' 0,
                'opsz' 22
        }
    </style>

    <style>
        .badge {
            width: 200px;
            /* Tamaño fijo para el cuadro */
            height: 180px;
            /* Tamaño fijo para el cuadro */
            overflow: hidden;
            /* Para ocultar el texto que desborde el contenedor */
            text-overflow: ellipsis;
            /* Para mostrar puntos suspensivos (...) cuando el texto desborde el contenedor */
            white-space: nowrap;
            /* Para evitar que el texto se divida en múltiples líneas */
            display: inline-block;
            margin-right: 20px;
            border: 2px solid #007bff;
            /* blue border */
            border-radius: 20px;
            /* oval shape */
            padding: 10px;
            text-align: center;
        }

        .badge-content {
            margin-top: 20px;
        }

        .trophy-icon {
            width: 120px;
            height: 120px;
        }

        .badge-title {
            font-weight: bold;
            color: #007bff;
        }


        #guardarBtn,
        #cancelarBtn {
            background-color: blue;
            color: white;
            border: 2px solid blue;
            border-radius: 8px;
            padding: 2px 5px;
            margin-right: 5px;
            cursor: pointer;
        }

        #guardarBtn:hover,
        #cancelarBtn:hover {
            background-color: darkblue;
            border-color: darkblue;
        }
    </style>
</head>

<!--IMAGEN DE CONTACTO-->
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="people-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
    </symbol>
</svg>

<body>
    <header class="bg-primary py-2">
        <div class="container d-flex align-items-center">
            <!-- Logo y título -->
            <div class="logo">
                <img src="../../images/icons/flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
                <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span></h4>

                <!-- BARRA DE BUSQUEDA  -->
            </div>
            <form action="../general_search.php" method="GET" id="searchForm" class="position-relative search-field">
                <input id="searchInput" name="dataSearch" class="form-control me-2" type="search" autocomplete="off" required placeholder="Buscar" aria-label="Search">
                <button id="searchButton" type="button">
                    <i class="bi bi-search search-icon"></i>
                </button>
            </form>
    </header>


    <div class="container-fluid">
        <div class="row">
            <!-- Barra de navegación izquierda -->
            <div class="flex-shrink-0 p-3" style="width: 15%; background-color: #F07B12;">
                <ul class="list-unstyled" id="menu-lateral">
                    <li class="mb-2 mt-2">
                        <a class="nav-link align-items-center" href="../../home.php" id="letrabar" style="filter: drop-shadow(-1px 2px 3px rgb(255, 231, 9));">Inicio</a>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" style="color: black; font-weight: bold;">
                            Carreras
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="../search.php?carrera=Arquitectura" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Arquitectura</a></li>
                                <li><a href="../search.php?carrera=Ing. Bioquimica" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Ingeniería Bioquímica</a></li>
                                <li><a href="../search.php?carrera=Ing. Civil" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Civil</a></li>
                                <li><a href="../search.php?carrera=Ing. Electrica" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Eléctrica</a></li>
                                <li><a href="../search.php?carrera=Ing. Gestion Empresarial" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ing. en Gestión Empresarial</a></li>
                                <li><a href="../search.php?carrera=Ing. Sistemas Computacionales" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ing. en Sistemas Computacionales</a></li>
                                <li><a href="../search.php?carrera=Ing. Industrial" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Industrial</a></li>
                                <li><a href="../search.php?carrera=Ing. Mecatronica" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Mecatrónica</a></li>
                                <li><a href="../search.php?carrera=Ing. Quimica" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Química</a></li>
                                <li><a href="../search.php?carrera=Lic. Administracion" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Licenciatura en Administración</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" data-bs-toggle="collapse" data-bs-target="#contacto-collapse" aria-expanded="false" style="color: black; font-weight: bold;">
                            Contacto
                        </button>
                        <div class="collapse" id="contacto-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="administracion/Perfil/info_del_contacto.php?" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Información de contacto</a></li>
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
                                <li><a href="infoperfil.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Mi Perfil</a></li>
                                <a href="../../home.php?logout=true" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Cerrar Sesión</a>
                            </ul>
                        </div>
                    </li>
                    <hr class="my-2"> <!-- Línea divisora -->
                    <li class="mb-1 mt-3">
                        <a class="nav-link align-items-center" name="fade" href="../../publicacion/publicar.php" id="letrabardos" style="margin-left:10px">Nueva publicación</a>
                    </li>

                    <hr class="my-2"> <!-- Línea divisora -->
                    <li class="mb-1 mt-3">
                        <a class="nav-link align-items-center" href="#" id="letrabardos" style="margin-left:10px"><?php echo "Hola " . $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?></a>
                    </li>
                </ul>
            </div>

            <!-- Contenido principal -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="contenedor">
            <h1>Soporte BiblioTec </h1>
            <hr noshade="noshade">
            <h7>Envianos sugerencias o platicanos algun error 
                que tengamos para porder resolverlo</h7>
            <hr noshade="noshade">
            <h7>Enviar al correo: <input type="email" value="bibliotec.team@hotmail.com" readonly><br></h7>
            <hr noshade="noshade">
            <form class="form-register" action="https://formspree.io/f/xayrkvya" method="POST">
    <textarea id="texto" name="mensaje" rows="5" cols="50"></textarea><br>
    <button class="btn btn-success btn-sm" type="submit">
        <i class="bi bi-envelope-at mr-2"></i> Enviar
    </button>
</form>

<script>
function enviarFormulario() {
    // Guardar el contenido del textarea antes de enviar el formulario
    var mensaje = document.getElementById('texto').value;
    
    // Abrir la página del formulario en una nueva pestaña
    window.open('https://formspree.io/f/xkndeyno');
    
    // Limpiar el contenido del textarea
    document.getElementById('texto').value = '';
}
</script>

            </div>

            
            </main>
                                  

        <footer class="animate__animated animate__heartBeat animate__delay-2s py-3 text-light bg-primary">
            <div class="container">
                <p class="mb-0">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
            </div>
        </footer>
</body>

</html>