<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
 
</head>
<body>

<h1>🧰 Teknologi yang Digunakan</h1>

<table>
  <thead>
    <tr><th>Tool / Framework</th><th>Versi / Keterangan</th></tr>
  </thead>
  <tbody>
    <tr><td>Laravel</td><td>12.x</td></tr>
    <tr><td>PHP</td><td>8.2+</td></tr>
    <tr><td>Composer</td><td>2.x</td></tr>
    <tr><td>MySQL</td><td>5.7 / 8.0 (via XAMPP/Laragon)</td></tr>
    <tr><td>XAMPP/Laragon</td><td>8.2+ / 6.0+</td></tr>
    <tr><td>Bootstrap</td><td>5</td></tr>
    <tr><td>FontAwesome</td><td>5</td></tr>
    <tr><td>Chart.js</td><td>v4 (grafik di dashboard)</td></tr>
    <tr><td>SweetAlert2</td><td>Notifikasi interaktif</td></tr>
    <tr><td>Blade</td><td>Laravel Blade Templating</td></tr>
    <tr><td>Git</td><td>Version control</td></tr>
  </tbody>
</table>

<h2>✅ Cara Install Project</h2>

<h3>🔁 1. Clone repository atau Unduh Code</h3>
<pre><code>git clone https://github.com/muhamad-nazar/mediTrack.git
cd mediTrack</code></pre>

<h3>📦 2. Install dependency Laravel</h3>
<pre><code>composer install</code></pre>

<h3>⚙️ 3. Salin file .env & generate key</h3>
<pre><code>cp .env.example .env
# atau di Windows
copy .env.example .env

php artisan key:generate</code></pre>

<h3>🛠️ 4. Atur Database</h3>
<pre><code>DB_DATABASE=meditrack
DB_USERNAME=root
DB_PASSWORD=</code></pre>

<p>
Jika belum, kamu bisa:
<ul>
  <li>Import database <code>meditrack.sql</code> yang saya sertakan</li>
  <li>Atau jalankan <code>php artisan migrate</code></li>
</ul>
</p>

<h3>🚀 5. Jalankan project</h3>
<pre><code>php artisan serve</code></pre>

<p>Buka di browser: <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a></p>

<h3>🔐 Akun Demo (Jika Import SQL)</h3>
<ul>
  <li>Email: <code>admin@mediTrack.com</code></li>
  <li>Password: <code>admin321</code></li>
</ul>

<hr>

<h2>🖼️ Tampilan Halaman</h2>

<h4>Login</h4>
<img src="https://github.com/user-attachments/assets/bf2e0c08-29de-43d8-a38e-73384d8d3337" alt="Login">

<h4>Dashboard</h4>
<img src="https://github.com/user-attachments/assets/8ac58d30-de59-4116-89de-8c8f21507cde" alt="Dashboard">

<h4>Data Pasien</h4>
<img src="https://github.com/user-attachments/assets/b676bcdd-7003-424f-b010-b4bc1bce2f0c" alt="Pasien">

<h4>Daftar Kunjungan</h4>
<img src="https://github.com/user-attachments/assets/a0434fac-8cf7-40c9-97b6-0da052cb462a" alt="Kunjungan">

<h4>Detail Kunjungan</h4>
<img src="https://github.com/user-attachments/assets/058d7def-f7a6-4a9e-807c-3ae18f820d6a" alt="Detail Kunjungan">

<h4>Riwayat Kunjungan</h4>
<img src="https://github.com/user-attachments/assets/3df7735a-801f-485b-9382-55bffc4ce9e7" alt="Riwayat">

<h4>Detail Riwayat Kunjungan</h4>
<img src="https://github.com/user-attachments/assets/8fac30af-2b01-43b3-981d-b44af64314b8" alt="Detail Riwayat">

<h4>Profile User</h4>
<img src="https://github.com/user-attachments/assets/8c4bc7f1-6245-4a7d-93a8-9a13c04cfa68" alt="Profile">

<hr>

<h2>🗂 Struktur Folder Project</h2>

<pre><code>app/
├── Http/
│   ├── Controllers/
│   │   ├── PagesController.php       # Halaman dashboard, pasien, kunjungan, riwayat
│   │   ├── AddController.php         # Tambah data
│   │   ├── UpdateController.php      # Update data
│   │   ├── DeleteController.php      # Hapus data
│   │   └── AuthController.php        # Login/logout
│   └── Middleware/
│       └── Authenticate.php          # Proteksi login

├── Models/
│   ├── Patient.php                   # Model pasien
│   ├── Visit.php                     # Model kunjungan
│   └── User.php                      # Model user

resources/
├── views/
│   ├── pages/
│   │   ├── admin/
│   │   │   ├── pasien.blade.php
│   │   │   ├── kunjungan.blade.php
│   │   │   ├── riwayat.blade.php
│   │   │   └── data/
│   │   │       ├── kunjungan.blade.php
│   │   │       └── riwayat.blade.php
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── profile.blade.php
│   │   └── index.blade.php
│   └── partials/
│       └── template.blade.php        # Layout utama

routes/
└── web.php                           # Semua route aplikasi

public/
└── assets/
    └── img/
        ├── undraw_profile.svg
        └── undraw_profile_1.svg

.env                                   # Konfigurasi environment
</code></pre>

</body>
</html>
