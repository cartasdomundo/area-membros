<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true) {
    header("Location: login.php");
    exit;
}

// Define o nome de exibição
$nome = $_SESSION["nome"] ?? $_SESSION["email"] ?? "Usuário";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Área do Membro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="bg-white p-5 rounded shadow text-center">
    <h2 class="mb-4">Olá, <?= htmlspecialchars($nome) ?>!</h2>
    <p class="mb-4">Você está logado. Esta é sua área de membros.</p>
    <a href="logout.php" class="btn btn-danger">Sair</a>
  </div>
</div>

</body>
</html>
