<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "bridge";

<<<<<<< HEAD
$conn = new mysqli($host, $user, $password, $database, 3307);
=======
$conn = new mysqli($host, $user, $password, $database);
>>>>>>> f6df5b098a403a53b1f964290b33916d4e2564e8

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>

