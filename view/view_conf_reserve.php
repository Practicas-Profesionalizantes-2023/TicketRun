<?php
session_start();
include_once "../models/functions.php";
$show = getShowForId($_SESSION["id"]);
$_SESSION["id"];
$_SESSION["name"];
$_SESSION["time"];

$_SESSION["seating"];
$_SESSION["asiento"] = $_POST["asientos"];
$user_get=getUser();
$ticket_order=getMaxOrder();
$date_show = getShowDatetimeForId($_SESSION["time"]);


if ($date_show) {
    // Convertir la fecha de "yyyy-mm-dd" a "dd/mm/aaaa"
    $datetime = DateTime::createFromFormat('Y-m-d', $date_show->date_show);
    $formatted_date_show = $datetime->format('d/m/Y') . ' ' . $date_show->time_show;
}

if($ticket_order==NULL)
{
    $ticket_order="1";
}
else
{
    $ticket_order++;
}
 $_SESSION["order"]=$ticket_order; 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/logo" href="../assets/img/logo.png"><!--Icono en la pestaña-->
    <link rel="stylesheet" href="../assets/css/barnavlog.css">
    <link rel="stylesheet" href="../assets/css/barnavfooter.css">
    <link rel="stylesheet" href="../assets/css/conf_reserve.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>PlayTickets</title>
</head>
<body>
<div class="main-content">

<header>
    <div class="navbar">
    <img src="../assets/img/logo.png" alt="Logo" height="80px ">
        <h1 class="logotipo">PLAYTICKETS</h1>
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

<div class="header header-sub">
    <h2>DATOS A CONFIRMAR</h2>
</div>

<div class="content">
    <!-- Cuadro para mostrar datos del espectáculo, fecha y asientos -->
    <div class="data-frame">
        <div class="show-picture">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($show->picture); ?>" alt="Imagen del espectáculo">
    </div>
        <p class="data-text">Espectáculo: <?php echo $_SESSION["show"]; ?></p>
        <p class="data-text">Fecha: <?php echo $formatted_date_show; ?></p>
        <p class="data-text">
            <?php 
                if ($_SESSION["seating"] == 1) {
                    echo "Has seleccionado el asiento:". $_SESSION["asiento"];
                } 
                else {
                    echo "Has seleccionado los asientos: ". $_SESSION["asiento"];
                }?></p>  
        <p class="data-text">Orden de compra: <?php echo $_SESSION["order"]; ?></p>
    </div>

    <!-- Botón para confirmar la entrada dentro del contenedor de datos -->
    <div class="button-container">
        <form action="../controller/save_ticket.php" method="POST">
            <input type="submit" value="Confirmar Entrada"><br><br>
        </form>
    </div>
</div>

<footer>
    <div class="footer-logo"></div>
    <div class="footer-content">
        <a href="politic_private.php">Política de Privacidad</a>
        <a href="termin_condiction.php">Términos y Condiciones</a>
        <a href="contact_page.php">Contacto</a>
        <div class="footer-copyright">&copy; 2023 PlayTickets</div>
    </div>
</footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script>document.addEventListener("DOMContentLoaded", function() {
    const accordion = document.querySelector(".accordion");
    const panel = document.querySelector(".panel");

    accordion.addEventListener("click", function() {
        panel.style.display = panel.style.display === "block" ? "none" : "block";
    });
});</script>
</html>
