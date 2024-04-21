<?php
session_start();
$link = include('../php/conexion.php');


if(isset($_POST["calificacion"])){
    $rate = $_POST["calificacion"];
    echo 'TODO ESTA BIEN';
    header("location: http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=bibliotec&table=usuario");
}

?>