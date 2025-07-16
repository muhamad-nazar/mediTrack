🧰 Teknologi yang Digunakan
Tool / Framework	Versi / Keterangan
Laravel	12.x
PHP	8.2+
Composer	2.x
MySQL	5.7 / 8.0 (via XAMPP/Laragon)
XAMPP/Laragon	8.2+/6.0+
Bootstrap	5
FontAwesome	5
Chart.js	v4 (untuk grafik di dashboard)
SweetAlert2	(untuk notifikasi interaktif)
Blade	Laravel Blade Templating
Git	(untuk version control)

✅ Cara Install Project 
🔁 1. Clone repository atau Unduh Code
Jika Clone Ketik ini di Terminal : 
git clone https://github.com/muhamad-nazar/mediTrack.git

lalu buka Project di VSCode

📦 2. Install dependency Laravel
untuk menginstall ketik perintah
composer install
di terminal

⚙️ 3. Copy file .env dan generate key
karena .env.example nya sudah saya ubah sesuai dengan yang saya pakai, maka langsung copy saja dengan mengetikan perintah di terminal
cp .env.example .env atau copy .env.example .env jika di windows
setelah itu ketik perintah di terminal
php artisan key:generate

Jika sudah maka lihat .env nya apa sudah terisi bagian DB nya
DB_DATABASE=meditrack
DB_USERNAME=root
DB_PASSWORD=

jika belum bisa diisi sesuai .sql yang sudah saya Upload di Folder dengan nama meditrack.sql
<img width="897" height="792" alt="image" src="https://github.com/user-attachments/assets/8baeda10-e03f-48f9-88a8-5065e44d76f5" />


untuk Database bisa  import dari yang saya kasih atau migrate/buat baru dengan perintah
php artisan migrate
di terminal

Jika Sudah, Maka tinggal jalankan Project nya Menggunakan Perintah
php artisan serve di terminal

Jika Mengimport Database dari sql yang saya Upload untuk Login nya: 
Email: admin@mediTrack.com
Pass : admin321

Untuk Halaman Login: 
<img width="1920" height="916" alt="image" src="https://github.com/user-attachments/assets/bf2e0c08-29de-43d8-a38e-73384d8d3337" />

Halaman Dashboard : 
<img width="1918" height="900" alt="image" src="https://github.com/user-attachments/assets/8ac58d30-de59-4116-89de-8c8f21507cde" />

Halaman Data Pasien : 
<img width="1918" height="911" alt="image" src="https://github.com/user-attachments/assets/b676bcdd-7003-424f-b010-b4bc1bce2f0c" />

Halaman Daftar Kunjungan : 
<img width="1916" height="905" alt="image" src="https://github.com/user-attachments/assets/a0434fac-8cf7-40c9-97b6-0da052cb462a" />

Halaman Detail Kunjungan : 
<img width="1917" height="911" alt="image" src="https://github.com/user-attachments/assets/058d7def-f7a6-4a9e-807c-3ae18f820d6a" />

Halaman Riwayat Kunjungan : 
<img width="1920" height="907" alt="image" src="https://github.com/user-attachments/assets/3df7735a-801f-485b-9382-55bffc4ce9e7" />

Halaman Detail Riwayat Kunjungan : 
<img width="1920" height="917" alt="image" src="https://github.com/user-attachments/assets/8fac30af-2b01-43b3-981d-b44af64314b8" />

Halaman Update User : 
<img width="1920" height="899" alt="image" src="https://github.com/user-attachments/assets/8c4bc7f1-6245-4a7d-93a8-9a13c04cfa68" />



🗂 Struktur Folder Project
app/
├── Http/
│   ├── Controllers/
│   │   ├── PagesController.php       # Handle halaman dashboard, pasien, kunjungan, riwayat
│   │   ├── AddController.php         # Menangani tambah data
│   │   ├── UpdateController.php      # Menangani update data
│   │   ├── DeleteController.php      # Menangani hapus data
│   │   └── AuthController.php        # Menangani login/logout
│   └── Middleware/
│       └── Authenticate.php          # Proteksi login
│
├── Models/
│   ├── Patient.php                   # Model untuk data pasien
│   ├── Visit.php                     # Model untuk data kunjungan
│   └── User.php                      # Model default user Laravel

resources/
├── views/
│   ├── pages/
│   │   ├── admin/
│   │   │   ├── pasien.blade.php      # Halaman data pasien
│   │   │   ├── kunjungan.blade.php   # Halaman daftar kunjungan
│   │   │   ├── riwayat.blade.php     # Halaman riwayat kunjungan
│   │   │   │    ├── data/
│   │   │   │    |    |    └── kunjungan.blade.php      # Detail kunjungan
│   │   │   │    |    |    └── riwayat.blade.php      # Detail riwayat
│   │   ├── auth/
│   │   │   └── login.blade.php       # Halaman login
│   │   │   └── profile.blade.php       # Halaman Profile user
│   │   └── index.blade.php           # Dashboard utama
│   └── partials/
│       └── template.blade.php        # Template layout utama (header, sidebar, dsb)

routes/
├── web.php                           # Semua route aplikasi (web)

public/
├── assets/                           # Berisi icon, gambar, atau asset statis
│   └── img/
│       ├── undraw_profile.svg
│       └── undraw_profile_1.svg
├── index.php                         # Entry point aplikasi

.env                                   # Konfigurasi database & environment
