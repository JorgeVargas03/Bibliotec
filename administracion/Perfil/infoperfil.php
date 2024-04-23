<?php
include('../../php/functions.php');
$link = include('../../php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

// Inicia la sesión después de cerrar la conexión
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../../index.php"); // Redirigir al usuario al inicio de sesión si no ha iniciado sesión
  exit;
}

// Verificar si se ha enviado una solicitud para cerrar sesión
if (isset($_GET["logout"]) && $_GET["logout"] === "true") {
  // Destruir todas las variables de sesión
  session_unset();

  // Destruir la sesión
  session_destroy();

  // Redirigir al usuario al inicio de sesión
  header("location: ../../index.php");
  exit; 
}


$idUsuario= $_SESSION['idU'];
// Consulta a la base de datos
/*$consulta = "SELECT * FROM publicacion
WHERE carrera_Pub = '$carrera'
ORDER BY idPub DESC LIMIT 3";*/
$consulta = $consulta = "SELECT p.*, u.nom_Us, u.apell_Us FROM publicacion p
                    JOIN usuario u ON p.id_Usuario = u.idUsuario
                    WHERE id_Usuario = '$idUsuario'";

$registros = mysqli_query($link, $consulta); // Utiliza la conexión obtenida desde el archivo de conexión

// Verifica si la consulta se ejecutó correctamente
if (!$registros) {
  die('Error en la consulta: ' . mysqli_error($link));
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Termmina Bootstrap-->
    <!--iconos-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0" />

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
    width: 200px; /* Tamaño fijo para el cuadro */
    height: 100px; /* Tamaño fijo para el cuadro */
    overflow: hidden; /* Para ocultar el texto que desborde el contenedor */
    text-overflow: ellipsis; /* Para mostrar puntos suspensivos (...) cuando el texto desborde el contenedor */
    white-space: nowrap; /* Para evitar que el texto se divida en múltiples líneas */
    display: inline-block;
    margin-right: 20px;
    border: 2px solid #007bff; /* blue border */
    border-radius: 20px; /* oval shape */
    padding: 10px;
    text-align: center;
}

.badge-content {
    margin-top: 10px;
}

.trophy-icon {
    width: 50px; /* adjust size as needed */
    height: 50px; 
}

.badge-title {
    font-weight: bold;
    color: #007bff; /* blue color */
}
        

#guardarBtn, #cancelarBtn {
    background-color: blue;
    color: white;
    border: 2px solid blue;
    border-radius: 8px; /* Agrega bordes curvos */
    padding: 2px 5px; /* Ajusta el espaciado dentro del botón */
    margin-right: 5px; /* Agrega un espacio entre los botones */
    cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
}

#guardarBtn:hover, #cancelarBtn:hover {
    background-color: darkblue; /* Cambia el color de fondo al pasar el cursor sobre el botón */
    border-color: darkblue; /* Cambia el color del borde al pasar el cursor sobre el botón */
}
</style>
</head>

<!--IMAGEN DE CONTACTO-->
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="people-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
        <path fill-rule="evenodd"
            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
    </symbol>
</svg>

<body>
    <header class="bg-primary py-2">
        <div class="container d-flex align-items-center">
            <!-- Logo y título -->
            <div class="logo">
                <img src="..\..\images\icons\flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
                <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span></h4>

                <form class="position-relative search-field " style="margin-top: -0.8%;">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                    <a href='#'><i class="bi bi-search search-icon"></i></a>

                </form>
            </div>
        </div>
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
                    <script>
                        // Obtener parámetros de la URL
                        const urlParams = new URLSearchParams(window.location.search);
                        const username = urlParams.get('username');
                        const photo = urlParams.get('photo');

                        // Actualizar nombre de usuario y foto si los parámetros están presentes
                        if (username && photo) {
                            document.getElementById("username").textContent = username;
                            document.getElementById("profilePic").src = photo;
                        }
                    </script>
                    <h1><img id="profilePic" src="..\..\images\icons\perfil.png"></h1>

<h2>
    <span id="nombreApellido"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?></span>
    <img src="..\..\images\icons\editar.png" height="25" id="editarBtn">
</h2>
<div id="formularioEdicion" style="display: none;">
    <input type="text" id="nuevoNombre" placeholder="Nuevo nombre">
    <input type="text" id="nuevoApellido" placeholder="Nuevo apellido">
    <button id="guardarBtn">Guardar</button>
    <button id="cancelarBtn">Cancelar</button>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const nombreApellido = document.getElementById('nombreApellido');
    const editarBtn = document.getElementById('editarBtn');
    const formularioEdicion = document.getElementById('formularioEdicion');
    const nuevoNombre = document.getElementById('nuevoNombre');
    const nuevoApellido = document.getElementById('nuevoApellido');
    const guardarBtn = document.getElementById('guardarBtn');
    const cancelarBtn = document.getElementById('cancelarBtn');

    // Mostrar formulario de edición al hacer clic en la imagen de edición
    editarBtn.addEventListener('click', function () {
        formularioEdicion.style.display = 'block';
        const nombreApellidoSplit = nombreApellido.textContent.split(' ');
        nuevoNombre.value = nombreApellidoSplit[0];
        nuevoApellido.value = nombreApellidoSplit.slice(1).join(' ');
        nombreApellido.style.display = 'none';
    });

    // Guardar los cambios al hacer clic en el botón de guardar
    guardarBtn.addEventListener('click', function () {
        const nuevoNombreValor = nuevoNombre.value.trim();
        const nuevoApellidoValor = nuevoApellido.value.trim();
        if (nuevoNombreValor !== '' && nuevoApellidoValor !== '') {
            // Aquí puedes enviar los nuevos valores al servidor mediante AJAX o cualquier otra forma
            // Por simplicidad, actualizaremos solo el nombre y apellido en el DOM
            nombreApellido.textContent = nuevoNombreValor + ' ' + nuevoApellidoValor;
            nombreApellido.style.display = 'inline';
            formularioEdicion.style.display = 'none';
        } else {
            alert('Por favor ingresa un nombre y un apellido válidos.');
        }
    });

    // Cancelar la edición al hacer clic en el botón de cancelar
    cancelarBtn.addEventListener('click', function () {
        nombreApellido.style.display = 'inline';
        formularioEdicion.style.display = 'none';
    });
});
</script>
                    
                      

                      
                    


