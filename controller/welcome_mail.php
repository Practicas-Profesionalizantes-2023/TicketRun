<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../vendor/autoload.php';
include_once "../models/functions.php";

function validarEdad($dateOfBirth) {
    $dateOfBirthTimestamp = strtotime($dateOfBirth);
    $currentTimestamp = time();
    $age = date("Y", $currentTimestamp) - date("Y", $dateOfBirthTimestamp);

    if (date("md", $currentTimestamp) < date("md", $dateOfBirthTimestamp)) {
        $age--;
    }

    return $age >= 18;
}

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$dni = $_POST["dni"];
$phone = $_POST["phone"];
$date_birth = $_POST["date_birth"];
$street = $_POST["street"];
$height = $_POST["height"];
$departament = $_POST["departament"];
$floor = $_POST["floor"];
$cuil = $_POST["cuil"];
$password = $_POST["_password"];
$id_rol="1";
$user_state="0";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if (!validarEdad($date_birth)) {
    echo '<script>alert("Debes ser mayor de 18 años para registrarte en PlayTickets.");</script>';
    echo '<script>window.location.href = "../view/register.php";</script>'; // Regresar a la página anterior
} else {
    $ok = register($first_name, $last_name, $email, $dni, $phone, $date_birth, $street, $height, $departament, $id_rol, $hashed_password,$user_state);

$idObject = getIdUser();
$id = $idObject->id_user;
$confirmationLink = 'http://localhost:8080/TicketRun/controller/confirmation.php?id=' . $id;

if (!$ok) {
    echo "Error registrando.";
} 
else {
    $_SESSION["nombre"] = $first_name;

}
$email = $_POST["email"];

function welcome($email)
{
$mail = new PHPMailer(true);

if (!empty($email)) {
    
    $mail->SMTPDebug = 0 ;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'Playtickets1@gmail.com';                     
    $mail->Password   = 'utlg jlpc fqzd xrot';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    
    $mail->setFrom('playtickets1@gmail.com', 'PlayTicket');
    $mail->addAddress($email);     

    $src_imagen = '../assets/img/logo.fondo.png';
    $mail->addEmbeddedImage($src_imagen, 'logo');

    $mail->isHTML(true);     
    $mail->CharSet='UTF-8';                      
    $mail->Subject = 'Bienvenido';
    $mail->Body = '
    <html>
    <head>
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
                text-align: center; /* Centrar contenido en el contenedor */
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
            img {
                max-width: 200px;
                margin: 0 0 20px 20px; /* Cambia el margen para que el logo esté en el lado derecho */
            }
            .signature {
                text-align: right; /* Alinea el saludo cordial a la derecha */
            }
        </style>
    </head>
    <body>
        <div id="container">
            <h1>¡Bienvenido a PlayTickets!</h1>
            <p> Bienvenido a PlayTickets
                <br>
                Es un gran placer darte la bienvenida a PlayTickets, 
                tu destino número uno para disfrutar de los mejores eventos y espectáculos en línea.
                Estamos emocionados de tenerte como parte de nuestra comunidad y esperamos que te diviertas al máximo.
                <br>
                <br>
                En PlayTickets, nos apasiona brindarte acceso a una amplia variedad de eventos,
                desde conciertos emocionantes hasta proyecciones de películas exclusivas y experiencias teatrales inolvidables.
                Hemos diseñado este espacio pensando en ti, para que puedas explorar, reservar y disfrutar de tus espectáculos favoritos desde la comodidad de tu hogar.
                <br>
                <br>
                Te animamos a explorar nuestro sitio web y descubrir todas las sorpresas que hemos preparado para ti. Si tienes alguna pregunta, comentario o sugerencia,
                nuestro equipo de soporte siempre está dispuesto a ayudarte.
                Estamos aquí para garantizar que tu experiencia en PlayTickets sea excepcional.
                <br>
                ¡Bienvenido y disfruta de la magia de PlayTickets!
            </p>
            <div style="clear: both;"></div>
            <img src="cid:logo" alt="Logo de PlayTickets">
            <p class="signature">
                Saludos cordiales,
                <br>
                Equipo PlayTickets
            </p>
        </div>
    </body>
    </html>';
    $mail->send();
    return true;
}

}


function Confirmation($email,$confirmationLink) 
{  

    $mail = new PHPMailer(true);

    $mail->SMTPDebug = 0 ;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'Playtickets1@gmail.com';                     
    $mail->Password   = 'utlg jlpc fqzd xrot';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;   

    $mail->setFrom('playtickets1@gmail.com', 'PlayTicket');
    $mail->addAddress($email);
    $src_imagen = '../assets/img/logo.fondo.png';
    $mail->addEmbeddedImage($src_imagen, 'logo');
    $mail->isHTML(true);
    $mail->CharSet='UTF-8';  
    $mail->Subject = 'Confirmación de correo electrónico';
    $mail->Body = '
    <html>
    <head>
        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #f1f1f1;
                font-family: Arial, sans-serif;
            }
            #container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border: 2px solid #000;
                text-align: center; /* Centrar contenido en el contenedor */
            }
            h1 {
                color: #000;
                font-size: 24px;
                font-weight: bold;
                margin: 0; /* Elimina el margen superior y los laterales para centrar el título */
                padding: 20px 0; /* Agrega espacio superior e inferior al título */
            }
            p {
                font-size: 16px;
                line-height: 1.5;
                color: #333;
            }
            a {
                text-decoration: none;
                background-color: #fff; /* Cambia el color*/
                color: #000; /* Cambia color */
                padding: 10px 20px;
                border-radius: 5px;
            }
            img {
                max-width: 200px;
                margin: 20px auto; /* Centra la imagen en el contenedor */
                display: block;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <h1>Bienvenido</h1>
            <p>Te damos una cordial bienvenida a PlayTickets, tu plataforma de entretenimiento favorita. Estamos encantados de que te hayas registrado con nosotros y confíes en nuestra plataforma para acceder a los mejores eventos y espectáculos.</p>
            <p>Para garantizar la seguridad de tu cuenta y mantenernos en contacto contigo, te pedimos que confirmes tu dirección de correo electrónico. Esto es esencial para que puedas recibir notificaciones sobre eventos, ofertas especiales y actualizaciones importantes de PlayTickets. Por favor, haz clic en el siguiente enlace: </p>
            <a href="'.$confirmationLink.'">Confirmar correo</a>
            <img src="cid:logo" alt="Logo de PlayTickets">
        </div>
    </body>
    </html>';

        $mail->send();
        return true;
        
}

if (welcome($email)&&Confirmation($email,$confirmationLink)==true) {

    header("Location: ../view/register.php?successfulRegistratio=1");


}
}
?>