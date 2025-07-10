<?php
$host = 'db.gbxncpcjthsbtuytcsdr.supabase.co';
$db   = 'postgres';
$user = 'postgres';
$pass = 'Bandos2023*'; // Substitua aqui pela senha que você criou no Supabase
$port = 5432;

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erro na conexão com o Supabase: " . $e->getMessage());
}
