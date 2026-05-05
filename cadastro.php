<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro</title>

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
    width: 380px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.container h2 {
    text-align: center;
    color: #3b82f6;
    margin-bottom: 5px;
}

.container .sub {
    text-align: center;
    color: #777;
    font-size: 14px;
    margin-bottom: 20px;
}

label {
    font-size: 14px;
    color: #333;
    margin-top: 10px;
    display: block;
}

input, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    transition: 0.3s;
}

input:focus, select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 5px rgba(59,130,246,0.3);
}

button {
    width: 100%;
    margin-top: 20px;
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

.google-login {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

a, p{
    text-align: center;
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
    <h2>Crie sua conta</h2>
    <p class="sub">Comece sua jornada conosco</p>

    <form action="cadastro.php" method="post">
        
        <label>Nome Completo</label>
        <input type="text" name="nome" placeholder="Seu nome" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="seu@email.com" required>

        <label>Perfil</label>
        <select name="tipo_usuario" required>
            <option value="Estudante">Estudante</option>
            <option value="Professor">Professor</option>
            <option value="Membro da sociedade">Membro da sociedade</option>
        </select>

        <label>Senha</label>
        <input type="password" name="senha" placeholder="******" required>

        <label>Confirmar Senha</label>
        <input type="password" name="confirmar_senha" placeholder="******" required>

        <button type="submit" name="Btn-cadastrar">Cadastrar</button>

        <hr style="margin:20px 0; border:none; border-top:1px solid #eee;">

        <div class="google-login">
            <div class="g_id_signin"
                data-type="standard"
                data-size="large"
                data-theme="outline"
                data-text="signin_with"
                data-shape="rectangular"
                data-logo_alignment="left">
            </div>
        </div>

        <p>Já tem conta? <a href="login.php">Entrar</a></p>
    </form>
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

document.querySelector("form").addEventListener("submit", function(e) {

    let senha = document.querySelector('input[name="senha"]').value;
    let confirmar = document.querySelector('input[name="confirmar_senha"]').value;

    if (senha !== confirmar) {
        e.preventDefault();
        alert("As senhas não coincidem!");
        return;
    }

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