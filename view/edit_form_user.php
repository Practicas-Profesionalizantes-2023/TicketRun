<?php

include_once "../models/functions.php";
$user = getUserForId($_GET["id_user"]);
/*var_dump($user);
exit;*/
$date_birth = $user->date_birth; // Obtén la fecha completa del objeto $user
// Divide la fecha en partes (año, mes, día) utilizando la función explode con el carácter "-"
list($year, $month, $day) = explode("-", $date_birth);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/function.css">
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
                <h1 class="logotipo">PLAYTICKETS</h1>
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
        <div clas="register-container">
            <div class="register-box">
                <form action="../controller/update_user.php" method="post">
                    <div class="logo-container">
                        <h2 class="title-with-logo">MIS DATOS:</h2>
                    </div>
                    <input type="hidden" name="id_user" id="id_user" value="<?php echo $user->id_user?>">
                <div class="form-group">
                
                    <label for="show_name">Nombre:</label>
                    <input value="<?php echo $user->user_name ?>" type="text" class="form-control" name="user_name" id="user_name">
                </div>
                <div class="form-group">
                    <label for="show_description">Apellido:</label>
                    <input value="<?php echo $user->last_name ?>" type="text" class="form-control" name="last_name" id="last_name">
                </div>
                <div class="form-group">
                    <label for="show_date_time">Email:</label>
                    <input value="<?php echo $user->email ?>" type="text" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="dni">DNI:</label>
                    <input value="<?php echo $user->dni ?>" type="text" class="form-control" name="dni" id="dni">
                </div>
                <div class="form-group">
                    <label for="id_gender">Telefono:</label>
                    <input value="<?php echo $user->phone ?>" type="text" class="form-control" name="phone" id="phone">
                </div>
                <div class="form-group">
                    <label for="date_birth">Fecha de Nacimiento (dia/mes/año):</label>
                    <!-- Los campos de entrada de día, mes y año deben tener IDs diferentes -->
                    <input type="text" class="form-control" id="day" name="day" placeholder="Día" value="<?php echo $day ?>" required>
                    <input type="text" class="form-control" id="month" name="month" placeholder="Mes" value="<?php echo $month ?>" required>
                    <input type="text" class="form-control" id="year" name="year" placeholder="Año" value="<?php echo $year ?>" required>
                    <!-- Campo oculto para almacenar la fecha en formato "año-mes-día" -->
                    <input type="hidden" id="date_birth" name="date_birth" value="<?php echo $user -> date_birth ?>" required>
                </div>
                <div class="form-group">
                    <label for="street">Domicilio:</label>
                    <input value="<?php echo $user->street?>" type="text" class="form-control" name="street" id="street">
                </div>
                <div class="form-group">
                    <label for="height">Altura:</label>
                    <input value="<?php echo $user->height ?>" type="text" class="form-control" name="height" id="height">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Guardar</button>
                </div>
            </form>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const accordion = document.querySelector(".accordion");
    const panel = document.querySelector(".panel");

    accordion.addEventListener("click", function() {
        panel.style.display = panel.style.display === "block" ? "none" : "block";
    });
});
    </script>
    <script>
        // Escucha cambios en los campos de entrada de día, mes y año
        const dayInput = document.getElementById('day'); // Obtiene el campo de entrada de día
        const monthInput = document.getElementById('month'); // Obtiene el campo de entrada de mes
        const yearInput = document.getElementById('year'); // Obtiene el campo de entrada de año
        const dateBirthInput = document.getElementById('date_birth'); // Campo oculto para almacenar la fecha

        dayInput.addEventListener('input', updateDate); // Agrega un listener de eventos al campo de día
        monthInput.addEventListener('input', updateDate); // Agrega un listener de eventos al campo de mes
        yearInput.addEventListener('input', updateDate); // Agrega un listener de eventos al campo de año

        function updateDate() {
            // Obtiene los valores actuales de los campos de entrada de día, mes y año
            const day = dayInput.value.padStart(2, '0'); // Asegura que tenga al menos dos dígitos (01 en lugar de 1)
            const month = monthInput.value.padStart(2, '0'); // Asegura que tenga al menos dos dígitos (01 en lugar de 1)
            const year = yearInput.value;

            // Combina los valores en el formato "aaaa-mm-dd" y asigna el valor al campo oculto
            const dateValue = `${year}-${month}-${day}`;
            dateBirthInput.value = dateValue;
        }
    </script>
 </body>
</html>