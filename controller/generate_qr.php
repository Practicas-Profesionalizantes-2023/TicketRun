<?php
session_start();

require_once "../libs/QR/qrcode.class.php";

$id=$_SESSION["order"];


$url = "http://192.168.1.76:8080/PlayTickets/view/conf_qr.php?id=".$id;


$qrcode = new QRcode(utf8_encode($url), 'L');
$qrcode->displayPNG(200);

exit();