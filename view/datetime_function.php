<?php
include_once "../models/functions.php";
$show = getShowForId($_GET["id_show"]);
$get_datetime_show=getShowDatetime();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/supplier.css"> 
    <link rel="icon" type="img/logo" href="../assets/img/logo.png"><!--Icono en la pestaña-->
    <link rel="stylesheet" href="../assets/css/barnavfooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"><!--Icono de menu-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <li><a href="add_function.php">Agregar Función</a></li>
                    <li><a href="view_users_supplier.php">Usuarios registrados</a></li>
                    <li><a href="view_history.php">Historial de Compras</a></li>
                    <hr class="hr">
                    <li><a href="../controller/logout.php">Cerrar Sesion</a></li>    
                </ul>
            </div>
        </div>
    </header>
    <br>
    <main class="main">
        <div class="row">
        <div class="col-12">
            <div class="header">
                <h3>FECHAS DE LOS SHOWS DE <?php echo $show->show_name?></h3>
                <a href="add_datetime_function.php?id_show=<?php echo $show->id_show ?>" class="btn btn-success mb-2">AGREGAR</a>
            </div>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Editar</th>
                        <th>Estado</th>
                        <th>Eliminar</th>
                        <th>Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($get_datetime_show as $datetime_show) { 
                        if($datetime_show->datetime_state != 2) {
                        $id_show_get=$show->id_show;
                        $id_show_date=$datetime_show->id_show;
                       if ($id_show_get === $id_show_date) { ?>
                        <tr>
                            <td><?php echo date('d/m/Y', strtotime($datetime_show->date_show)); ?></td>
                            <td><?php echo $datetime_show->time_show; ?></td>
                            

                            <td><a class="btn btn-warning" href="edit_form_show_datetime.php?id_datetime=<?php echo $datetime_show->id_datetime?>">EDITAR</a></td>
                            
                            <td>
                                 <?php if ($datetime_show->datetime_state == 1) { ?>
                                    <a class="btn btn-primary" href="warning_inactive_function.php?id_datetime=<?php echo $datetime_show->id_datetime ?>">ACTIVO</a>
                                 <?php }else{?> 
                                    <a class="btn btn-success mb-2" href="warning_active_function.php?id_datetime=<?php echo $datetime_show->id_datetime ?>">INACTIVO</a>
                                <?php } ?>
                            </td>
                            <td><a class="btn btn-danger" href="warning_delete_datetime.php?id_datetime=<?php echo $datetime_show->id_datetime ?>">ELIMINAR</a></td>
                            <td>
    <canvas id="chart_<?php echo $datetime_show->id_datetime; ?>"></canvas>
    <script>
        var ctx_<?php echo $datetime_show->id_datetime; ?> = document.getElementById('chart_<?php echo $datetime_show->id_datetime; ?>').getContext('2d');
        var chart_<?php echo $datetime_show->id_datetime; ?> = new Chart(ctx_<?php echo $datetime_show->id_datetime; ?>, {
            type: 'bar',
            data: {
                labels: ['Entradas Vendidas'],
                datasets: [{
                    label: '',
                    data: [<?php echo getEntradasVendidas($datetime_show->id_datetime); ?>],
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: function(value, context) {
                            return value;
                        }
                    }
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    datalabels: {
                        color: 'black',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                responsive: true, // Hace que el gráfico sea responsive
                maintainAspectRatio: false, // Evita que el gráfico mantenga su relación de aspecto
                aspectRatio: 2, // Ajusta la relación de aspecto según tus necesidades
            }
        });
    </script>
</td>

                        </tr>
                    <?php }
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    </main>
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
</html>