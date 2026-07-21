<?php
session_start();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/cv_data.php';

try {
    $cv = cv_get_all();
    $p = $cv['profile'];
} catch (Throwable $e) {
    header('Location: install.php');
    exit;
}

if (empty($p)) {
    header('Location: install.php');
    exit;
}

$pageTitle = 'CV — ' . ($p['full_name'] ?? 'Portfolio');
require __DIR__ . '/includes/cv_view.php';
