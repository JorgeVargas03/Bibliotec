<?php
session_start();
$link = include('../../php/conexion.php'); // Incluye el archivo de conexión y obtén la conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobar si los campos de correo electrónico no están vacíos
    if (!empty($_POST["correo"])) {
        // Obtener el correo electrónico del formulario
        $email = $_POST["correo"];

        // Preparar y ejecutar la consulta
        $stmt = $link->prepare("SELECT correo_Us FROM usuario WHERE correo_Us = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Verificar si se encontró el correo electrónico
        if ($stmt->num_rows == 1) {
            // Se encontró el correo, puedes enviar el código de confirmación aquí
            // Aquí deberías enviar el código al correo electrónico proporcionado
            // Generar un código aleatorio de 6 dígitos
            $confirmationCode = rand(100000, 999999);
            $_SESSION["confirmation_message"] = "Se ha enviado el código de verificación $confirmationCode al correo electrónico: $email.";
        } else {
            // El correo no está registrado, mostrar un mensaje de alerta
            $_SESSION["alert_message"] = "El correo proporcionado no está registrado.";
        }

        // Redirigir de vuelta al formulario
        header("Location: send_code.php");
        exit();
    }
}
?>
