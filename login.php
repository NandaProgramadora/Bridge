<?php
session_start();
include "conexao.php";

$error = "";

if (isset($_POST['Btn-login'])) {

    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        $error = "Preencha todos os campos!";
    } else {

        $stmt = $connect->prepare("SELECT senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $dados = $result->fetch_assoc();

            if (password_verify($senha, $dados['senha'])) {
                $_SESSION['usuario'] = $email;
                header("Location: painel.php");
                exit;
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
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
</head>
<body>

<div id="g_id_onload"
     data-client_id="109271162916-djqelorifnogklabl2bed5jld8b2map9.apps.googleusercontent.com"
     data-callback="handleCredentialResponse">
</div>

<h2>Login</h2>

<form method="POST">
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="senha" placeholder="Senha" required>
  <button type="submit" name="Btn-login">Entrar</button>
</form>

<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

<hr>

<!-- LOGIN COM GOOGLE -->
<script src="https://accounts.google.com/gsi/client" async defer></script>

<div id="g_id_onload"
     data-client_id="SEU_CLIENT_ID"
     data-callback="handleCredentialResponse">
</div>

<div class="g_id_signin"></div>

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
</script>

</body>
</html>