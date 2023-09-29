<?php 
include_once "../models/functions.php";

/*$getShow = getShow();
var_dump($getShow)
exit;*/
//$get_show=getShowDetallShow();
$show = getShowForId($_GET["id_show"]);
?>
<!DOCTYPE html>
<html lang="en">
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
                <h1 class="logo"><img src="../assets/img/logo.png" alt="Logo" height="80px ">PLAYTICKETS</h1>
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
        <div clas="register-container">
        <div class="register-box">
        <form action="../controller/save_datetime_function.php" method="post">
            <div class="logo-container">
                <h2 class="title-with-logo">AGREGA NUEVA FECHA</h2>
            </div>
            <div class="form-group">
                <label for="show_name">Seleccione el nombre del show:</label>
                <select class="form-control" id="id_show" name="id_show">
                    <option value="<?php echo $show->id_show ?>" required><?php echo $show->show_name ?></option><br>
                </select>
            </div>
            <div class="form-group">
                <label for="show_date_time">Fecha y Hora:(mes/dia/año)</label>
                <input type="datetime-local" class="form-control" id="datetime_show" name="datetime_show" required><br><br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
</div>
</div>

    </div>
    <footer>
        <div class="footer-logo"></div>
        <div class="footer-content">
            <div class="footer-links">
                <a href="#">Política de Privacidad</a>
                <a href="#">Términos y Condiciones</a>
                <a href="#">Contacto</a>
            </div>
            <div class="footer-copyright">
                &copy; 2023 PlayTickets
            </div>
        </div>
    </footer>
    <script src="../assets/js/barnavfooter.js"></script> 
</body>
</body>
</html>