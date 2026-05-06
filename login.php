<?php
session_start();
include "conexao.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Btn-login'])) {

    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        $error = "Preencha todos os campos!";
    } else {
        $sql = "SELECT * FROM usuarios WHERE email_usuarios = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0){

            $user = mysqli_fetch_assoc($result);

            if (password_verify($senha, $user['senha_usuarios'])){

                $_SESSION['usuario'] = $user['email_usuarios'];
                $_SESSION['tipo'] = $user['tipo_usuarios'];

                if ($user['tipo_usuarios'] == 'admin'){
                    header("Location: painel_professor.php");
                } else {
                    header("Location: painel_aluno.php");
                }
                exit();
            } else {
                $error = "Senha incorreta!";
            }

        } else {
            $error = "Usuário não encontrado!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: #f4f6f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.5s ease;
}

body.loaded {
    opacity: 1;
    transform: translateY(0);
}

body.fade-out {
    opacity: 0;
    transform: translateY(-20px);
}

.container {
    background: #fff;
    padding: 30px;
    width: 350px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.container h2 {
    text-align: center;
    color: #3b82f6;
    margin-bottom: 15px;
}

label {
    font-size: 14px;
    margin-top: 10px;
    display: block;
}

input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
}

input:focus {
    border-color: #3b82f6;
}

button {
    width: 100%;
    margin-top: 15px;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: #3b82f6;
    color: white;
    font-weight: 600;
    cursor: pointer;
}

button:hover {
    background: #2563eb;
}

a {
    color: #3b82f6;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

p {
    text-align: center;
    margin-top: 10px;
    font-size: 14px;
}

.erro {
    color: red;
    margin-top: 10px;
}

.google-login {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}
</style>

<script src="https://accounts.google.com/gsi/client" async defer></script>

<div id="g_id_onload"
     data-client_id="SEU_CLIENT_ID_AQUI"
     data-callback="handleCredentialResponse">
</div>

</head>

<body>

<div class="container">
      <h2>Bem-vindo de volta</h2>
      <p class="sub">Entre para acessar sua conta</p>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" placeholder="seu@email.com" required>

        <label>Senha</label>
        <input type="password" name="senha" placeholder="*****" required>

        <button type="submit" name="Btn-login">Entrar</button>
    </form>

    <?php if (!empty($error)) echo "<p class='erro'>$error</p>"; ?>

    <hr style="margin:20px 0; border:none; border-top:1px solid #eee;">

    <div class="google-login">
        <div class="g_id_signin"
            data-type="standard"
            data-size="large"
            data-theme="outline"
            data-text="signin_with"
            data-shape="rectangular">
        </div>
    </div>

    <p>Não tem conta? <a href="cadastro.php">Cadastrar</a></p>
    <p><a href="paginainicial.php">Voltar</a></p>
</div>

<script>
function handleCredentialResponse(response) {
    const data = parseJwt(response.credential);

    fetch("google-login.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(data)
    })
    .then(() => window.location = "painel.php");
}

function parseJwt(token) {
    let base64Url = token.split('.')[1];
    let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    let jsonPayload = decodeURIComponent(atob(base64).split('').map(c =>
        '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
    ).join(''));
    return JSON.parse(jsonPayload);
}

window.addEventListener("load", () => {
    document.body.classList.add("loaded");
});

document.querySelector("form").addEventListener("submit", function() {
    document.body.classList.remove("loaded");
    document.body.classList.add("fade-out");
});

document.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", function(e) {
        e.preventDefault();
        let destino = this.href;

        document.body.classList.add("fade-out");

        setTimeout(() => {
            window.location = destino;
        }, 400);
    });
});

</script>

</body>
</html>