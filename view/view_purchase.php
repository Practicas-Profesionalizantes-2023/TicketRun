<?php
session_start();
include_once "../models/functions.php";
$show = getShowForId($_GET["id_show"]);
$user_get=getUser();
$_SESSION["id"];
$_SESSION["name"];
$_SESSION["show"];
$_SESSION["time"];
$_SESSION["seating"]=$_SESSION["seating"]+1;
$time=$_SESSION["time"];
$_SESSION["id_user"];

?>
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
    <link rel="stylesheet" href="../assets/css/selectseat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>PlayTickets</title>
</head>
<body>
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
</header>
<div id="seating-chart-container">
    <div id="stage-title">Escenario</div>
    <div class="stage"></div> 
</div>
<form action="../view/view_conf_reserve.php" method="POST">
    <div class="asientos">
        <?php
        $asientoOcupado = getReserver($show->id_show);
        if ($asientoOcupado !== false) {
            // Crea un array para almacenar los objetos de asientos ocupados
            $datosAsientos = [];
            // Recorre los resultados de la consulta y crea objetos para cada asiento ocupado
            foreach ($asientoOcupado as $fila) {
                $asiento = new stdClass();
                $asiento->seating_number = $fila->seating_number;
                $datosAsientos[] = $asiento;
            }
            // Extrae los números de asiento de los objetos y almacénalos en un array
            $asientosOcupados = array_map(function ($obj) {
                return $obj->seating_number;
            }, $datosAsientos);
        } else {
            // Si la consulta falló, maneja el error o muestra un mensaje adecuado
            echo "Error al obtener los datos de asientos ocupados desde la base de datos.";
        }

        for ($i = 1; $i <= 100; $i++) {
            $asientoOcupado = in_array($i, $asientosOcupados);
            $estadoAsiento = $asientoOcupado ? "ocupado" : "disponible";
            
            
            ?>
            
            <div class="asiento-label <?php echo $asientoOcupado ? 'occupied' : ($seleccionado ? 'selected' : 'available') ?>" data-seat-number="<?php echo $i ?>">
    <?php echo "$i" ?>
</div>


           
            <?php

        }
        ?>
    </div>

    
    <div id="seating-chart"></div>
        <div id="legend">
        <div class="legend-item">
            <div class="seat unavailable">
               <i class="fas fa-chair"></i>
            </div>
            <div class="span">
            <span>No Disponible</span>
            </div>
        </div>
        <div id="legend">
        <div class="legend-item">
            <div class="seat selected">
                <i class="fas fa-chair"></i>
            </div>
            <span>Seleccionado</span>
        </div>
        <div class="legend-item">
            <div class="seat available">
                <i class="fas fa-chair"></i>
            </div>
            <span>Disponible</span>
        </div>
    </div>
</div>
    <input type="hidden" name="asientos" id="asientos-seleccionados" value="">

    <input class="btn-reservar"  type="submit" value="Reservar" id="reservation-button" disabled>
    
    
</form>



<script src="../assets/js/barnavfooter.js"></script>
<!--<script src="../assets/js/script.js"></script>-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const seatLabels = document.querySelectorAll('.asiento-label');
    const reservationButton = document.getElementById('reservation-button');
    let asientosSeleccionados = '';
    const cantidadAsientos = <?php echo $_SESSION["seating"]; ?>;
    seatLabels.forEach(seatLabel => {
        seatLabel.addEventListener('click', () => {
            const isSelected = seatLabel.classList.contains('selected');
            const isOccupied = seatLabel.classList.contains('occupied');
            const seatNumber = seatLabel.getAttribute('data-seat-number');

            // Check if the seat is occupied or already selected
            if (!isOccupied && (asientosSeleccionados.split(',').length < cantidadAsientos || isSelected)) {
            if (!isOccupied) {
                if (isSelected) {
                    // Deseleccionar el asiento
                    seatLabel.classList.remove('selected');
                    // Remover el asiento del listado de asientos seleccionados
                    asientosSeleccionados = asientosSeleccionados.replace(seatNumber + ',', '');
                } else {
                    // Seleccionar el asiento
                    seatLabel.classList.add('selected');
                    asientosSeleccionados += seatNumber + ',';
                }
            }
        }
            // Update the value of the hidden input field
            document.getElementById('asientos-seleccionados').value = asientosSeleccionados;

            // Enable the reservation button if there are selected seats
            reservationButton.disabled = asientosSeleccionados === '';
        });
    });
});

</script>

</body>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>
 