<?php
// Só carrega dotenv se estiver em ambiente local (com o arquivo presente)
if (file_exists(__DIR__ . '/credenciais.env')) {
    require_once 'dotenv.php';
}

// Obtém as credenciais do banco a partir das variáveis de ambiente
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = getenv('DB_PORT');

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Erro ao conectar ao banco de dados.");
}
