<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

$name = $_POST["name"];
$email = $_POST["email"];
$comment = $_POST["comment"];
$affair = $_POST["affair"];

function Contact_mail($name,$email,$comment,$affair)
{ 

    $mail = new PHPMailer(true);

if(!empty($name) && !empty($email) && !empty($comment) && !empty($affair))
{

    $mail->SMTPDebug = 0 ;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'Playtickets1@gmail.com';                     
    $mail->Password   = 'utlg jlpc fqzd xrot';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    
    $mail->setFrom('playtickets1@gmail.com', 'PlayTicket');
    $mail->addAddress('playtickets1@gmail.com');     

    $mail->isHTML(true);
    $mail->CharSet='UTF-8';                      
    $mail->Subject = $affair;
    $mail->Body = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
            }
            .container {
                background-color: #ffffff;
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #333;
            }
            p {
                color: #666;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Detalles del Usuario:</h2>
            <p>
                <strong>Nombre de Usuario:</strong> ' . $name . '<br>
                <strong>Email:</strong> ' . $email . '<br>
            </p>
            <h2>Consulta:</h2>
            <p>' . $comment . '</p>
        </div>
    </body>
    </html>';


    $mail->send();
    return true;
} 
}

if(Contact_mail($name,$email,$comment,$affair)==true)
{

    echo '<script>alert("Mensaje enviado con exito.");</script>';
    echo '<script>window.location.href = "../index.php";</script>'; // Regresar a la página anterior
    //header("Location: ../index.php");

    exit;
}


?>