<?php

/*require '../vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/PHPMailer/src/SMTP.php';
require '../vendor/PHPMailer/PHPMailer/src/Exception.php';
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
require '../vendor/autoload.php';
include_once "../models/functions.php";
$pdo=database();
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $email = $_POST['email'];
    $_SESSION["email"]=$_POST["email"];
    // Verifica si el correo electrónico existe en la base de datos
    $stmt = $pdo->prepare('SELECT email FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Genera un token único y seguro
        $token = bin2hex(random_bytes(32));

        // Almacena el token y la hora de solicitud en la base de datos
        $stmt = $pdo->prepare('INSERT INTO tokens (token, email, date_solicitud) VALUES (?, ?, NOW())');
        $stmt->execute([$token, $email]);

    $mail = new PHPMailer;                     
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'PlayTickets1@gmail.com';               
    $mail->Password   = 'utlg jlpc fqzd xrot';                     
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;                                    

    
    $mail->setFrom('PlayTickets1@gmail.com', 'PlayTickets');
    $mail->addAddress($_POST["email"], 'usuario');     
    $mail->isHTML(true);   
    $mail->CharSet='UTF-8';                               
    $mail->Subject = 'Reestablecer Contraseña';
    $token = bin2hex(random_bytes(32));
    $mail->Body    = ' token: '.$token .
    ' http://localhost:8080/TicketRun/view/new_password.php';

if (!$mail->send()) {
    echo  '<script>alert("Error al enviar el mensaje");</script>';
    
    
} 

else {
    echo  '<script>alert("Mensaje enviado correctamente");</script>';
    echo '<script>window.location.href = "../index.php";</script>';
    //header("Location: ../index.php");
    
}

}
}
?>