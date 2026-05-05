<?php
session_start();
$titulo = "Bridge";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $titulo; ?></title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', Arial, Helvetica, sans-serif;
}

h2{
    margin-bottom: 25px;
}

body {
    background: #f5f7fb;
}

.navbar {
    display: flex;
    justify-content: space-between;
    padding: 15px 40px;
    background: #fff;
}

.navbar a {
    margin-left: 15px;
    text-decoration: none;
    color: #333;
}

.btn {
    padding: 8px 16px;
    border-radius: 20px;
    text-decoration: none;
    display: inline-block;
    transition: transform 0.2s ease;
}

.btn:hover {
    transform: translateY(-3px);
}

.btn-primary {
    background: #4a90e2;
    color: white;
}

.btn-outline {
    border: 1px solid #4a90e2;
    color: #4a90e2;
}

.hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 60px 40px;
    background: linear-gradient(90deg, #dceeff, #cbe3ff);
}

.hero-text {
    max-width: 500px;
}

.hero h1 {
    font-size: 36px;
    color: #4a90e2;
    margin-bottom: 15px;
}

.hero p {
    margin-bottom: 20px;
    color: #555;
}

.hero img {
    width: 300px;
    border-radius: 15px;
}

.features {
    text-align: center;
    padding: 50px 20px;
}

.cards {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.card {
    background: #fff;
    padding: 20px;
    width: 200px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-3px);
}

.card h3 {
    margin-top: 10px;
    color: #4a90e2;
}

.about {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 40px;
    padding: 50px;
}

.about img {
    width: 300px;
    border-radius: 15px;
}

.about ul {
    list-style: none;
}

.about li {
    margin-bottom: 10px;
}

.cta {
    text-align: center;
    padding: 40px;
    background: #4a90e2;
    color: white;
}

.btn-cta {
    margin-top: 15px;
    display: inline-block;
    background: #fff;
    color: #4a90e2;
    font-weight: 600;
    padding: 10px 22px;
    border-radius: 25px;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.entrar:hover{
    color: #4a90e2;
}
</style>
</head>

<body>

<div class="navbar">
    <h3><?php echo $titulo; ?></h3>
    <div>
        <a href="login.php" class="entrar">Entrar</a>
        <a href="cadastro.php" class="btn btn-primary" style="color: white;">Cadastre-se</a>
    </div>
</div>

<section class="hero">
    <div class="hero-text">
        <h1>Seu Espaço Seguro<br>para Crescer e Aprender</h1>
        <p>Apoio emocional, educacional e social na palma da sua mão.</p>

        <a href="cadastro.php" class="btn btn-primary">Cadastre-se</a>
        <a href="login.php" class="btn btn-outline">Entrar</a>
    </div>

    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f" alt="Estudante">
</section>

<section class="features">
    <h2>Tudo que você precisa em um só lugar</h2>

    <div class="cards">
        <div class="card">
            <h3>Chat Inteligente</h3>
            <p>Converse com IA para tirar dúvidas</p>
        </div>

        <div class="card">
            <h3>Educação</h3>
            <p>Conteúdos educativos</p>
        </div>

        <div class="card">
            <h3>Plano de Estudos</h3>
            <p>Organize sua rotina</p>
        </div>

        <div class="card">
            <h3>Apoio Psicológico</h3>
            <p>Ajuda profissional</p>
        </div>
    </div>
</section>

<section class="about">
    <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac" alt="Grupo">

    <div>
        <h2>Por que usar o Bridge?</h2>
        <ul>
            <li>✔ Redução da evasão escolar</li>
            <li>✔ Apoio emocional acessível</li>
            <li>✔ Melhor desempenho</li>
            <li>✔ Ambiente seguro</li>
        </ul>
    </div>
</section>

<section class="cta">
    <h2>Pronto para começar?</h2>
    <p>Junte-se a milhares de estudantes</p>
    <a href="login.php" class="btn-cta">Começar agora</a>
</section>

</body>
</html>