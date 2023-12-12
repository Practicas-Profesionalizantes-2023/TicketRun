<?php
session_start();
include_once "../models/functions.php";

$user_get=getUser();
$_SESSION["id_user"];
/*var_dump($_SESSION["id_user"]);
exit;*/
?>

<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/barnavfooter.css">
    <link rel="stylesheet" href="../assets/css/end.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"><!--Icono de menu-->
    <link rel="icon" type="image/png" href="../assets/img/logo.png">
    <title>PlayTickets</title>
</head>
<body onload="updateDate()">
  <div class="main-content">
  <header>
    <div class="navbar">
        <img src="../assets/img/logo.png" alt="Logo" height="80px ">
        <h1 class="logotipo">
            PLAYTICKETS </h1>
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
 </header><br><br>

 <main>
        <img class="img_tick" src="../assets/img/vecteezy_tickets_1189271.png" alt="">
        <br><br><br><br><br><br><br>
        <p class="centered-bold">¡Reserva Confirmada!</p>
    </main>

   
  </div>    
  <footer>
    <div class="footer-logo"></div>
    <div class="footer-content">
      <div class="footer-links">
          <a href="politic_private.php">Política de Privacidad</a>
          <a href="termin_condiction.php">Términos y Condiciones</a>
          <a href="contact_page.php">Contacto</a>
      </div>
      <div class="footer-copyright">
        &copy; 2023 PlayTickets
      </div>
    </div>
  </footer>
  <script> document.addEventListener("DOMContentLoaded", function() {
        const accordion = document.querySelector(".accordion");
        const panel = document.querySelector(".panel");
        accordion.addEventListener("click", function() {panel.style.display = panel.style.display === "block" ? "none" : "block";
    });
    });
    </script>
    </body>
    </html>