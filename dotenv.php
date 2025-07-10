// dotenv.php
if (file_exists(__DIR__ . '/credenciais.env')) {
    $lines = file(__DIR__ . '/credenciais.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // ignora comentários
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
}