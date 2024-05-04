<?php
session_start();

$allowed_user = true;

if (
    !isset($_SESSION['nom']) || !is_string($_SESSION['nom']) ||
    !isset($_SESSION['mot_de_passe']) || !is_string($_SESSION['mot_de_passe'])
) {
    $allowed_user = false;
}

if (!$allowed_user) {
    require_once ("./logout.php");
}
?>