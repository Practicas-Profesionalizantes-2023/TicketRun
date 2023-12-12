<?php
include_once "models/functions.php";

$search = isset($_POST["search"]) ? $_POST["search"] : "";
$id_gender = isset($_POST["id_gender"]) ? $_POST["id_gender"] : "";
$id_category = isset($_POST["id_category"]) ? $_POST["id_category"] : "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $shows = getShow($search, $id_gender, $id_category);
} else {
    $shows = getShow();
}

/*var_dump($shows);
exit;*/
$genders=getGender();
$categorys=getCategory();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/logo" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/css/barnavfooter.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"><!--Icono de menu-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>PlayTickets</title>
</head>
<body>
    <div class="main-content">

        <!-- inicio barra de navegacion-->
        <header>
            <div class="navbar">
                <img src="assets/img/logo.png" alt="Logo" height="80px ">
                <h1 class="logo">PLAYTICKETS</h1>
                <button class="accordion"><i class="fas fa-bars"></i></button>
                <div class="panel">
                    <ul>
                        <li><a href="index.php">Cartelera</a></li>
                        <li><a href="view/register.php">Registrarse</a></li>
                        <li><a href="view/contact_page.php">Contacto</a></li>
                        <li><a href="view/admin.php">Administrador</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <!-- fin barra de navegacion-->
        
        <!-- inicio carrousel-->
        <div id="carouselExampleIndicators" class="carousel slide" data-interval="2000">
     
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/tini.jpeg" class="d-block w-100" alt="Slide 1" loading="lazy">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/taylor.jpeg" class="d-block w-100" alt="Slide 2" loading="lazy">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/granja.jpg" class="d-block w-100" alt="Slide 3" loading="lazy">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/duki.png" class="d-block w-100" alt="Slide 4" loading="lazy">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/emilia.jpg" class="d-block w-100" alt="Slide 5" loading="lazy">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/konga.png" class="d-block w-100" alt="Slide 6" loading="lazy">
                </div>
            </div>
        </div>
        <!-- Fin de carrusel -->
    
        <!--Inicio de buscador/filtros-->
        <br>
        <div class="filtros">
            <form action="index.php" method="POST" class="row justify-content-between">
                <div class="col-lg-3">
                    <input value="<?php echo isset($search) && !empty($search) ? $search : "" ?>" name="search" class="buscador" type="text" placeholder="NOMBRE DEL SHOW">
                </div>
                <div class="col-lg-1">
                    <button type="submit" class="buscar btn">Buscar</button>
                </div>
                <div class="col-lg-4 d-flex"><!-- Filtrar por tipo -->
                    <label for="id_gender">Género: </label>
                    <select name="id_gender" id="id_gender">
                        <option value=""></option>
                        <?php foreach ($genders as $genders2) { ?>
                            <option value="<?php echo $genders2->id_gender ?>"><?php echo $genders2->gender ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-4 d-flex"><!-- Filtrar por tipo -->
                    <label for="id_category">Clasificación: </label>
                    <select name="id_category" id="id_category">
                        <option value=""></option>
                        <?php foreach ($categorys as $categorys2) { ?>
                            <option value="<?php echo $categorys2->id_category ?>"><?php echo $categorys2->category ?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php include "../PlayTickets/controller/filter.php" ?>
            </form>
        </div>
        <br>
        <!--fin de buscador/filtros-->
        
        <!-- Inicio de Cartelera -->
        <div class="cartelera row">
            <?php foreach ($shows as $show) { 
                if ($show->show_state !=2) { ?>
                    <div class="col-lg-3">
                        <div class="card">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($show->picture); ?>" width="100%" height="250px">
                            <div>
                                <a href="view/synopsis.php?id_show=<?php echo $show->id_show ?>"><button><?php echo $show->show_name?></button></a>
                            </div>
                        </div>
                    </div>
            <?php } } ?>
        </div>  
        <!-- Fin de Cartelera -->

    </div><!-- Fin del div container -->
    <footer>
        <div class="footer-logo"></div> 
        <div class="footer-content">
            <div class="footer-links">
                <a href="view/politic_private.php">Política de Privacidad</a>
                <a href="view/termin_condiction.php">Términos y Condiciones</a>
                <a href="view/contact_page.php">Contacto</a>
            </div>
            <div class="footer-copyright">&copy; 2023 PlayTickets</div>  
        </div>
    </footer>

    <script> document.addEventListener("DOMContentLoaded", function() {
        const accordion = document.querySelector(".accordion");
        const panel = document.querySelector(".panel");
        accordion.addEventListener("click", function() {panel.style.display = panel.style.display === "block" ? "none" : "block";
    });
    });
    </script>
    <script>
       // Inicializa el carrusel
        $(document).ready(function(){
            $('#carouselExampleIndicators').carousel();
        });
    </script>
</body>
</html>