# LaporLoka: Platform Lapor Warga 📣

LaporLoka adalah platform web **lapor warga** 🌐 yang dirancang khusus untuk memfasilitasi komunikasi antara warga dan pemerintah desa. Dengan platform ini, warga dapat dengan mudah menyampaikan laporan terkait berbagai masalah, seperti jalan rusak 🛣️, fasilitas umum yang kotor 🗑️, atau kegiatan yang membutuhkan perhatian, sehingga penanganan dapat dilakukan secara lebih cepat dan terstruktur.

-----

### Fitur Utama 🔑

  * **Formulir Laporan yang Sederhana:** Warga dapat mengirim laporan dengan mengisi formulir yang intuitif dan mudah digunakan. 📝
  * **Kategori dan Prioritas:** Laporan dapat dikategorikan dan diberi tingkat prioritas (Rendah, Sedang, Tinggi, Darurat) untuk membantu pemerintah desa dalam menentukan skala urgensi. 🚦
  * **Pemantauan Laporan:** Warga dapat memantau status laporan mereka (Terkirim, Diproses, Selesai, Ditolak). 📈
  * **Dasbor Administrasi:** Pemerintah desa memiliki dasbor khusus untuk mengelola, memperbarui status, dan menanggapi setiap laporan yang masuk. 👩‍💻
  * **Filter dan Pencarian:** Fitur pencarian dan filter memudahkan administrasi dalam menemukan laporan berdasarkan status, prioritas, atau kategori. 🔎

-----

### Cara Memasang 🛠️

Ikuti langkah-langkah berikut untuk memasang LaporLoka di server Anda:

#### 1\. Persiapan Server 🖥️

Pastikan server Anda memenuhi persyaratan minimum, seperti:

  * PHP versi 8.3 atau lebih tinggi
  * Database 🗄️

#### 2\. Kloning Repositori 📂

Buka terminal atau command prompt, lalu jalankan perintah berikut untuk mengunduh kode proyek:

```bash
git clone https://github.com/barizaloka-universe/laporloka
```

#### 3\. Konfigurasi Lingkungan ⚙️

  * Masuk ke direktori proyek:
    ```bash
    cd laporloka
    ```
  * Salin berkas `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
  * Edit berkas `.env` dan sesuaikan pengaturan **database** (nama basis data, pengguna, dan kata sandi).

#### 4\. Instalasi Dependensi 📦

Jalankan perintah berikut untuk menginstal semua dependensi yang diperlukan:

```bash
composer install
npm install
npm run dev
```

#### 5\. Migrasi Basis Data dan Seeding 🌱

Jalankan perintah migrasi untuk membuat tabel-tabel di basis data Anda, lalu `seeding` untuk mengisi data awal:

```bash
php artisan migrate --seed
```

#### 6\. Jalankan Aplikasi ▶️

Setelah semua langkah selesai, jalankan server lokal Anda:

```bash
php artisan serve
```

Aplikasi kini dapat diakses di `http://127.0.0.1:8000`. 🎉

-----

### Dukungan ❓

Jika Anda mengalami kendala saat instalasi atau penggunaan, silakan buat `issue` baru di repositori ini. 🤝

-----

### Lisensi ⚖️

Proyek ini berada di bawah lisensi MIT. Lihat berkas `LICENSE.md` untuk detail lebih lanjut.

-----

### Kontributor 🙏

Terima kasih kepada semua kontributor yang telah membantu mengembangkan LaporLoka.
