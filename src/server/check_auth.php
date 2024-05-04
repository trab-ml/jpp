<?php
session_start();

if (!isset($_SESSION['nom']) || !is_string($_SESSION['nom'])) {
    header("Location: ../../index.html");
}
?>