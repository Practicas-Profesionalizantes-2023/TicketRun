<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/logo" href="assets/img/logo.jpeg"><!--Icono en la pestaña-->
    <link rel="icon" type="img/logo" href="assets/img/logo-removebg-preview.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/main.css">

    <title> Play Tickets </title>
</head>
<body>
    <nav><img src="assets/img/logo.jpeg" alt="" width="103" height="104">
        <a href="assets/img/logo.jpeg" class="logo">PLAYTICKETS</a>

        <div class="parts"><!-- div de las opciones a mostrar en la barra de navegacion-->
            <ul class="opcions">
                <li><a href="#">Cartelera</a></li>
                <li><a href="#">Eventos</a></li>
                <li><a href="/view/login.html ">Ingresar</a></li>
                <li><a href="/view/register.html">Registrarse</a></li>
            </ul>
        </div>
    </nav>
    <div class="container-index">
        <!-- Carrusel -->
        <div class="row">
            <div id="carouselExample" class="carousel slide col-lg-12">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/show-malafama.jpeg" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/show-malafama.jpeg" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/show-malafama.jpeg" class="d-block w-100">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
        <!-- Buscador/Filtros -->
        <div class="filtros">
            <form action="" method="post" class="row justify-content-between" >
                <div class="col-lg-3">
                    <input class="buscador " type="search" name="search" id="" placeholder="Buscar...">
                </div>
                <!-- Filtrar por mes -->
                <div class="col-lg-4 d-flex">
                    <label for="filtroMes">Filtrar por mes : </label>
                    <select name="filtroMes" id="">
                        <option value=""></option>
                        <option value="Enero">Enero</option>
                        <option value="Febrero">Febrero</option>
                        <option value="Marzo">Marzo</option>
                        <option value="Abril">Abril</option>
                        <option value="Mayo">Mayo</option>
                        <option value="Junio">Julio</option>
                        <option value="Julio">Junio</option>
                        <option value="Agosto">Agosto</option>
                        <option value="Septiembre">Septiembre</option>
                        <option value="Octubre">Octubre</option>
                        <option value="Novienbre">Noviembre</option>
                        <option value="Diciembre">Diciembre</option>
                    </select>
                </div>

                <!-- Filtrar por tipo -->
                <div class="col-lg-4 d-flex">
                    <label for="filtroTipo">Filtrar por tipo : </label>
                    <select name="filtroTipo" id="">
                        <option value=""></option>
                        <option value="">Comedia</option>
                        <option value="">Drama</option>
                        <option value="">Romance</option>
                    </select>
                </div>
                <div class="col-lg-1">
                    <input class="buscar btn" type="submit" value="Buscar">
                </div>
            </form>
        </div>
        
        <!-- Cartelera -->
        <div class="cartelera row">
            <!-- Card -->
            <div class="col-lg-3">
                <div class="card">
                    <img src="assets/img/images.jpeg" alt="" width="100%" height="250px">
                    <div>
                        <a href="#"><button>Reservar Entrada</button></a>
                    </div>
                </div>
            </div>
            <!-- Fin Card -->
            <!-- Card -->
            <div class="col-lg-3">
                <div class="card">
                    <img src="assets/img/images.jpeg" alt="" width="100%" height="250px">
                    <div>
                        <a href="#"><button>Reservar Entrada</button></a>
                    </div>
                </div>
            </div>
            <!-- Fin Card -->
            <!-- Card -->
            <div class="col-lg-3">
                <div class="card">
                    <img src="assets/img/images.jpeg" alt="" width="100%" height="250px">
                    <div>
                        <a href="#"><button>Reservar Entrada</button></a>
                    </div>
                </div>
            </div>
            <!-- Fin Card -->  
            <!-- Card -->
            <div class="col-lg-3">
                <div class="card">
                    <img src="assets/img/images.jpeg" alt="" width="100%" height="250px">
                    <div>
                        <a href="#"><button>Reservar Entrada</button></a>
                    </div>
                </div>
            </div>
            <!-- Fin Card -->  
            <!-- Card -->
            <div class="col-lg-3">
                <div class="card">
                    <img src="assets/img/images.jpeg" alt="" width="100%" height="250px">
                    <div>
                        <a href="#"><button>Reservar Entrada</button></a>
                    </div>
                </div>
            </div>
            <!-- Fin Card -->  
            <!-- Card -->
            <div class="col-lg-3">
                <div class="card">
                    <img src="assets/img/images.jpeg" alt="" width="100%" height="250px">
                    <div>
                        <a href="#"><button>Reservar Entrada</button></a>
                    </div>
                </div>
            </div>
            <!-- Fin Card -->  
            <!-- Card -->
            <div class="col-lg-3">
                <div class="card">
                    <img src="assets/img/images.jpeg" alt="" width="100%" height="250px">
                    <div>
                        <a href="#"><button>Reservar Entrada</button></a>
                    </div>
                </div>
            </div>
            <!-- Fin Card -->  
            <!-- Card -->
            <div class="col-lg-3">
                <div class="card">
                    <img src="assets/img/images.jpeg" alt="" width="100%" height="250px">
                    <div>
                        <a href="#"><button>Reservar Entrada</button></a>
                    </div>
                </div>
            </div>
            <!-- Fin Card -->        
        </div>

    </div><!-- Cierre de clase container -->
    <footer>
        <div class="containerFooter">
            <div class="cont_footer">
                <div class="descrip">
                    <div class="logo_area">
                        <img src="assets/img/logo.jpeg" alt="" width="160" height="150">
                        <span class="logo_name">PLAYTICKETS</span>
                    </div>
                </div>

                <div class="service_area">
                    <ul class="area_service">
                        <li class="service_name"> Area de Consultas</li>
                        <li> <a href="">consultas</a></li>
                        <li><a href="">nosotros</a></li>
                        <li><a href="">eventos</a></li>
                    </ul>

                    <ul class="area_service">
                        <li class="service_name"> Area de Compra</li>
                        <li> <a href="">consultas</a></li>
                        <li><a href="">nosotros</a></li>
                        <li><a href="">eventos</a></li>
                    </ul>

                    <ul class="area_service">
                        <li class="service_name"> Area de Funciones</li>
                        <li><a href="">consultas</a></li>
                        <li><a href="">nosotros</a></li>
                        <li><a href="">eventos</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="footer__bottom">
                <div class="lastSentence">
                    <span>2023 PLAYTICKETS</span>
                </div>
            </div>
        </div>
    </footer>
</body>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>

<?php

?>