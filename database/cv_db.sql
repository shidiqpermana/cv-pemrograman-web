-- Database CV Editable
-- Import via phpMyAdmin atau: mysql -u root < cv_db.sql

CREATE DATABASE IF NOT EXISTS cv_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cv_db;

-- Admin login dibuat otomatis oleh install.php (username: admin, password: admin123)
CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Profil utama
CREATE TABLE IF NOT EXISTS profile (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(150) NOT NULL,
  job_title VARCHAR(150) NOT NULL DEFAULT '',
  headline TEXT,
  about_lead TEXT,
  about_body TEXT,
  email VARCHAR(150) DEFAULT '',
  phone VARCHAR(50) DEFAULT '',
  location VARCHAR(150) DEFAULT '',
  linkedin VARCHAR(255) DEFAULT '',
  github VARCHAR(255) DEFAULT '',
  whatsapp VARCHAR(50) DEFAULT '',
  photo_url VARCHAR(500) DEFAULT '',
  status_badge VARCHAR(100) DEFAULT 'Tersedia untuk kerja',
  contact_title VARCHAR(150) DEFAULT 'Mari Berkolaborasi',
  contact_text TEXT,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Statistik
CREATE TABLE IF NOT EXISTS stats (
  id INT AUTO_INCREMENT PRIMARY KEY,
  label VARCHAR(100) NOT NULL,
  value VARCHAR(50) NOT NULL,
  icon VARCHAR(50) DEFAULT 'fas fa-star',
  color VARCHAR(30) DEFAULT 'bg-info',
  sort_order INT DEFAULT 0
);

-- Keahlian teknis (progress bar)
CREATE TABLE IF NOT EXISTS skills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  percent INT NOT NULL DEFAULT 50,
  color VARCHAR(30) DEFAULT 'bg-info',
  sort_order INT DEFAULT 0
);

-- Tools
CREATE TABLE IF NOT EXISTS tools (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  sort_order INT DEFAULT 0
);

-- Soft skills
CREATE TABLE IF NOT EXISTS soft_skills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  sort_order INT DEFAULT 0
);

-- Pengalaman
CREATE TABLE IF NOT EXISTS experiences (
  id INT AUTO_INCREMENT PRIMARY KEY,
  period VARCHAR(100) NOT NULL,
  title VARCHAR(200) NOT NULL,
  description TEXT,
  icon VARCHAR(50) DEFAULT 'fas fa-briefcase',
  color VARCHAR(30) DEFAULT 'bg-success',
  sort_order INT DEFAULT 0
);

-- Pendidikan
CREATE TABLE IF NOT EXISTS education (
  id INT AUTO_INCREMENT PRIMARY KEY,
  degree VARCHAR(200) NOT NULL,
  institution VARCHAR(200) NOT NULL,
  detail TEXT,
  description TEXT,
  sort_order INT DEFAULT 0
);

-- Sertifikasi
CREATE TABLE IF NOT EXISTS certifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  issuer VARCHAR(200) NOT NULL,
  sort_order INT DEFAULT 0
);

-- Proyek
CREATE TABLE IF NOT EXISTS projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  category VARCHAR(100) DEFAULT '',
  badge_color VARCHAR(30) DEFAULT 'badge-primary',
  description TEXT,
  repo_url VARCHAR(500) DEFAULT '#',
  demo_url VARCHAR(500) DEFAULT '#',
  sort_order INT DEFAULT 0
);

-- ===================== SEED DATA =====================

INSERT INTO profile (
  full_name, job_title, headline, about_lead, about_body,
  email, phone, location, linkedin, github, whatsapp, photo_url,
  status_badge, contact_title, contact_text
) VALUES (
  'Mohammad Shidiq Permana',
  'Web Developer & Designer',
  'Membangun pengalaman web yang elegan, responsif, dan berorientasi pengguna.',
  'Saya adalah mahasiswa / profesional di bidang Pemrograman Web dengan minat pada front-end modern, UI/UX, dan pengembangan aplikasi berbasis web.',
  'Berpengalaman membuat landing page, dashboard admin, dan integrasi API. Senang belajar teknologi baru dan bekerja dalam tim yang kolaboratif. Target saya: menghadirkan solusi digital yang rapi, cepat, dan mudah dipelihara.',
  'shidiqper@email.com',
  '0881023452481',
  'Bandung, Indonesia',
  'linkedin.com/in/-',
  'github.com/shidiqpermana',
  '62881023452481',
  '',
  'Tersedia untuk kerja',
  'Mari Berkolaborasi',
  'Tertarik magang, freelance, atau diskusi proyek? Hubungi saya melalui kanal di bawah.'
);