<h5>
    <span id="nombreCarrera"><?php echo $_SESSION['carrera'] ?></span>
    <img src="..\..\images\icons\editar.png" height="25" id="editarBtn" onclick="mostrarCombo()">
</h5>

<div id="comboCarreras" style="display: none;">
    <select id="selectCarrera" onchange="cambiarCarrera()">
        <option value="Arquitectura">Arquitectura</option>
        <option value="Ingeniería Bioquímica">Ingeniería Bioquímica</option>
        <option value="Ingeniería Civil">Ingeniería Civil</option>
        <option value="Ingeniería Eléctrica">Ingeniería Eléctrica</option>
        <option value="Ingeniería en Gestión Empresarial">Ingeniería en Gestión Empresarial</option>
        <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
        <option value="Ingeniería Mecatrónica">Ingeniería Mecatrónica</option>
        <option value="Ingeniería Industrial">Ingeniería Industrial</option>
    </select>
</div>

<script>
    function mostrarCombo() {
        document.getElementById("comboCarreras").style.display = "block";
    }

    function cambiarCarrera() {
        var select = document.getElementById("selectCarrera");
        var carrera = select.options[select.selectedIndex].text;
        // Reemplazar "Ingeniería" por "Ing."
        carrera = carrera.replace("Ingeniería", "Ing.");
        // Actualizar el texto en el span
        document.getElementById("nombreCarrera").textContent = carrera;
        // Ocultar el combo box
        document.getElementById("comboCarreras").style.display = "none";
    }
</script>

                        




                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                        <div class="container mt-3">
                            <hr noshade="noshade"><br>
 <h3>
    <div class="badge">
        <img class="trophy-icon" src="..\..\images\icons\trof.png" alt="Trophy Icon">
        <div class="badge-content">
            <span class="badge-title">Tigre Creativo</span>
        </div>
    </div>
    
    <div class="badge">
        <img class="trophy-icon" src="..\..\images\icons\trof.png" alt="Trophy Icon">
        <div class="badge-content">
            <span class="badge-title">Tigre Contribuidor</span>
        </div>
    </div>
    
    <div class="badge">
        <img class="trophy-icon" src="..\..\images\icons\trof.png" alt="Trophy Icon">
        <div class="badge-content">
            <span class="badge-title">Tigre Pro</span>
        </div>
    </div>
</h3>

                            <hr noshade="noshade"><br>
                            <h3 class="mb-5">Historial de Publicaciones</h3>
                        </div>

                        <?php while ($fila = mysqli_fetch_array($registros)) : ?>
                         <div class="publicacion card mb-3">
                        <div class="card-body">

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-0"> 
                            <a href="editar_interfaz.php" class="btn btn-outline-warning" style="--bs-btn-padding-y: .03rem; --bs-btn-padding-x: .2rem; --bs-btn-font-size: .75rem;">
                            <span class="material-symbols-outlined">
                             edit_square
                            </span>
                            </a>


                             <a href="eliminar_publicacion.php?id=<?php echo $fila['idPub']; ?>" class="btn btn-outline-warning" style="--bs-btn-padding-y: .03rem; --bs-btn-padding-x: .2rem; --bs-btn-font-size: .75rem;">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </a>

                                

                            </div>
                            <h3 class="card-title display-6"><b><?php echo $fila['titulo_Pub']; ?></b></h3>
                            <span class="card-text comment-date mb-0 ">Publicado por: <?php echo $fila['nom_Us'] . " " . $fila['apell_Us']; ?></span>
                            <p class="card-text lead"><?php echo $fila['descrip_Pub']; ?></p>

                            <a name="fade" href="publicacion/publicacion_detalle.php?id=<?php echo $fila['idPub']; ?>" class="btn btn-primary btn-sm"><b>Leer más</b></a>
                        </div>
                        <div class="card-footer d-flex text-muted justify-content-between align-items-end">
                        <span class="badge rounded-pill" style="background-color: #F07B12;">Primary</span>
                            <span class="card-text comment-date mb-0"><?php echo functions::convertirFecha($fila['fecha_Pub']); ?></span>
                        </div>
                         </div>
                     <?php endwhile; ?>
                    </main>
                </div>
        </div>
    </div>
    <footer class="animate__animated animate__heartBeat animate__delay-2s py-3 text-light bg-primary">
        <div class="container">
            <p class="mb-0">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
        </div>
    </footer>
</body>

</html>