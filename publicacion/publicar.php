<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BiblioTec - Publicacion</title>

  <!--En esta seccion se incluyen las hojas de estilos-->
  <link rel="icon" href="../images/icons/tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
  <link rel="stylesheet" href="../css/normalizar.css">
  <link rel="stylesheet" href="../css/estilospublicar.css">
  <link rel="stylesheet" href="../css/hover-min.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/sidebars.css">
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
    <div class="container d-flex align-items-center">
      <!-- Logo y título -->
      <div class="logo">
        <img src="../images/icons/flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
        <h4 class="mb-0"><b><span class="col-1">Biblio</span><span class="col-2">Tec</span></h4>
        <form class="position-relative search-field " style="margin-top: -0.8%;">
          <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
          <a href='#'><i class="bi bi-search search-icon"></i></a>

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
            <a class="nav-link align-items-center" name = "fade" href="../home.php" id="letrabar">Inicio</a>
          </li>
          <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" id="letrabardos" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" style="color: black; font-weight: bold;">
              Carreras
            </button>
            <div class="collapse" id="dashboard-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Arquitectura</a></li>
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres">Ingeniería Bioquímica</a></li>
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Civil</a></li>
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Eléctrica</a></li>
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ing. en Gestión Empresarial</a></li>
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ing. en Sistemas Computacionales</a></li>
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Industrial</a></li>
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Mecatrónica</a></li>
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Ingeniería Química</a></li>
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Licenciatura en Administración</a></li>
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
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Mi Perfil</a></li>
                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" id="letrabartres" style="color: black;">Cerrar Sesión</a></li>
              </ul>
            </div>
          </li>
          <hr class="my-2"> <!-- Línea divisora -->
          <li class="mb-1 mt-3">
            <a class="nav-link align-items-center" name ="fade" href="publicacion/publicar.php" id="letrabardos" style="margin-left:10px; 
                 filter: drop-shadow(-1px 2px 3px rgb(255, 231, 2));">Nueva publicación</a>
          </li>
        </ul>
      </div>
      <!-- Contenido principal -->


      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="margin-left: 0.9%;">

        <div class="container" style="margin-top:1vmax; align-items: center;">

          <h2 style=" margin-left: 0.1% ; margin-bottom: 1.2vmax;"><span class="material-symbols-outlined"> library_add </span>
            <b style="margin-left:0.5vmax;" class="textogran">Nueva Publicación</b>
          </h2>

          <form class="row g-3 formulario mt-2 mb-2vmax">
            <div class="col-md-8 mt-0">
              <label for="inputEmail4" class="form-label" id="letraform">Título * :</label>
              <input type="text" class="form-control bs-primary-rgb" style="border-color: rgb(179, 179, 179);">
            </div>
            <div class="col-md-4 mt-0 mb-1">
              <label for="inputPassword4" class="form-label" id="letraform">Usuario * :</label>
              <input class="form-control" style="border-color: rgb(179, 179, 179); font-weight: 500;" type="text" placeholder="@lireramirezve" aria-label="Disabled input example" disabled>
            </div>

            <div class="mb-2 mt-3">
              <label for="exampleFormControlTextarea1" class="form-label" id="letraform">Descripción (en caso de ser Recurso Bibliográfico agregar aqui los datos de referencia) :</label>
              <textarea class="form-control" placeholder="Ej. Autor del libro: Ramirez, M. (2008)" id="floatingTextarea2" style="height: 100px"></textarea>
            </div>

            

            <div class="row g-3 mt-1 mb-2">
              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" id="letraform">Carrera * :</label>
              <div class="col-sm-10">

                <select class="form-select" aria-label="Default select example" style="border-color: rgb(179, 179, 179);">
                  <option selected>Selecciona...</option>
                  <option value="1">Arquitectura</option>
                  <option value="2">Ingeniería Bioquímica</option>
                  <option value="3">Ingeniería Civil</option>
                  <option value="4">Ingeniería Eléctrica</option>
                  <option value="5">Ingenieria en Gestión Empresarial</option>
                  <option value="6">Ingenieria en Sistemas Computacionales</option>
                  <option value="7">Ingeniería Industrial</option>
                  <option value="8">Ingeniería Mecatrónica</option>
                  <option value="9">Ingeniería Química</option>
                  <option value="9">Licenciatura en Administración</option>
                </select>
              </div>
            </div>


            <fieldset class="row g-2 mb-2 mt-2">
              <legend class="col-form-label col-sm-2 pt-0 " id="letraradio" style="margin-left: 0.2%;">Tipo de Publicación* :</legend>
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" style="border-color: rgb(179, 179, 179); margin-left: 2%;" value="option1" checked>
                  <label class="form-check-label" for="gridRadios1" id="letraradio">
                    Recurso Bibliográfico
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" style="border-color: rgb(179, 179, 179); margin-left: 2%;" name="gridRadios" id="gridRadios2" value="option2">
                  <label class="form-check-label" for="gridRadios2" id="letraradio">
                    Trabajos y tareas
                  </label>
                </div>
            </fieldset>
            

            <div class="mb-3 mt-3">
              <label for="formFileLg" class="form-label" id="letraform">Documento* :</label>
              <input class="form-control" type="file" id="formFile" style="border-color: rgb(179, 179, 179);">
            </div>

            <div class="d-grid gap-1 col-6 mx-auto">
              <input class="btn btn-primary btn" type="submit" value="Publicar" id="letrabuton">
            </div>

          </form>
        </div>
      </main>
    </div>
  </div>
  <script src="../js/fadeout.js"></script>
  <footer class="animate__animated animate__heartBeat animate__delay-2s py-3 text-light bg-primary">
    <div class="container">
      <p class="mb-0">&copy; 2024 BiblioTec - Todos los derechos reservados</p>
    </div>
  </footer>
</body>

</html>