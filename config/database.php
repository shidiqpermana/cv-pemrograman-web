<?php
/**
 * Konfigurasi database — sesuaikan dengan XAMPP Anda
 */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cv_db');

define('APP_NAME', 'CV Editor');
define('BASE_URL', ''); // kosong jika di root htdocs folder proyek

function db(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    return $pdo;
}

function e(?string $str): string
{
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash(): ?array
{
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $f;
    }
    return null;
}

function require_login(): void
{
    if (empty($_SESSION['admin_id'])) {
        redirect('login.php');
    }
}

function photo_src(?string $url, string $name = 'User'): string
{
    if ($url && trim($url) !== '') {
        return e($url);
    }
    $q = urlencode($name);
    return "https://ui-avatars.com/api/?name={$q}&size=128&background=3c8dbc&color=fff&bold=true";
}
