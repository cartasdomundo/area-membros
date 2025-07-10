<?php
session_start();
require 'conexao.php';

$GURU_TOKEN = 'Bearer 9d5778eb-f161-4753-863f-d189c590b322|A4UUJr4o7DbZvGUo2ruEhcihfRatLOhiA5AwEH8Dec4afd7c'; // substitua aqui

$erro = "";
$sucesso = "";

function verificar_email_no_guru($email, $token) {
    $url = "https://digitalmanager.guru/api/v2/contacts?email=" . urlencode($email);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: $token",
        "Accept: application/json"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) return false;

    $data = json_decode($response, true);
    return !empty($data['data']);  // se houver dados, o e-mail existe no Guru
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $nome  = $_POST['nome'];

    if (!verificar_email_no_guru($email, $GURU_TOKEN)) {
        $erro = "Este e-mail não possui assinatura ativa.";
    } else {
        // Verifica se já existe usuário
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $erro = "Este e-mail já está cadastrado.";
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $hash]);
            $sucesso = "Cadastro realizado com sucesso. Faça login.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Criar Conta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title mb-4">Criar Conta</h3>

          <?php if ($erro): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
          <?php elseif ($sucesso): ?>
            <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
          <?php endif; ?>

          <form method="post">
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">E-mail</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Senha</label>
              <input type="password" name="senha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Criar Conta</button>
          </form>
          <div class="mt-3 text-center">
            <a href="login.php">Já tem conta? Entrar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
