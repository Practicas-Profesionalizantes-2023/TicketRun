<?php
session_start();
include_once "../models/functions.php";

$comp = login();
$logged_admin = false;

foreach ($comp as $compara) {
    if (
        $compara->email === $_POST["email"] &&
        password_verify($_POST["_password"], $compara->_password) &&
        $compara->user_state === 1
    ) {
        $_SESSION["email"] = $compara->email;
        $_SESSION["name"] = $compara->user_name;
        $_SESSION["id_user"] = $compara->id_user;

        if ($compara->id_rol === 2) {
            $logged_admin = true;
        }
    }
}

if ($logged_admin) {
    header("location: ../view/main_supplier_sector.php");

} else {
    header("location: ../view/admin.php?error=1");
}
?>