INSERT INTO stats (label, value, icon, color, sort_order) VALUES
('Tahun Pengalaman', '2+', 'fas fa-clock', 'bg-info', 1),
('Proyek Selesai', '15+', 'fas fa-check-circle', 'bg-success', 2),
('Teknologi Dikuasai', '8+', 'fas fa-layer-group', 'bg-warning', 3),
('Komitmen & Etika Kerja', '100%', 'fas fa-heart', 'bg-danger', 4);

INSERT INTO skills (name, percent, color, sort_order) VALUES
('HTML, CSS, JavaScript', 90, 'bg-info', 1),
('Bootstrap / AdminLTE', 85, 'bg-primary', 2),
('PHP & MySQL', 80, 'bg-success', 3),
('Git & Version Control', 75, 'bg-warning', 4);

INSERT INTO tools (name, sort_order) VALUES
('VS Code', 1), ('Figma', 2), ('Postman', 3), ('XAMPP', 4), ('Chrome DevTools', 5);

INSERT INTO soft_skills (name, sort_order) VALUES
('Komunikasi & presentasi', 1),
('Manajemen waktu', 2),
('Problem solving', 3),
('Kerja tim & adaptif', 4);

INSERT INTO experiences (period, title, description, icon, color, sort_order) VALUES
('Jan 2025 — Sekarang', 'Web Developer Intern — PT Contoh Teknologi',
 'Mengembangkan dashboard internal dengan AdminLTE, membuat modul CRUD, dan mengoptimalkan performa halaman. Berkolaborasi dengan tim backend untuk integrasi REST API.',
 'fas fa-building', 'bg-success', 1),
('Jun — Des 2024', 'Freelance — Pembuatan Website UMKM',
 'Mendesain dan membangun 5+ website company profile responsif. Melayani klien dari brief hingga deployment di hosting shared.',
 'fas fa-laptop', 'bg-info', 2),
('2023 — 2024', 'Asisten Lab — Pemrograman Web',
 'Membantu praktikum HTML/CSS/JS, menyiapkan materi, dan mendampingi mahasiswa dalam tugas proyek akhir semester.',
 'fas fa-users', 'bg-warning', 3);

INSERT INTO education (degree, institution, detail, description, sort_order) VALUES
('S1 Teknik Informatika', 'Universitas Bale Bandung — 2022 — 2026 (perkiraan)',
 'IPK: 3.51 / 4.00',
 'Mata kuliah relevan: Pemrograman Web, Basis Data, Algoritma, Desain UI/UX, Jaringan Komputer, Machine Learning.', 1),
('SMA / SMK', 'SMA Negeri 22 Bandung — 2019 — 2022',
 '', 'Jurusan IPA.', 2);

INSERT INTO certifications (title, issuer, sort_order) VALUES
('Web Development Fundamentals', 'Dicoding — 2024', 1),
('Responsive Web Design', 'freeCodeCamp — 2023', 2),
('Git & GitHub untuk Pemula', 'Platform Online — 2023', 3);

INSERT INTO projects (title, category, badge_color, description, repo_url, demo_url, sort_order) VALUES
('Sistem Inventori AdminLTE', 'Dashboard', 'badge-primary',
 'Dashboard manajemen stok dengan chart, tabel data, dan autentikasi sederhana.', '#', '#', 1),
('Company Profile UMKM', 'Landing Page', 'badge-success',
 'Website promosi produk lokal, SEO-friendly, mobile-first.', '#', '#', 2),
('Aplikasi Cuaca Real-time', 'API + Front-end', 'badge-warning',
 'Integrasi OpenWeather API dengan tampilan kartu dinamis.', '#', '#', 3);
