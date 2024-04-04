<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../verifymail/PHPMailer/PHPMailer.php';
require '../verifymail/PHPMailer/Exception.php';
require '../verifymail/PHPMailer/SMTP.php';  

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
            //ENVIO DE CORREO USANDO PHPMAILER :,v
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'bibliotec.team@hotmail.com';                     //SMTP username
    $mail->Password   = 'BiBliotec0027';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('bibliotec.team@hotmail.com', 'Dev-Bibliotec');
    $mail->addAddress($email, $nombre." ".$apellidos);     //Add a recipient //Name is optional
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Confirmacion de cambio de contraseña para BiblioTec.";
    $mail->Body    = "Se ha solicitado un cambio de contraseña para la cuenta ligada a este correo <br>";
    $mail->Body   .= "Para confirmar el cambio de contraseña use el siguiente codigo: <br>";
    $mail->Body   .= "$confirmationCode <br><br>";
    $mail->Body   .= "Si no es el caso, haga caso omiso de este correo.<br>";

    $mail->send();
    $_SESSION["confirmation_message"] = "Se ha enviado el código de verificación al correo electrónico: $email.";
} catch (Exception $e) {
    $_SESSION["alert_message"] = "Hubo un error al enviar el correo.";
}
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
