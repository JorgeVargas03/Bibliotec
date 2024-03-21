<?php

include '..\php\conexion.php';//$link variable de conexion

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$contrasena = $_POST['contra'];
$repcon = $_POST['repContra'];
$semestre = $_POST['semestre'];
$carrera = $_POST['carrera'];

//validar correo
$regex = "/^([a-zA-Z0-9\.]+@ittepic(\.)edu(\.)mx)$/";
if(!preg_match($regex,$correo)){
    //$_SESSION["alert_message"]=;
    echo '<script>
        alert("Correo no válido");
        window.history.back();
    </script>';
    exit;
}

//VERIFICAR SI YA EXISTE O ESTA REGISTRADO ESE CORREO
$existe_correo = mysqli_query($link,"SELECT * FROM `usuario` WHERE `correo_Us` = '$correo'");
if(mysqli_num_rows($existe_correo) > 0){
    //$_SESSION["alert_message"]=;
    echo '<script>
        alert("Este correo ya esta registrado, intente con uno diferente o inicie sesión");
        window.history.back();
    </script>';
    exit;
}

//validar contraseñas
//$regex2 = "/^([a-zA-Z0-9]{8, })$/"; preg_match($regex2,$contrasena) //para despues
if(strcmp($contrasena,$repcon) === 0){
    //encripta si son iguales las contraseñas
    $contrasena = hash('sha512',$contrasena);
}else{
    echo '<script>
        alert("Las contraseñas no coinciden");
        window.history.back();
    </script>';
    exit;
}

//En esta parte, si todo salio bien, se guardan los datos correctos
$query = "INSERT INTO `usuario`( `nom_Us`, `apell_Us`, `carrera_Us`, `semestre_Us`, `correo_Us`, `contra_Us`) 
VALUES ('$nombre','$apellidos','$carrera','$semestre','$correo','$contrasena')";

$ejecutar = mysqli_query($link,$query);

if($ejecutar){
    echo '<script>
        alert("Registro completado exitosamente");
        window.location = "../index.php";
    </script>';
}else{
    echo '<script>
        alert("Intentelo de nuevo");
        window.location = "register.php";
    </script>';
}

mysqli_close($link);
?>