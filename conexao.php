<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "bridge";

$conn = new mysqli($host, $user, $password, $database, 3307);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>

