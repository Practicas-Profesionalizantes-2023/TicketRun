<?php

include_once "../models/functions.php";

$id_order = $_GET['id'];

$order_state = getStateOrder($id_order);

$tickets = getTicketOrder($id_order);


$show_name = "";

if (!empty($tickets)) {
  
    $show_name = $tickets[0]['show_name'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlayTickets</title>
    <link rel="stylesheet" href="../assets/css/conf_qr.css">
</head>
<body>
    <div class="container">
        <?php
        if ($order_state == 0) {
            echo '<h1>Reserva no utilizada.</h1>';
            echo '<a class="button confirm-button" href="http://192.168.81.171:8080/TicketRun/controller/conf_reserve.php?id='.$id_order.'">Confirmar Reserva</a>';
        } elseif ($order_state == 1) {
            echo '<h1 class="error-message">La reserva ya ha sido utilizada.</h1>';
        }

        echo '<h2>Funciones Reservadas:</h2>';
        foreach ($tickets as $ticket) {
            $seating = $ticket['seating'];
            $hour = $ticket['datetime_hour'];
            $date_show = getShowDatetimeForId($hour);

            if ($date_show) {
                // Convertir la fecha de "yyyy-mm-dd" a "dd/mm/aaaa"
                $datetime = DateTime::createFromFormat('Y-m-d', $date_show->date_show);
                $formatted_date_show = $datetime->format('d/m/Y') . ' ' . $date_show->time_show;
            }

            echo '<div>';
            echo '<p>Asiento: ' . $seating . '</p>';
            echo '<p>Show: ' . $show_name . '</p>';
            echo '<p>Hora: ' . $formatted_date_show . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
