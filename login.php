<?php
session_start();
require 'conexao.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario["senha_hash"])) {
        $_SESSION["logado"] = true;
        $_SESSION["email"] = $usuario["email"];
        $_SESSION["nome"] = $usuario["nome"];
        header("Location: dashboard.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
<div class="container text-center">
  <div class="row justify-content-center">
    <div class="col-md-4 bg-white p-4 rounded shadow">
      <h2>Área de Membros</h2>
      <?php if ($erro): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
      <?php endif; ?>
      <form method="post">
        <input type="email" name="email" class="form-control mb-3" placeholder="Seu e-mail" required>
        <input type="password" name="senha" class="form-control mb-3" placeholder="Sua senha" required>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>
