<?php
require_once 'dotenv.php'; // Carrega as variáveis de ambiente do arquivo credenciais.env

// Obtém as credenciais do banco a partir das variáveis de ambiente
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = getenv('DB_PORT');

try {
    // Conexão com banco PostgreSQL (Supabase ou outro servidor compatível)
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Ativa mensagens de erro em formato de exceção
} catch (PDOException $e) {
    error_log($e->getMessage()); // Registra erro no log do servidor
    die("Erro ao conectar ao banco de dados."); // Mostra mensagem amigável ao usuário
}
