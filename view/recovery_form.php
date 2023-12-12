<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>PlayTickets</title>
    <link rel="icon" type="image/png" href="../assets/img/logo.png">
    <link rel="stylesheet" href="../assets/css/barnavfooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"><!--Icono de menu-->
</head>
<body>
    <div class="main-content">
        <header>
            <div class="navbar">
                <img src="../assets/img/logo.png" alt="Logo" height="80px ">
                <h1 class="logo">PLAYTICKETS </h1>
                <button class="accordion"><i class="fas fa-bars"></i></button>
                <div class="panel">
                    <ul>
                        <li><a href="../index.php">Cartelera</a></li>
                        <li><a href="register.php">Registrarse</a></li>
                        <li><a href="contact_page.php">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <br><br>
        <div class="login-container">
            <div class="login-box">
                <div class="logo-container">
                    <h2 class="title-with-logo">Recupera tu cuenta<img src="../assets/img/logo.png"></h2>
                </div>
                <form action="../controller/mail.php" method="post">
                    <input type="email" name="email" placeholder="Correo Electronico" required><br><br>
                    <?php $_SESSION["email"]=$_POST["email"];?>
                    <button type="submit">Confirmar</button><br>
                </form>
                <p>¿No está registrado? <a href="../view/register.php">Registrate aquí</a></p>
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
            <div class="footer-copyright">
                &copy; 2023 PlayTickets
            </div>
        </div>
    </footer>
    <script src="../assets/js/barnavfooter.js"></script> 
</body>
</html>
