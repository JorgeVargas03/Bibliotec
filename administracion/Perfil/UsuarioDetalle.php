<?php
include('../../php/functions.php');
$link = include('../../php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

// Verificar si se proporcionó un ID de publicación
if (isset($_GET['id'])) {
    // Obtener el ID de la publicación desde el parámetro GET
    $idUs = $_GET['id'];

    // Consultar la base de datos para obtener la información completa de la publicación
    $query = "SELECT u.idUsuario, u.nom_Us, u.apell_Us, u.carrera_Us FROM usuario u WHERE u.idUsuario = $idUs";
    $consulta = "SELECT * FROM publicacion
                            WHERE id_Usuario = '$idUs' and estado_Pub = 1";
    $result = mysqli_query($link, $query);
    $registro = mysqli_query($link, $consulta);
    $usuario = mysqli_fetch_assoc($result);

    // Verificar si se encontró la publicación
    if (mysqli_num_rows($result) == 1) {
        $publicacion = mysqli_fetch_assoc($result);
    } else {
        // Si no se encontró la publicación, redireccionar a la página principal
        header("Location: ../../home.php");
        exit();
    }
} else {
    // Si no se proporcionó un ID de publicación, redireccionar a la página principal
    header("Location: ../../home.php");
    exit();
}

$registros = mysqli_query($link, $consulta); // Utiliza la conexión obtenida desde el archivo de conexión

// Verifica si la consulta se ejecutó correctamente
if (!$registros) {
    die('Error en la consulta: ' . mysqli_error($link));
}

//Consulta e insercion de insignias
$qInsignias = "SELECT idInsignia,`cant` FROM `usuario_insignia` WHERE idUsuario = $idUs ORDER BY idInsignia";

$res = mysqli_query($link,$qInsignias);

$porfavor = array();

if(isset($_POST["agregar"])){
    $idins = $_POST["idin"];
    $qExist = "SELECT * FROM `usuario_insignia` where idUsuario = $idUs and idInsignia=$idins";

    $res2 = mysqli_query($link,$qExist);
    if(mysqli_num_rows($res2) < 1){
        $meter = "INSERT INTO `usuario_insignia` VALUES ($idins,$idUs,1)";

        if(mysqli_query($link,$meter)){
            echo 'todo bien';
            $res = mysqli_query($link,$qInsignias);
        }else{
            echo '<script>
            alert("valio madre");
            window.location = "UsuarioDetalle.php?=$idUs";
             </script>';
        }

    }else{
        $agregar = "UPDATE `usuario_insignia` SET cant = cant+1 where idUsuario = $idUs and idInsignia=$idins";

        if(mysqli_query($link,$agregar)){
            echo 'todo bien';
            $res = mysqli_query($link,$qInsignias);
        }else{
            echo '<script>
            alert("valio madre");
            window.location = "UsuarioDetalle.php?=$idUs";
             </script>';
        }
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($link);

// Iniciar sesión
session_start();

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
                <img src="..\..\images\icons\flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
                <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span></h4>

                <form action="../general_search.php" method="GET" id="searchForm" class="position-relative search-field">
                    <input id="searchInput" name="dataSearch" class="form-control me-2" type="search" autocomplete="off" required placeholder="Buscar" aria-label="Search">
                    <button id="searchButton" type="button">
                    <i class="bi bi-search search-icon"></i>
                    </button>
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
                    <h1><img id="profilePic" src="..\..\images\icons\perfil.png"></h1>

                    <h2>
                        <span id="nombreApellido"><?php echo $usuario['nom_Us'] . " " . $usuario['apell_Us'] ?></span>
                        </a>
                    </h2>

                    <h5>
                        <span id="nombreCarrera"><?php echo $usuario['carrera_Us'] ?></span>
                        </a>
                    </h5>

                    <!-- Modales de edición -->
                    <div class="modal fade" id="editarNombreModal" tabindex="-1" role="dialog" aria-labelledby="editarNombreModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarNombreModalLabel">Editar Nombre</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Contenido del formulario de edición de nombre -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editarCarreraModal" tabindex="-1" role="dialog" aria-labelledby="editarCarreraModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarCarreraModalLabel">Editar Carrera</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Contenido del formulario de edición de carrera -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                        <div class="container mt-2" >
                            <hr noshade="noshade">
                            <h3 class="text-center" style="margin-bottom: 20px;">Insignias</h3>
                            <div class="row row-cols-2 row-cols-md-4 g-6">

                                <div class="col">
                                <div class="card h-100 border-primary ">
                                <img class="card-img-top " src="..\..\images\icons\tigre sabio.PNG" alt="Trophy Icon">
                                    <div class="card-body  text-center">
                                        <span class="card-title border-primary text-center">Tigre Sabio</span><br>
                                        <a class="btn btn-success btn-sm" data-idin="1"><i class='bi bi-plus-circle bi-sm'></i></a>
                                    </div>
                                    <div class="card-footer border-primary text-center">
                                        <?php   
                                            $usInsignias = mysqli_fetch_array($res);
                                            
                                            if($usInsignias!=null ){
                                                if($usInsignias[0]!=1){
                                                    $porfavor = $usInsignias;
                                                    echo 0;
                                                }else{
                                                    echo $usInsignias[1];
                                                }
                                            }else{
                                                echo 0;
                                            }     
                                        ?>
                                    </div>
                                </div>
                                </div>

                                <div class="col">
                                <div class="card h-100 border-primary ">
                                <img class="card-img-top" src="..\..\images\icons\huelladecalidad.PNG" alt="Trophy Icon">
                                    <div class="card-body text-center">
                                        <span class="card-title  text-center">Huella de Calidad</span><br>
                                        <a class="btn btn-success btn-sm" data-idin="2"><i class='bi bi-plus-circle bi-sm'></i></a>
                                    </div>
                                    <div class ="card-footer border-primary text-center">
                                        <?php   
                                            if($porfavor!=null && $porfavor[0]==2){
                                                echo $porfavor[1];
                                            }else{
                                                $usInsignias = mysqli_fetch_array($res);
                                                if($usInsignias!=null ){
                                                    if($usInsignias[0]!=2){
                                                        $porfavor = $usInsignias;
                                                        echo 0;
                                                    }else{
                                                        echo $usInsignias[1];
                                                    }
                                                }else{
                                                    echo 0;
                                                } 
                                            }
                                        ?>
                                    </div>
                                </div>
                                </div>

                                <div class="col">
                                <div class="card h-100 border-primary ">
                                <img class="card-img-top" src="..\..\images\icons\tigre Amigo.PNG" alt="Trophy Icon">
                                    <div class="card-body text-center">
                                        <span class="card-title">Tigre Amigo</span><br>
                                        <a class="btn btn-success btn-sm" data-idin="3"><i class='bi bi-plus-circle bi-sm'></i></a>
                                    </div>
                                    <div class ="card-footer border-primary text-center">
                                        <?php   
                                            if($porfavor!=null && $porfavor[0]==3){
                                                echo $porfavor[1];
                                            }else{
                                                $usInsignias = mysqli_fetch_array($res);
                                                if($usInsignias!=null ){
                                                    if($usInsignias[0]!=3){
                                                        $porfavor = $usInsignias;
                                                        echo 0;
                                                    }else{
                                                        echo $usInsignias[1];
                                                    }
                                                }else{
                                                    echo 0;
                                                } 
                                            }    
                                        ?>
                                    </div>
                                </div>
                                </div>

                                <div class="col">
                                <div class="card h-100 border-primary ">
                                <img class="card-img-top" src="..\..\images\icons\tigre veterano.png" alt="Trophy Icon">
                                    <div class="card-body text-center">
                                        <span class="card-title">Tigre Veterano</span><br>
                                        <a class="btn btn-success btn-sm" data-idin="4"><i class='bi bi-plus-circle bi-sm'></i></a>
                                    </div>
                                    <div class ="card-footer border-primary text-center">
                                        <?php   
                                            if($porfavor!=null && $porfavor[0]==4){
                                                echo $porfavor[1];
                                            }else{
                                                $usInsignias = mysqli_fetch_array($res);
                                                if($usInsignias!=null ){
                                                    if($usInsignias[0]!=4){
                                                        $porfavor = $usInsignias;
                                                        echo 0;
                                                    }else{
                                                        echo $usInsignias[1];
                                                    }
                                                }else{
                                                    echo 0;
                                                } 
                                            }    
                                        ?>
                                    </div>
                                </div>
                                </div>

                            </div> <!-- row de las insignias(cards) -->
                        </div><!-- otras cosas -->
                        <script>
                            $(document).ready(function(){
                                var idin;
                                $(".btn-success").click(function(){
                                    idin = $(this).data('idin');
                                    console.log(idin);
                                    $.ajax({
                                        URL: "UsuarioDetalle.php",
                                        method:"POST",
                                        data: {idin:idin,agregar:1},
                                        success:function(r){
                                            $(this).disabled = true;
                                            console.log("SI");
                                            
                                        }
                                    });

                                });
                            });
                        </script>




                        <hr noshade="noshade"><br>
                        <h3 class="mb-5">Publicaciones de <?php echo $usuario['nom_Us'] . " " . $usuario['apell_Us'] ?></h3>
                </div>

                <?php while ($fila = mysqli_fetch_array($registro)) : ?>
                    <div class="publicacion card mb-3">
                        <div class="card-body">

                            <!-- Boton editar -->

                            <h3 class="card-title display-6"><b><?php echo $fila['titulo_Pub']; ?></b></h3>

                            <p class="card-text lead"><?php echo $fila['descrip_Pub']; ?></p>

                            <a name="fade" href="../../publicacion/publicacion_detalle.php?id=<?php echo $fila['idPub']; ?>" class="btn btn-primary btn-sm"><b>Leer más</b></a>
                        </div>
                        <div class="card-footer d-flex text-muted justify-content-between align-items-end">
                            <span class="card-text comment-date mb-0 ">Publicado por: <?php echo $usuario['nom_Us'] . " " . $usuario['apell_Us']; ?></span>
                            <span class="card-text comment-date mb-0"><?php echo functions::convertirFecha($fila['fecha_Pub']); ?></span>
                        </div>
                    </div>
                <?php endwhile; ?>
            </main>
            </main>
            <div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal.dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Confirmar Eliminar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p> ¿Estas seguro de querer eliminar esta publicación?</p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" id="ConfirmarEliminar">Eliminar</button>
                            </div>
                        </div>
                    </div>
                    <script src="../../publicacion/eliminar2.js">
                    </script>
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