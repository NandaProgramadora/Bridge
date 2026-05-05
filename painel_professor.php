<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Bem-vinda, <?= $_SESSION['usuario'] ?></h2>

<a href="logout.php">Sair</a>