<?php
session_start();
include_once "../models/functions.php";

$user_get=getUser();
$_SESSION["id_user"];
/*var_dump($_SESSION["id_user"]);
exit;*/
$_SESSION['order'];

if(isset($_POST["reserve_order"]))
{
    $_SESSION['order']=$_POST["reserve_order"];
}
?>


<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/logo" href="../assets/img/logo.png"><!--Icono en la pestaña-->
    <link rel="stylesheet" href="../assets/css/barnavlog.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/qr.css">
    <link rel="stylesheet" href="../assets/css/barnavfooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>PlayTickets</title>
</head>
<body>
<div class="main-content">

    <header>
        <div class="navbar">
        <img src="../assets/img/logo.png" alt="Logo" height="80px ">
        <h1 class="logotipo">PLAYTICKETS </h1>
        <button class="accordion"><i class="fas fa-bars"></i></button>
        <div class="panel">
            <ul>
                <li>Hola <?php echo $_SESSION["name"]?>!</li>
                <?php foreach ($user_get as $user) {
                            if ($_SESSION["id_user"] === $user->id_user) { ?>
                                <li><a href="edit_form_user.php?id_user=<?php echo $user->id_user ?>">Mis datos</a></li>
                                <?php }
                        }?>
                <li><a href="record.php">Mis reservas</a></li>
                <hr class="hr">
                <li><a href="../controller/logout.php">Cerrar Sesion</a></li>
            </ul>
        </div>
        </div>
    </header>

<div class="qr-container">
    <h1>Deberá enseñar este QR en el mostrador.</h1>
    <img src="../controller/generate_qr.php" id="qr">
    <button onclick="downQR()" >Descargar QR</button>
    <br><br>
</div>


<script type="text/javascript">
/*
    La función de JS descarga la imagen y luego redirecciona a la página.
*/
function downQR() {
    var source = document.getElementById('qr').src;
    var a = document.createElement('a');

    a.download = true;
    a.target = '_blank';
    a.href = source;

    // Agrega un evento para esperar a que se complete la descarga antes de redirigir.
    a.addEventListener('click', function() {
        // Redirige a view_end_reservation.php después de la descarga.
        window.location.href = 'view_end_reservation.php';
    });

    a.click();
}
</script>

</div>
<footer>

    <div class="footer-logo"></div> 
    <div class="footer-content">
        <div class="footer-links">
            <a href="politic_private.php">Política de Privacidad</a>
            <a href="termin_condiction.php">Términos y Condiciones</a>
            <a href="contact_page.php">Contacto</a>
        </div>
        <div class="footer-copyright">&copy; 2023 PlayTickets</div>  
    </div>
</footer>

<script src="../assets/js/barnavfooter.js"></script>
</body>
</html>