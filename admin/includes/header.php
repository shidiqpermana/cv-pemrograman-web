<?php
if (!isset($adminTitle)) {
    $adminTitle = 'Dashboard';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($adminTitle) ?> — CV Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a class="nav-link" href="../index.php" target="_blank"><i class="fas fa-eye mr-1"></i> Lihat CV</a></li>
      <li class="nav-item"><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt mr-1"></i> Logout</a></li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link"><span class="brand-text font-weight-light ml-3">CV Editor</span></a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
          <li class="nav-header">DATA CV</li>
          <li class="nav-item"><a href="index.php?tab=profile" class="nav-link <?= ($tab ?? 'profile') === 'profile' ? 'active' : '' ?>"><i class="nav-icon fas fa-user"></i><p>Profil</p></a></li>
          <li class="nav-item"><a href="index.php?tab=stats" class="nav-link <?= ($tab ?? '') === 'stats' ? 'active' : '' ?>"><i class="nav-icon fas fa-chart-bar"></i><p>Statistik</p></a></li>
          <li class="nav-item"><a href="index.php?tab=skills" class="nav-link <?= ($tab ?? '') === 'skills' ? 'active' : '' ?>"><i class="nav-icon fas fa-code"></i><p>Keahlian</p></a></li>
          <li class="nav-item"><a href="index.php?tab=experience" class="nav-link <?= ($tab ?? '') === 'experience' ? 'active' : '' ?>"><i class="nav-icon fas fa-briefcase"></i><p>Pengalaman</p></a></li>
          <li class="nav-item"><a href="index.php?tab=education" class="nav-link <?= ($tab ?? '') === 'education' ? 'active' : '' ?>"><i class="nav-icon fas fa-graduation-cap"></i><p>Pendidikan</p></a></li>
          <li class="nav-item"><a href="index.php?tab=projects" class="nav-link <?= ($tab ?? '') === 'projects' ? 'active' : '' ?>"><i class="nav-icon fas fa-folder"></i><p>Proyek</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1 class="m-0"><?= e($adminTitle) ?></h1></div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <?php $flash = get_flash(); if ($flash): ?>
          <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= e($flash['message']) ?>
          </div>
        <?php endif; ?>
