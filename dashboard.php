<?php
session_start();
if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Área do Membro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="bg-white p-4 rounded shadow">
    <h2>Olá, <?= htmlspecialchars($_SESSION["nome"] ?? $_SESSION["email"]) ?>!</h2>
    <p>Você está logado. Esta é sua área de membros.</p>
    <a href="logout.php" class="btn btn-danger">Sair</a>
  </div>
</div>
</body>
</html>
