<?php  
include_once "../models/functions.php";

$id_order = $_GET['id'];


$ok=confirmReservation($id_order);

if($ok)
{

    header("Location: http://192.168.81.171:8080/TicketRun/view/conf_qr.php?id=".$id_order);

}