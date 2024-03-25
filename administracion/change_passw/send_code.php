<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar código por correo</title>
    <!--En esta seccion se incluyen las hojas de estilos-->
    <link rel="icon" href="../../images/icons/tigerF.png"><!--Esta seccion de codigo agrega un icono a la pagina-->
    <link rel="stylesheet" href="../../css/estilos.css">
    <!--Inicia Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!--Termina Bootstrap-->
</head>
<body>
<div class="container-fluid bg-primary py-3">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <!-- Logo y título -->
                <div class="col-md-6">
                    <div class="logo d-flex align-items-center">
                        <img src="../../images/icons/flamita.png" alt="Logo T - BiblioTec" class="img-fluid mr-2">
                        <h4 class="mb-0"><b><span class="col-1 text-white">Biblio</span><span class="col-2 text-white">Tec</span></b></h4>
                    </div>
                </div>
                <!-- Botón para volver atrás -->
                <div class="col-md-6 text-right">
                    <a href="../../index.php" class="btn btn-light">Volver</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-center">
                        <h5 class="mb-0 text-white">Enviar código por correo</h5>
                    </div>
                    <div class="card-body">
                        <form id="emailForm" action="validate_mail.php" method="post">
                            <div class="form-group">
                                <label for="email" class="form-label">Para cambiar la contraseña, proporcione el correo electrónico asociado a su cuenta.</label>
                                <input type="email" class="form-control" id="email" placeholder="Correo electrónico" required name="correo">
                            </div>
                            <div class="form-group text-center my-3">
                                <button type="submit" class="btn btn-primary btn-block">Enviar código</button>
                            </div>
                        </form>
                        <?php if(isset($_SESSION['alert_message'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['alert_message']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['alert_message']); ?>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['confirmation_message'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['confirmation_message']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['confirmation_message']); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
