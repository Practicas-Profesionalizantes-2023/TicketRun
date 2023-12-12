<?php
session_start();
include_once "../models/functions.php";
$user = $_SESSION["id_user"];
$reservasArray = ReservationHistory($user);
$get_show = getShow();
$get_user = getUser();
$date_show = getShowDatetime();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/supplier.css">
    <link rel="icon" type="image/png" href="../assets/img/logo.png">
    <link rel="stylesheet" href="../assets/css/barnavfooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
     <title>PlayTickets</title>
</head>
<body>
    <div class="main-content">
        <header>
            <div class="navbar">
                <img src="../assets/img/logo.png" alt="Logo" height="80px">
                <h1 class="logo">PLAYTICKETS</h1>
                <button class="accordion"><i class="fas fa-bars"></i></button>
                <div class="panel">
                    <ul>
                        <li>Hola <?php echo $_SESSION["name"]?>!</li>
                        <li><a href="record.php">Mis reservas</a></li>
                        <hr class="hr">
                        <li><a href="../controller/logout.php">Cerrar Sesion</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <h2 class="title-with-logo">Mis Reservas</h2>

        <?php
if (empty($reservasArray)) {
    echo '<table class="table">';
    echo '<thead><tr><th colspan="6">No hay historial de reservas</th></tr></thead>';
    echo '</table>';
} else {
    echo '<table class="table">';
    echo '<thead><tr>';
    echo '<th>Usuario</th>';
    echo '<th>Número de orden</th>';
    echo '<th>Fecha y Hora </th>';
    echo '<th>Show</th>';
    echo '<th>Código QR</th>';
    echo '<th>Asientos</th>';
    echo '</tr></thead>';
    echo '<tbody>';
    $prevTicketID = null;
    $seatingArr = array();
    foreach ($reservasArray as $reservation) {
        if ($reservation['reserve_order'] !== $prevTicketID) {
            if (!empty($seatingArr)) {
                echo '<td>' . implode(', ', $seatingArr) . '</td>';
            } 
            echo '<td></td>';
            echo '</tr>';
            echo '<tr>';
            foreach ($get_user as $nameuser) {
                if ($reservation['id_user'] === $nameuser->id_user) {
                    echo '<td>' . $nameuser->user_name . '</td>'; // Mostrar nombre de usuario
                    break;
                }
            }
            echo '<td>' . $reservation['reserve_order'] . '</td>'; // Número de orden
            echo '<td>';
            foreach ($date_show as $date_show_get) {
                if ($reservation['id_show'] === $date_show_get->id_show) {
                    if($reservation['datetime_hour'] === $date_show_get->id_datetime)
                    {
                        $datetime = DateTime::createFromFormat('Y-m-d', $date_show_get->date_show);
                $formatted_date_show = $datetime->format('d/m/Y') . ' ' . $date_show_get->time_show;
                echo $formatted_date_show; // Mostrar fecha y hora
                break;
                    }
            }
            }
            
            echo '</td>';
            echo '<td>';
            foreach ($get_show as $show)
             { if ($reservation['id_show'] === $show->id_show) 
                {
                    echo $show->show_name; // Mostrar el nombre del espectáculo
                } } 
            echo '</td>';
            echo '<td>';
            if($selectedOrder<$reservasArray) //QR
            {
            echo '<form action="../view/view_qr.php" method="post">';
            echo '<input type="hidden" name="reserve_order" value="' . $reservation['reserve_order'] . '">';
            echo '<input type="submit" value="Ver QR">';
            echo '</form>';
            $selectedOrder++;
            }
            echo '</td>';
            $prevTicketID = $reservation['reserve_order'];  // Actualizar el ID de reserva anterior
            $seatingArr = array();  // Reinicia el array de asientos para la siguiente reserva
        }
        // Si el ID de la reserva es el mismo, agregar los asientos al array
        $seatingArr[] = $reservation['seating'];
    }
    // Muestra ascientos de la nueva reserva
    if (!empty($seatingArr)) {
        echo '<td>' . implode(', ', $seatingArr) . '</td>';
    } else {
        echo '<td>No hay asientos</td>';
    }
    echo '<td></td>';
    echo '</tr>';
    echo '</tbody></table>';
}
?>
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const accordion = document.querySelector(".accordion");
            const panel = document.querySelector(".panel");
            accordion.addEventListener("click", function () { panel.style.display = panel.style.display === "block" ? "none" : "block"; });
        });
    </script>
</body>
</html>
