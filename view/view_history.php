<?php
include_once "../models/functions.php";
$history = GeneralHistory();
$get_show = getShow();
$date_show = getShowDatetime();
if (!isset($_GET["search"]) || empty($_GET["search"])) {
    $get_user = getUser();
} else {
    $search_term = $_GET["search"];
    $get_user = searchUser($search_term);  // Llamada a la función searchUser con el término de búsqueda
}
function getUserName($userId, $users) {
    foreach ($users as $user) {
        if ($user->id_user === $userId) {
            return $user->user_name;
        }
    }
    return '';
}

function getUserLastName($userId, $users) {
    foreach ($users as $user_lastname) {
        if ($user_lastname->id_user === $userId) {
            return $user_lastname->last_name;
        }
    }
    return '';
}
function getShowName($showId, $shows) {
    foreach ($shows as $show) {
        if ($show->id_show === $showId) {
            return $show->show_name;
        }
    }
    return '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/supplier.css"> 
    <link rel="icon" type="img/logo" href="../assets/img/logo.png"><!--Icono en la pestaña-->
    <link rel="stylesheet" href="../assets/css/barnavfooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"><!--Icono de menu-->

    <title>PlayTickets</title>
</head>
<body>
<div class="main-content">
    <header>
        <div class="navbar">
            <img src="../assets/img/logo.png" alt="Logo" height="80px ">
            <h1 class="logo">PLAYTICKETS</h1>
            <button class="accordion"><i class="fas fa-bars"></i></button>
            <div class="panel">
                <ul>
                    <li><a href="../index.php">Cartelera</a></li>
                    <li><a href="register.php">Registrarse</a></li>
                    <li><a href="add_function.php">Agregar Función</a></li>
                    <li><a href="supplier.php">Funciones Disponibles</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div class="row">
        <div class="col-12">
            <form action="view_history.php" class="search-form">
            <div class="logo-container">
                <h2 class="title-with-logo">COMPRAS REALIZADAS EN PLAYTICKETS</h2>
            </div>
            <div class="form-row align-items-center">
                <div class="col-6 my-1">
                    <input value="<?php echo isset($_GET["search"]) && !empty($_GET["search"]) ?  $_GET["search"] : "" ?>" name="search" class="form-control" type="text" placeholder="NOMBRE DEL USUARIO">
                </div>
                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary">BUSCAR</button>
                </div>
            </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Número de orden</th>
                        <th>Show</th>
                        <th>Asientos</th>
                        <th>Fecha y hora</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
$prevOrder = null; // Almacena el número de orden anterior

foreach ($history as $historys) 
{
    // Verifica si el nombre de usuario coincide con el término de búsqueda
    $userName = getUserName($historys->id_user, $get_user);
    $userLastName = getUserLastName($historys->id_user, $get_user);
    $fullName = $userName . ' ' . $userLastName;
    if (empty($search_term) || stripos($fullName, $search_term) !== false) {
        if ($historys->reserve_order !== $prevOrder) {
            ?>
            <tr>
                <td><?php echo $fullName ?></td>
                <td><?php echo $historys->reserve_order ?></td>
                <td><?php echo getShowName($historys->id_show, $get_show) ?></td>
                <td><?php echo implode(', ', array_column(array_filter($history, function($item) use ($historys) {
                    return $item->reserve_order === $historys->reserve_order;
                }), 'seating')); ?></td>
                <td><?php 
                foreach ($date_show as $date_show_get) 
                if ($historys->id_show === $date_show_get->id_show) {
                    if($historys->datetime_hour === $date_show_get->id_datetime)
                    {
                        $datetime = DateTime::createFromFormat('Y-m-d', $date_show_get->date_show);
                        $formatted_date_show = $datetime->format('d/m/Y') . ' ' . $date_show_get->time_show;
                        echo $formatted_date_show; // Mostrar fecha y hora
                        break;
                    }
                }
            } ?></td>
            </tr>
            <?php  
        }
        $prevOrder = $historys->reserve_order; // Actualizar el número de orden anterior
    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer>
    <div class="footer-logo"></div> 
    <div class="footer-content">
        <div class="footer-links">
            <a href="politic_private.php">Política de Privacidad</a>
            <a href="termin_condiction.php">Términos y Condiciones</a>
            <a href="contact_page.php">Contacto</a>
        </div>
        <div class="footer-copyright">&copy;2023 PlayTickets</div>  
    </div>
</footer>
<script> document.addEventListener("DOMContentLoaded", function() {
    const accordion = document.querySelector(".accordion");
    const panel = document.querySelector(".panel");
    accordion.addEventListener("click", function() {
        panel.style.display = panel.style.display === "block" ? "none" : "block";
    });
});
</script>
</body>
</html>
