<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Bibliotecas de PHPMailer 
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../models/functions.php';


$mail = new PHPMailer(true); // Instancia y pasa 'true' para habilitar excepciones

try {
    // Configuración de SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'PlayTickets1@gmail.com';
    $mail->Password   = 'utlg jlpc fqzd xrot';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('PlayTickets1@gmail.com', 'PlayTickets');

    $destinations= GetDestination();

    foreach ($destinations as $dest) {
        $mail->addAddress($dest['email'], $dest['user_name']);
    }
    
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Recordatorio de Show Reservado';
    $mail->Body .= '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #f1f1f1;
            }
            #container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border: 2px solid #000;
                text-align: center;
            }
            h1 {
                color: #000;
                font-size: 24px;
                font-weight: bold;
            }
            p {
                font-size: 16px;
                line-height: 1.5;
                color: #333;
            }
            .signature {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div id="container">
        <h1>¡PlayTickets!</h1>';

        foreach ($destinations as $dest) {
            $datetime_show = $dest['date_show'] . ' ' . $dest['time_show'];
            $mail->Body .= '
                <p>¡Hola ' . $dest['user_name'] . ' ' . $dest['last_name'] . '!</p>
                <p>¡Estamos emocionados porque el espectáculo que has reservado con PlayTickets está a punto de comenzar! Prepárate para sumergirte en una experiencia única y emocionante.</p>
                <p><strong>Detalles del Show:</strong></p>
                <ul>
                    <li><strong>Nombre del Show:</strong> ' . $dest['show_name'] . '</li>
                    <li><strong>Fecha y Hora del Show:</strong> ' . date('d/m/Y H:i', strtotime($datetime_show)) . '</li>
                </ul>
                <p>Asegúrate de llegar a tiempo y disfrutar de cada momento. La música, la diversión y la emoción te esperan. ¡No te lo pierdas!</p>
                <p>¡Nos vemos en el espectáculo!</p>
                <p>Saludos cordiales,</p>
                <p>Equipo PlayTickets</p>';
            break;
        }
    $mail->Body .= '
    </body>
    </html>';
    $mail->send();
    echo '<script>alert("Mensaje enviado correctamente");</script>';
    echo '<script>window.location.href = "../index.php";</script>';
} catch (Exception $e) {
    echo '<script>alert("Error al enviar el mensaje: ' . $mail->ErrorInfo . '");</script>';
}

// comando Docker desde PHP
$dockerCommand = 'docker exec -i App /usr/local/bin/php /var/www/html/PlayTickets/controller/mail_recordatorio.php > /tmp/cron_output.log 2>&1';
exec($dockerCommand);

//archivos de log
error_log("Inicio del script", 3, __DIR__ . "/error_log.txt");
error_log("Inicio de mail_recordatorio.php", 3, __DIR__ . "/error_log_php.txt");
error_log("Fin de mail_recordatorio.php", 3, __DIR__ . "/error_log_php.txt");
error_log("Fin del script", 3, __DIR__ . "/error_log.txt");

session_write_close();
?>
