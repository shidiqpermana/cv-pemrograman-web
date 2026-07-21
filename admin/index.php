<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/cv_data.php';
require_login();

$tab = $_GET['tab'] ?? 'profile';
$allowed = ['profile', 'stats', 'skills', 'experience', 'education', 'projects'];
if (!in_array($tab, $allowed, true)) {
    $tab = 'profile';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        switch ($tab) {
            case 'profile':
                cv_save_profile([
                    'full_name'     => trim($_POST['full_name'] ?? ''),
                    'job_title'     => trim($_POST['job_title'] ?? ''),
                    'headline'      => trim($_POST['headline'] ?? ''),
                    'about_lead'    => trim($_POST['about_lead'] ?? ''),
                    'about_body'    => trim($_POST['about_body'] ?? ''),
                    'email'         => trim($_POST['email'] ?? ''),
                    'phone'         => trim($_POST['phone'] ?? ''),
                    'location'      => trim($_POST['location'] ?? ''),
                    'linkedin'      => trim($_POST['linkedin'] ?? ''),
                    'github'        => trim($_POST['github'] ?? ''),
                    'whatsapp'      => trim($_POST['whatsapp'] ?? ''),
                    'photo_url'     => trim($_POST['photo_url'] ?? ''),
                    'status_badge'  => trim($_POST['status_badge'] ?? ''),
                    'contact_title' => trim($_POST['contact_title'] ?? ''),
                    'contact_text'  => trim($_POST['contact_text'] ?? ''),
                ]);
                break;

            case 'stats':
                $rows = [];
                foreach ($_POST['label'] ?? [] as $i => $label) {
                    if (trim($label) === '') continue;
                    $rows[] = [
                        'label'      => trim($label),
                        'value'      => trim($_POST['value'][$i] ?? ''),
                        'icon'       => trim($_POST['icon'][$i] ?? 'fas fa-star'),
                        'color'      => trim($_POST['color'][$i] ?? 'bg-info'),
                        'sort_order' => $i + 1,
                    ];
                }
                cv_save_stats($rows);
                break;

            case 'skills':
                $skillRows = [];
                foreach ($_POST['skill_name'] ?? [] as $i => $name) {
                    if (trim($name) === '') continue;
                    $skillRows[] = [
                        'name'       => trim($name),
                        'percent'    => (int) ($_POST['skill_percent'][$i] ?? 50),
                        'color'      => trim($_POST['skill_color'][$i] ?? 'bg-info'),
                        'sort_order' => $i + 1,
                    ];
                }
                cv_save_skills($skillRows);

                $toolRows = [];
                foreach ($_POST['tool_name'] ?? [] as $i => $name) {
                    if (trim($name) === '') continue;
                    $toolRows[] = ['name' => trim($name), 'sort_order' => $i + 1];
                }
                cv_save_tools($toolRows);

                $softRows = [];
                foreach ($_POST['soft_name'] ?? [] as $i => $name) {
                    if (trim($name) === '') continue;
                    $softRows[] = ['name' => trim($name), 'sort_order' => $i + 1];
                }
                cv_save_soft_skills($softRows);
                break;

            case 'experience':
                $rows = [];
                foreach ($_POST['period'] ?? [] as $i => $period) {
                    if (trim($_POST['title'][$i] ?? '') === '') continue;
                    $rows[] = [
                        'period'      => trim($period),
                        'title'       => trim($_POST['title'][$i] ?? ''),
                        'description' => trim($_POST['description'][$i] ?? ''),
                        'icon'        => trim($_POST['icon'][$i] ?? 'fas fa-briefcase'),
                        'color'       => trim($_POST['color'][$i] ?? 'bg-success'),
                        'sort_order'  => $i + 1,
                    ];
                }
                cv_save_experiences($rows);
                break;

            case 'education':
                $eduRows = [];
                foreach ($_POST['degree'] ?? [] as $i => $degree) {
                    if (trim($degree) === '') continue;
                    $eduRows[] = [
                        'degree'       => trim($degree),
                        'institution'  => trim($_POST['institution'][$i] ?? ''),
                        'detail'       => trim($_POST['detail'][$i] ?? ''),
                        'description'  => trim($_POST['description'][$i] ?? ''),
                        'sort_order'   => $i + 1,
                    ];
                }
                cv_save_education($eduRows);

                $certRows = [];
                foreach ($_POST['cert_title'] ?? [] as $i => $title) {
                    if (trim($title) === '') continue;
                    $certRows[] = [
                        'title'      => trim($title),
                        'issuer'     => trim($_POST['cert_issuer'][$i] ?? ''),
                        'sort_order' => $i + 1,
                    ];
                }
                cv_save_certifications($certRows);
                break;

            case 'projects':
                $rows = [];
                foreach ($_POST['title'] ?? [] as $i => $title) {
                    if (trim($title) === '') continue;
                    $rows[] = [
                        'title'       => trim($title),
                        'category'    => trim($_POST['category'][$i] ?? ''),
                        'badge_color' => trim($_POST['badge_color'][$i] ?? 'badge-primary'),
                        'description' => trim($_POST['project_description'][$i] ?? ''),
                        'repo_url'    => trim($_POST['repo_url'][$i] ?? '#'),
                        'demo_url'    => trim($_POST['demo_url'][$i] ?? '#'),
                        'sort_order'  => $i + 1,
                    ];
                }
                cv_save_projects($rows);
                break;
        }

        flash('success', 'Data berhasil disimpan ke database.');
        redirect('index.php?tab=' . urlencode($tab));
    } catch (Throwable $e) {
        flash('danger', 'Gagal menyimpan: ' . $e->getMessage());
        redirect('index.php?tab=' . urlencode($tab));
    }
}

