<?php
/** @var array $cv */
/** @var array $p */
$stats = $cv['stats'];
$skills = $cv['skills'];
$tools = $cv['tools'];
$softSkills = $cv['soft_skills'];
$experiences = $cv['experiences'];
$education = $cv['education'];
$certs = $cv['certifications'];
$projects = $cv['projects'];
$photo = photo_src($p['photo_url'] ?? '', $p['full_name'] ?? 'User');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/css/cv.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed cv-page">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-dark cv-navbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Toggle menu">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>
    <span class="navbar-brand mb-0 h1 d-none d-sm-inline">Curriculum Vitae</span>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="admin/login.php" title="Edit CV">
          <i class="fas fa-edit mr-1"></i> Edit
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="window.print(); return false;" title="Cetak CV">
          <i class="fas fa-print mr-1"></i> Cetak
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4 cv-sidebar">
    <a href="index.php" class="brand-link text-center cv-brand">
      <span class="brand-text font-weight-light">Portfolio</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column align-items-center text-center">
        <div class="image mb-3">
          <img src="<?= $photo ?>" class="img-circle elevation-2 cv-avatar" alt="Foto profil" width="128" height="128">
        </div>
        <div class="info w-100">
          <h5 class="text-white mb-1"><?= e($p['full_name']) ?></h5>
          <p class="text-muted small mb-0"><?= e($p['job_title']) ?></p>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item"><a href="#profil" class="nav-link active"><i class="nav-icon fas fa-user"></i><p>Profil</p></a></li>
          <li class="nav-item"><a href="#keahlian" class="nav-link"><i class="nav-icon fas fa-code"></i><p>Keahlian</p></a></li>
          <li class="nav-item"><a href="#pengalaman" class="nav-link"><i class="nav-icon fas fa-briefcase"></i><p>Pengalaman</p></a></li>
          <li class="nav-item"><a href="#pendidikan" class="nav-link"><i class="nav-icon fas fa-graduation-cap"></i><p>Pendidikan</p></a></li>
          <li class="nav-item"><a href="#proyek" class="nav-link"><i class="nav-icon fas fa-folder-open"></i><p>Proyek</p></a></li>
          <li class="nav-item"><a href="#kontak" class="nav-link"><i class="nav-icon fas fa-envelope"></i><p>Kontak</p></a></li>
        </ul>
      </nav>

      <div class="sidebar-contact px-3 pb-4 mt-4">
        <h6 class="text-uppercase text-muted small mb-3">Hubungi Saya</h6>
        <ul class="list-unstyled contact-list">
          <?php if ($p['email']): ?><li><i class="fas fa-envelope text-info"></i> <?= e($p['email']) ?></li><?php endif; ?>
          <?php if ($p['phone']): ?><li><i class="fas fa-phone text-info"></i> <?= e($p['phone']) ?></li><?php endif; ?>
          <?php if ($p['location']): ?><li><i class="fas fa-map-marker-alt text-info"></i> <?= e($p['location']) ?></li><?php endif; ?>
          <?php if ($p['linkedin']): ?><li><i class="fab fa-linkedin text-info"></i> <?= e($p['linkedin']) ?></li><?php endif; ?>
          <?php if ($p['github']): ?><li><i class="fab fa-github text-info"></i> <?= e($p['github']) ?></li><?php endif; ?>
        </ul>
      </div>
    </div>
  </aside>

  <div class="content-wrapper cv-content-wrapper">
    <div class="content-header cv-content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 cv-hero-title">Halo, saya <span class="text-primary"><?= e($p['full_name']) ?></span></h1>
            <p class="text-muted mb-0"><?= e($p['headline']) ?></p>
          </div>
          <div class="col-sm-4 d-none d-sm-flex align-items-center justify-content-end">
            <?php if (!empty($p['status_badge'])): ?>
            <span class="badge badge-primary cv-badge-status"><i class="fas fa-circle mr-1"></i> <?= e($p['status_badge']) ?></span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

        <div id="profil" class="row cv-section">
          <div class="col-12">
            <div class="card card-outline card-primary shadow-sm">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user mr-2"></i> Tentang Saya</h3>
              </div>
              <div class="card-body">
                <?php if ($p['about_lead']): ?><p class="lead mb-3"><?= nl2br(e($p['about_lead'])) ?></p><?php endif; ?>
                <?php if ($p['about_body']): ?><p class="mb-0 text-muted"><?= nl2br(e($p['about_body'])) ?></p><?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <?php if ($stats): ?>
        <div class="row cv-stats">
          <?php foreach ($stats as $st): ?>
          <div class="col-lg-3 col-6">
            <div class="small-box <?= e($st['color']) ?>">
              <div class="inner">
                <h3><?= e($st['value']) ?></h3>
                <p><?= e($st['label']) ?></p>
              </div>
              <div class="icon"><i class="<?= e($st['icon']) ?>"></i></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div id="keahlian" class="row cv-section">
          <div class="col-md-6">
            <div class="card card-outline card-info shadow-sm h-100">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-laptop-code mr-2"></i> Keahlian Teknis</h3>
              </div>
              <div class="card-body">
                <?php foreach ($skills as $i => $sk): ?>
                <div class="skill-item <?= $i === count($skills) - 1 ? 'mb-0' : 'mb-3' ?>">
                  <div class="d-flex justify-content-between mb-1">
                    <span><?= e($sk['name']) ?></span>
                    <span class="text-muted"><?= (int) $sk['percent'] ?>%</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar <?= e($sk['color']) ?>" style="width: <?= (int) $sk['percent'] ?>%"></div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-outline card-secondary shadow-sm h-100">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-tags mr-2"></i> Tools &amp; Soft Skills</h3>
              </div>
              <div class="card-body">
                <?php if ($tools): ?>
                <p class="mb-2"><strong>Tools:</strong></p>
                <div class="mb-3">
                  <?php foreach ($tools as $t): ?>
                  <span class="badge badge-light border mr-1 mb-1"><?= e($t['name']) ?></span>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php if ($softSkills): ?>
                <p class="mb-2"><strong>Soft Skills:</strong></p>
                <ul class="mb-0 pl-3 text-muted">
                  <?php foreach ($softSkills as $ss): ?>
                  <li><?= e($ss['name']) ?></li>
                  <?php endforeach; ?>
                </ul>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <?php if ($experiences): ?>
        <div id="pengalaman" class="row cv-section">
          <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-briefcase mr-2"></i> Pengalaman Kerja / Magang</h3>
              </div>
              <div class="card-body p-0">
                <div class="timeline cv-timeline">
                  <?php foreach ($experiences as $ex): ?>
                  <div>
                    <i class="<?= e($ex['icon']) ?> <?= e($ex['color']) ?>"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-calendar"></i> <?= e($ex['period']) ?></span>
                      <h3 class="timeline-header"><?= e($ex['title']) ?></h3>
                      <div class="timeline-body"><?= nl2br(e($ex['description'])) ?></div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <div id="pendidikan" class="row cv-section">
          <?php if ($education): ?>
          <div class="col-lg-6">
            <div class="card card-outline card-warning shadow-sm h-100">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-graduation-cap mr-2"></i> Pendidikan</h3>
              </div>
              <div class="card-body">
                <?php foreach ($education as $i => $ed): ?>
                <?php if ($i > 0): ?><hr><?php endif; ?>
                <div class="post <?= $i === count($education) - 1 ? 'clearfix mb-0' : '' ?>">
                  <div class="user-block">
                    <span class="username"><?= e($ed['degree']) ?></span>
                    <span class="description"><?= e($ed['institution']) ?></span>
                  </div>
                  <?php if ($ed['detail']): ?><p class="text-muted mb-2"><?= e($ed['detail']) ?></p><?php endif; ?>
                  <?php if ($ed['description']): ?><p class="mb-0 text-muted"><?= e($ed['description']) ?></p><?php endif; ?>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <?php if ($certs): ?>
          <div class="col-lg-6">
            <div class="card card-outline card-danger shadow-sm h-100">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-certificate mr-2"></i> Sertifikasi &amp; Pelatihan</h3>
              </div>
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2 cv-cert-list">
                  <?php foreach ($certs as $i => $c): ?>
                  <li class="item <?= $i === count($certs) - 1 ? 'border-0' : '' ?>">
                    <div class="product-info">
                      <span class="product-title"><?= e($c['title']) ?></span>
                      <span class="product-description"><?= e($c['issuer']) ?></span>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>

        <?php if ($projects): ?>
        <div id="proyek" class="row cv-section">
          <div class="col-12">
            <div class="card card-outline card-primary shadow-sm">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-folder-open mr-2"></i> Proyek Terpilih</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <?php foreach ($projects as $i => $pr): ?>
                  <div class="col-md-4 <?= $i < count($projects) - 1 ? 'mb-4 mb-md-0' : '' ?>">
                    <div class="card bg-light cv-project-card h-100">
                      <div class="card-body">
                        <?php if ($pr['category']): ?>
                        <span class="badge <?= e($pr['badge_color']) ?> mb-2"><?= e($pr['category']) ?></span>
                        <?php endif; ?>
                        <h5 class="card-title"><?= e($pr['title']) ?></h5>
                        <p class="card-text text-muted small"><?= e($pr['description']) ?></p>
                        <a href="<?= e(cv_external_url($pr['repo_url'])) ?>" class="btn btn-sm btn-outline-primary"><i class="fab fa-github"></i> Repo</a>
                        <a href="<?= e(cv_external_url($pr['demo_url'])) ?>" class="btn btn-sm btn-outline-info"><i class="fas fa-external-link-alt"></i> Demo</a>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <div id="kontak" class="row cv-section mb-4">
          <div class="col-12">
            <div class="card card-outline card-info shadow-sm cv-contact-card">
              <div class="card-body text-center py-5">
                <h3 class="mb-3"><?= e($p['contact_title']) ?></h3>
                <p class="text-muted mb-4"><?= e($p['contact_text']) ?></p>
                <div class="btn-group flex-wrap justify-content-center">
                  <?php if ($p['email']): ?>
                  <a href="<?= e(cv_mailto($p['email'])) ?>" class="btn btn-primary m-1"><i class="fas fa-envelope mr-1"></i> Email</a>
                  <?php endif; ?>
                  <?php if ($p['whatsapp'] || $p['phone']): ?>
                  <a href="<?= e(cv_whatsapp_url($p['whatsapp'] ?: $p['phone'])) ?>" class="btn btn-success m-1" target="_blank" rel="noopener"><i class="fab fa-whatsapp mr-1"></i> WhatsApp</a>
                  <?php endif; ?>
                  <?php if ($p['linkedin']): ?>
                  <a href="<?= e(cv_external_url($p['linkedin'])) ?>" class="btn btn-info m-1" target="_blank" rel="noopener"><i class="fab fa-linkedin mr-1"></i> LinkedIn</a>
                  <?php endif; ?>
                  <?php if ($p['github']): ?>
                  <a href="<?= e(cv_external_url($p['github'])) ?>" class="btn btn-dark m-1" target="_blank" rel="noopener"><i class="fab fa-github mr-1"></i> GitHub</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>

  <footer class="main-footer cv-footer text-sm">
    <strong>CV Pemrograman Web</strong> — Dibuat dengan AdminLTE 3 &amp; PHP MySQL
    <div class="float-right d-none d-sm-inline-block"><?= date('Y') ?></div>
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="assets/js/cv.js"></script>
</body>
</html>
