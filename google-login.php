<?php
session_start();
include "conexao.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['email'])) {
    http_response_code(400);
    exit;
}

$email = $data['email'];
$nome = $data['name'] ?? 'Usuário';

// verifica se existe
$stmt = $connect->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $stmt = $connect->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $email);
    $stmt->execute();
}

// cria sessão
$_SESSION['usuario'] = $email;
