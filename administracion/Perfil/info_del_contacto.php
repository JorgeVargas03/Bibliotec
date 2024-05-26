<?php
include('../../php/functions.php');
$link = include('../../php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

// Inicia la sesión después de cerrar la conexión

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../verifymail/PHPMailer/PHPMailer.php';
require '../verifymail/PHPMailer/Exception.php';
require '../verifymail/PHPMailer/SMTP.php';  

$var = 0;
$resultado = "";
// Verificar si se han enviado datos desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mensaje'])) {
    // Correo del remitente y destinatario


    $remitente = 'bibliotec.team@hotmail.com';
    $destinatario = 'bibliotec.team@hotmail.com';

    // Mensaje obtenido del formulario
    $mensaje = $_POST['mensaje'];

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp-mail.outlook.com'; // Servidor SMTP para Hotmail
        $mail->SMTPAuth   = true;
        $mail->Username   = $remitente; // Correo del remitente
        $mail->Password   = 'BiBliotec0027'; // Contraseña del remitente (reemplaza con tu contraseña)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Configuración del remitente y destinatario
        $mail->setFrom($remitente);
        $mail->addAddress($destinatario);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = "Mensaje desde el formulario";
        $mail->Body   = "OPINION DE USUARIO: <br><br>";
        $mail->Body   .= nl2br($mensaje); // Convertir saltos de línea a <br>

        // Envío del correo
        if ($mail->send()) {
            echo 'success';
            $resultado = "success"; // Envío exitoso
        } else {
            $resultado = "error: " . $mail->ErrorInfo; // Error en el envío
        }
    } catch (Exception $e) {
        // Manejo de errores en el envío del correo
        echo "error: " . $e->getMessage();
    }
} else {
    $var+=1;
    if($var>1)
    echo "error: No se recibieron datos del formulario."; // Datos del formulario no recibidos
}
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

        .form-register {
        position: relative;
    }

    .btn-enviar {
        margin-left: 170px; /* Ajusta el margen izquierdo según sea necesario */
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
    <header class="bg-primary bg-opacity-75 border-bottom border-terciary border-4">
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
            <div class="flex-shrink-0 p-3 border-end border-terciary border-4 bg-body" style="width: 15%;">
                <ul class="list-unstyled" id="menu-lateral">
                    <li class="mb-2 mt-2">
                        <a class="nav-link align-items-center" href="../../home.php" id="letrabar">Inicio</a>
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
                                <li><a href="info_del_contacto.php?" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Información de contacto</a></li>
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
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 bg-body-secondary">
                <div class="contenedor">
                <h1 style="text-decoration: underline;">BiblioTec Support</h1><br>
            <h5 style="width: 160px;">
            <img src="..\..\images\icons\callcenter.png" style="max-width: 100%; height: auto;">
            </h5>
            <h7 style="white-space: pre-line; text-align: center;">
              "¡Tu opinión es fundamental para nosotros!
               Si tienes sugerencias o encuentras algún error, háznoslo saber. 
              Estamos aquí para resolverlo y mejorar gracias a tu ayuda."
            </h7>
            <hr noshade="noshade">
            <h7>
             Enviar al correo: 
             <input id="correo" type="email" value="bibliotec.team@hotmail.com" readonly onclick="mostrarMensaje()">
             <br>
            </h7>
            <script>
             function mostrarMensaje() {
              alert("Este campo no se puede editar.");
             }
            </script>
            <hr noshade="noshade">
            <div id="mensaje-form">
        <div class="form-group justify-content-center">
            <label for="mensaje">Mensaje:</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" cols="50" required></textarea>
        </div><br>
        <button class="btn btn-success btn-sm" type="button" onclick="enviarCorreo()" style = "margin-bottom: 3%">
            <i class="bi bi-envelope-at mr-2"></i> Enviar
        </button>
        </div>

        <div id="mensaje-enviado" style="display: none;">
            <p>El mensaje no pudo ser enviado. Por favor, inténtalo de nuevo más tarde.</p>
        </div>
        <div id="mensaje-error" style="display: none;">
            <p>El mensaje ha sido enviado exitosamente.</p>
        </div>

<script>
function enviarCorreo() {
    var mensaje = document.getElementById("mensaje").value;
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "info_del_contacto.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Si la solicitud se completó con éxito
                document.getElementById("mensaje-form").style.display = "none";
                const res = "<?php echo $resultado ?>";
                if (res == "success") {
                    document.getElementById("mensaje-enviado").style.display = "block";
                } else {
                    document.getElementById("mensaje-error").style.display = "block";
                }
            } else {
                // Si hubo un error en la solicitud
                document.getElementById("mensaje-error").style.display = "block";
            }
        }
    };
    xhr.send("mensaje=" + encodeURIComponent(mensaje));
}
</script>

            </div>

            
            </main>
                                  

        <footer class="py-3 text-light bg-primary bg-opacity-75 border-top border-terciary border-4">
            <div class="container">
                <p class="mb-0">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
            </div>
        </footer>
</body>

</html>