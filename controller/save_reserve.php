<?php
session_start();
include_once "../models/functions.php";
require_once "../libs/QR/qrcode.class.php";
$show = getShowForId($_GET["id_show"]);
$_SESSION["show"];
$_SESSION["data"];
$_SESSION["asiento"];
$time=$_SESSION["time"];
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/autoload.php';
$idese=$_SESSION["id"];
$time=$_SESSION["time"];
/*var_dump($time);
   exit;*/
   $_POST["asientos"];
   
   /*var_dump($_POST["asientos"]);
   exit();*/
   $asientosSeleccionados = $_POST["asientos"];
   $ok = addSeating($asientosSeleccionados, $idese,$time);

   
if($ok)
{

        $mail = new PHPMailer;                     
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'PlayTickets1@gmail.com';               
        $mail->Password   = 'utlg jlpc fqzd xrot';                     
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port       = 587;                                    
        $src_imagen = '../assets/img/logo.fondo.png';
    $mail->addEmbeddedImage($src_imagen, 'logo');
        
        $mail->setFrom('PlayTickets1@gmail.com', 'PlayTickets');
        $mail->addAddress($_SESSION["email"], 'usuario');     
        $mail->isHTML(true);   
        $mail->CharSet='UTF-8';                               
        
$mail->Subject = 'Compra exitosa';

if (is_array($_POST["asientos"])) {
    $mensaje = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                padding: 20px;
            }
            .container {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                border: 2px solid #000;
                display: column;
                justify-content: center; /* Centra el título horizontalmente */
            }
            h1 {
                color: #000;
                font-weight: bold;
                display: flex;
                align-items: center; /* Alinear elementos verticalmente en el título */
            }
            img {
                max-width: 150px;
                margin-right: 300px; /* Cambia margin-left a margin-right */
                margin-top: 20px;
            }
            p {
                color: #333;
                font-weight: normal;
            }
            strong {
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div style="display: flex;">
            <h1>Felicitaciones por su compra</h1>
                <img src="cid:logo" alt="Logo de PlayTickets">
            </div>
            <div style="display: column;">
            <p>Ha adquirido entradas para la función de: <strong>' . $_SESSION["show"] . '</strong></p>
            <p>Fecha de la función: <strong>' . $_SESSION["day"] . '</strong></p>
            <p>Asientos seleccionados: <strong>' . implode(', ', $_SESSION["asiento"]) . '</strong></p>
            <p>Horario de la función: <strong>' . $_SESSION["data"] . '</strong></p>
            </div>
        </div>
    </body>
    </html>
';

   


} else {
    // Manejar el caso en el que $_POST["asientos"] no es un array
    $mensaje = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                padding: 20px;
            }
            .container {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                border: 2px solid #000; /* Agregar un borde negro al contenedor */
                display: column; /* Usar flexbox para controlar la disposición */
                justify-content: center; /* Centra el contenido horizontalmente */
                align-items: flex-start; /* Alinear elementos en la parte superior */
            }
            h1 {
                color: #000; /* Cambiar el color del título a negro */
                font-weight: bold; /* Hacer el título en negrita */
            }
            img {
                max-width: 150px; /* Tamaño adecuado al div */
                margin-left: 300px; /* Espacio a la izquierda del título */
                margin-top: 20px; /* Margen superior para la imagen */
            }
            p {
                color: #333;
                font-weight: normal; /* Hacer que el texto sea normal */
            }
            strong {
                font-weight: bold; /* Hacer que las palabras después de los dos puntos estén en negrita */
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div style="display: flex;">
                <h1>Felicitaciones por su compra</h1>
                <img src="cid:logo" alt="Logo de PlayTickets">
            </div>
            <div style="display: column;">
            <p>Ha adquirido entradas para la función de: <strong>' . $_SESSION["show"] . '</strong></p>
            <p>Fecha de la función: <strong>' . $_SESSION["day"] . '</strong></p>
            <p>Asiento seleccionado: <strong>' . $_SESSION["asiento"] . '</strong></p>
            <p>Horario de la función: <strong>' . $_SESSION["data"] . '</strong></p>
            </div>
        </div>
    </body>
    </html>
';


}

$mail->IsHTML(true);
$mail->Body = $mensaje;


    if ($mail->send()) {
        header("Location: ../view/view_qr.php");
    } 
    
    else {
        header("Location: ../index.php");
    }
    
    
    }
    ?>