$cv = cv_get_all();
$p = $cv['profile'];

$titles = [
    'profile'    => 'Edit Profil',
    'stats'      => 'Edit Statistik',
    'skills'     => 'Edit Keahlian',
    'experience' => 'Edit Pengalaman',
    'education'  => 'Edit Pendidikan & Sertifikasi',
    'projects'   => 'Edit Proyek',
];
$adminTitle = $titles[$tab];

require __DIR__ . '/includes/header.php';
?>

<form method="post" class="card card-primary card-outline">
  <div class="card-body">

    <?php if ($tab === 'profile'): ?>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group"><label>Nama Lengkap</label><input type="text" name="full_name" class="form-control" value="<?= e($p['full_name']) ?>" required></div>
          <div class="form-group"><label>Jabatan / Role</label><input type="text" name="job_title" class="form-control" value="<?= e($p['job_title']) ?>"></div>
          <div class="form-group"><label>Headline</label><input type="text" name="headline" class="form-control" value="<?= e($p['headline']) ?>"></div>
          <div class="form-group"><label>Status Badge</label><input type="text" name="status_badge" class="form-control" value="<?= e($p['status_badge']) ?>"></div>
          <div class="form-group"><label>URL Foto (opsional)</label><input type="url" name="photo_url" class="form-control" value="<?= e($p['photo_url']) ?>" placeholder="https://..."></div>
        </div>
        <div class="col-md-6">
          <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="<?= e($p['email']) ?>"></div>
          <div class="form-group"><label>Telepon</label><input type="text" name="phone" class="form-control" value="<?= e($p['phone']) ?>"></div>
          <div class="form-group"><label>WhatsApp (62...)</label><input type="text" name="whatsapp" class="form-control" value="<?= e($p['whatsapp']) ?>"></div>
          <div class="form-group"><label>Lokasi</label><input type="text" name="location" class="form-control" value="<?= e($p['location']) ?>"></div>
          <div class="form-group"><label>LinkedIn</label><input type="text" name="linkedin" class="form-control" value="<?= e($p['linkedin']) ?>"></div>
          <div class="form-group"><label>GitHub</label><input type="text" name="github" class="form-control" value="<?= e($p['github']) ?>"></div>
        </div>
        <div class="col-12">
          <div class="form-group"><label>Tentang Saya (paragraf 1)</label><textarea name="about_lead" class="form-control" rows="3"><?= e($p['about_lead']) ?></textarea></div>
          <div class="form-group"><label>Tentang Saya (paragraf 2)</label><textarea name="about_body" class="form-control" rows="3"><?= e($p['about_body']) ?></textarea></div>
          <div class="form-group"><label>Judul Kontak</label><input type="text" name="contact_title" class="form-control" value="<?= e($p['contact_title']) ?>"></div>
          <div class="form-group"><label>Teks Kontak</label><textarea name="contact_text" class="form-control" rows="2"><?= e($p['contact_text']) ?></textarea></div>
        </div>
      </div>

    <?php elseif ($tab === 'stats'): ?>
      <p class="text-muted">Widget statistik di halaman CV.</p>
      <div id="stats-rows">
        <?php foreach ($cv['stats'] as $st): ?>
        <div class="row stat-row border rounded p-2 mb-2 mx-0">
          <div class="col-md-3"><input type="text" name="label[]" class="form-control" placeholder="Label" value="<?= e($st['label']) ?>"></div>
          <div class="col-md-2"><input type="text" name="value[]" class="form-control" placeholder="Nilai" value="<?= e($st['value']) ?>"></div>
          <div class="col-md-3"><input type="text" name="icon[]" class="form-control" placeholder="Icon FA" value="<?= e($st['icon']) ?>"></div>
          <div class="col-md-3">
            <select name="color[]" class="form-control">
              <?php foreach (['bg-info','bg-success','bg-warning','bg-danger','bg-primary','bg-secondary'] as $c): ?>
              <option value="<?= $c ?>" <?= $st['color'] === $c ? 'selected' : '' ?>><?= $c ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i></button></div>
        </div>
        <?php endforeach; ?>
      </div>
      <button type="button" class="btn btn-secondary btn-sm" id="add-stat"><i class="fas fa-plus"></i> Tambah Statistik</button>

    <?php elseif ($tab === 'skills'): ?>
      <h5>Keahlian Teknis</h5>
      <div id="skill-rows" class="mb-4">
        <?php foreach ($cv['skills'] as $sk): ?>
        <div class="row skill-row border rounded p-2 mb-2 mx-0">
          <div class="col-md-4"><input type="text" name="skill_name[]" class="form-control" value="<?= e($sk['name']) ?>"></div>
          <div class="col-md-2"><input type="number" name="skill_percent[]" class="form-control" min="0" max="100" value="<?= (int) $sk['percent'] ?>"></div>
          <div class="col-md-3">
            <select name="skill_color[]" class="form-control">
              <?php foreach (['bg-info','bg-primary','bg-success','bg-warning','bg-danger'] as $c): ?>
              <option value="<?= $c ?>" <?= $sk['color'] === $c ? 'selected' : '' ?>><?= $c ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i></button></div>
        </div>
        <?php endforeach; ?>
      </div>
      <button type="button" class="btn btn-secondary btn-sm mb-4" id="add-skill"><i class="fas fa-plus"></i> Tambah Keahlian</button>

      <h5>Tools</h5>
      <div id="tool-rows" class="mb-4">
        <?php foreach ($cv['tools'] as $t): ?>
        <div class="input-group mb-2 tool-row">
          <input type="text" name="tool_name[]" class="form-control" value="<?= e($t['name']) ?>">
          <div class="input-group-append"><button type="button" class="btn btn-danger btn-remove-row"><i class="fas fa-trash"></i></button></div>
        </div>
        <?php endforeach; ?>
      </div>
      <button type="button" class="btn btn-secondary btn-sm mb-4" id="add-tool"><i class="fas fa-plus"></i> Tambah Tool</button>

      <h5>Soft Skills</h5>
      <div id="soft-rows">
        <?php foreach ($cv['soft_skills'] as $ss): ?>
        <div class="input-group mb-2 soft-row">
          <input type="text" name="soft_name[]" class="form-control" value="<?= e($ss['name']) ?>">
          <div class="input-group-append"><button type="button" class="btn btn-danger btn-remove-row"><i class="fas fa-trash"></i></button></div>
        </div>
        <?php endforeach; ?>
      </div>
      <button type="button" class="btn btn-secondary btn-sm" id="add-soft"><i class="fas fa-plus"></i> Tambah Soft Skill</button>

    <?php elseif ($tab === 'experience'): ?>
      <div id="exp-rows">
        <?php foreach ($cv['experiences'] as $ex): ?>
        <div class="border rounded p-3 mb-3 exp-row">
          <div class="row">
            <div class="col-md-3"><label>Periode</label><input type="text" name="period[]" class="form-control" value="<?= e($ex['period']) ?>"></div>
            <div class="col-md-9"><label>Judul</label><input type="text" name="title[]" class="form-control" value="<?= e($ex['title']) ?>"></div>
            <div class="col-12 mt-2"><label>Deskripsi</label><textarea name="description[]" class="form-control" rows="2"><?= e($ex['description']) ?></textarea></div>
            <div class="col-md-4 mt-2"><label>Icon</label><input type="text" name="icon[]" class="form-control" value="<?= e($ex['icon']) ?>"></div>
            <div class="col-md-4 mt-2">
              <label>Warna</label>
              <select name="color[]" class="form-control">
                <?php foreach (['bg-success','bg-info','bg-warning','bg-danger','bg-primary'] as $c): ?>
                <option value="<?= $c ?>" <?= $ex['color'] === $c ? 'selected' : '' ?>><?= $c ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-4 mt-2 d-flex align-items-end"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i> Hapus</button></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <button type="button" class="btn btn-secondary btn-sm" id="add-exp"><i class="fas fa-plus"></i> Tambah Pengalaman</button>

    <?php elseif ($tab === 'education'): ?>
      <h5>Pendidikan</h5>
      <div id="edu-rows" class="mb-4">
        <?php foreach ($cv['education'] as $ed): ?>
        <div class="border rounded p-3 mb-3 edu-row">
          <div class="form-group"><label>Gelar / Jenjang</label><input type="text" name="degree[]" class="form-control" value="<?= e($ed['degree']) ?>"></div>
          <div class="form-group"><label>Institusi &amp; Tahun</label><input type="text" name="institution[]" class="form-control" value="<?= e($ed['institution']) ?>"></div>
          <div class="form-group"><label>Detail (IPK, dll)</label><input type="text" name="detail[]" class="form-control" value="<?= e($ed['detail']) ?>"></div>
          <div class="form-group"><label>Deskripsi</label><textarea name="description[]" class="form-control" rows="2"><?= e($ed['description']) ?></textarea></div>
          <button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i> Hapus</button>
        </div>
        <?php endforeach; ?>
      </div>
      <button type="button" class="btn btn-secondary btn-sm mb-4" id="add-edu"><i class="fas fa-plus"></i> Tambah Pendidikan</button>

      <h5>Sertifikasi</h5>
      <div id="cert-rows">
        <?php foreach ($cv['certifications'] as $c): ?>
        <div class="row cert-row border rounded p-2 mb-2 mx-0">
          <div class="col-md-5"><input type="text" name="cert_title[]" class="form-control" placeholder="Judul" value="<?= e($c['title']) ?>"></div>
          <div class="col-md-6"><input type="text" name="cert_issuer[]" class="form-control" placeholder="Penerbit / Tahun" value="<?= e($c['issuer']) ?>"></div>
          <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i></button></div>
        </div>
        <?php endforeach; ?>
      </div>
      <button type="button" class="btn btn-secondary btn-sm" id="add-cert"><i class="fas fa-plus"></i> Tambah Sertifikasi</button>

    <?php elseif ($tab === 'projects'): ?>
      <div id="project-rows">
        <?php foreach ($cv['projects'] as $pr): ?>
        <div class="border rounded p-3 mb-3 project-row">
          <div class="row">
            <div class="col-md-6"><label>Judul Proyek</label><input type="text" name="title[]" class="form-control" value="<?= e($pr['title']) ?>"></div>
            <div class="col-md-3"><label>Kategori</label><input type="text" name="category[]" class="form-control" value="<?= e($pr['category']) ?>"></div>
            <div class="col-md-3">
              <label>Badge</label>
              <select name="badge_color[]" class="form-control">
                <?php foreach (['badge-primary','badge-success','badge-warning','badge-info','badge-danger'] as $b): ?>
                <option value="<?= $b ?>" <?= $pr['badge_color'] === $b ? 'selected' : '' ?>><?= $b ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-12 mt-2"><label>Deskripsi</label><textarea name="project_description[]" class="form-control" rows="2"><?= e($pr['description']) ?></textarea></div>
            <div class="col-md-6 mt-2"><label>URL Repo</label><input type="text" name="repo_url[]" class="form-control" value="<?= e($pr['repo_url']) ?>"></div>
            <div class="col-md-6 mt-2"><label>URL Demo</label><input type="text" name="demo_url[]" class="form-control" value="<?= e($pr['demo_url']) ?>"></div>
            <div class="col-12 mt-2"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i> Hapus</button></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <button type="button" class="btn btn-secondary btn-sm" id="add-project"><i class="fas fa-plus"></i> Tambah Proyek</button>
    <?php endif; ?>

  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan ke Database</button>
    <a href="../index.php" class="btn btn-outline-secondary" target="_blank">Pratinjau CV</a>
  </div>
</form>

<?php require __DIR__ . '/includes/footer.php'; ?>
