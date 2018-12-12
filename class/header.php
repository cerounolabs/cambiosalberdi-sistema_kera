<?php
    session_start();
    $idSession  = $_SESSION['Sys00'];
    $wFecha     = date('Y/m/d');
    $tFecha     = date('d/m/Y');
    $wHora      = date('H:i:s');

    if (!isset($idSession) || ($wHora > date('19:00:00'))) {
        unset($idSession);
        header('Location: ../class/logout.php');
    }

    include '../class/function.php';
?>