<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/logo" href="../assets/img/logo.png"><!--Icono en la pestaña-->
    <link rel="stylesheet" href="../assets/css/barnavlog.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/conf_reserve.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>PlayTickets</title>
</head>
<body>
<div class="main-content">

<header>
    <div class="navbar">
        <h1 class="logotipo">
            <img src="../assets/img/logo.png" alt="Logo" height="80px ">PLAYTICKETS
        </h1>
        <button class="accordion"><i class="fas fa-bars"></i></button>
        <div class="panel">
            <ul>
                <li>Hola <?php echo $_SESSION["name"]?>!</li>
                <li><a href="#">Mis reservas</a></li>
                <hr class="hr">
                <li><a href="#">Cerrar Sesion</a></li>
            </ul>
        </div>
    </div>
</header>

<div class="header">
    <h2>DATOS A CONFIRMAR</h2>
</div>

<div class="content">
    <!-- Cuadro para mostrar datos del espectáculo, fecha y asientos -->
    <div class="data-frame">
        <p class="data-text">Espectáculo: <?php echo $_SESSION["show"]; ?></p>
        <p class="data-text">Fecha: <?php echo $_SESSION["time"]; ?></p>
        <p class="data-text">
    <?php 
    if ($_SESSION["seating"] == 1) {
      echo "Has seleccionado el asiento:". $asientosSeleccionados;
    } else {
      echo "Has seleccionado los asientos: ". $asientosSeleccionados;
    }
    ?>
  </p>  
    </div>

    <!-- Botón para confirmar la entrada dentro del contenedor de datos -->
    <div class="button-container">
        <form action="../controller/save_ticket.php" method="POST">
            <input type="submit" value="Confirmar Entrada">
        </form>
    </div>
</div>

<footer>
    <div class="footer-logo"></div>
    <div class="footer-content">
        <a href="#">Política de Privacidad</a>
        <a href="#">Términos y Condiciones</a>
        <a href="#">Contacto</a>
        <div class="footer-copyright">&copy; 2023 PlayTickets</div>
    </div>
</footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>