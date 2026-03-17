
# 📸 Website Galeri Foto - Laravel 11

[![Laravel Version](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

Platform galeri foto berbasis web yang dirancang untuk manajemen aset visual secara terstruktur. Memungkinkan **Admin** untuk mengelola album produk/foto secara penuh, serta memberikan ruang bagi **User** untuk berinteraksi melalui sistem sosial.

---

## 🎯 Fitur Utama

### 🔐 Autentikasi & Manajemen User
- **Secure System**: Registrasi dan login dengan enkripsi password.
- **Session Management**: Logout aman dengan proteksi session.
- **Profile Data**: Penyimpanan informasi kredensial seperti Nama, Email, dan Password.

### 📂 Manajemen Album & Foto (Khusus Admin)
- **Full CRUD Album**: Membuat kategori album dengan nama dan deskripsi khusus.
- **Smart Upload**: Mendukung format JPG, PNG, GIF dengan limitasi 2MB.
- **Content Control**: Kemampuan mengedit informasi judul/deskripsi serta menghapus file fisik dari storage.

### 💬 Interaksi Sosial (User & Admin)
- **Engagement**: Fitur Like dan Unlike untuk setiap foto.
- **Sistem Komentar**: Ruang diskusi bagi user pada setiap postingan.
- **Real-time Stats**: Penghitung otomatis jumlah like dan komentar.

---

## 🗄️ Database Schema

```mermaid
graph TD
    users -->|1:N| albums
    users -->|1:N| fotos
    albums -->|1:N| fotos
    fotos -->|1:N| komentar_fotos
    fotos -->|1:N| like_fotos
    users -->|1:N| komentar_fotos
    users -->|1:N| like_fotos
````

**Detail Tabel Utama:**

  - `users`: id, username, email, name, password.
  - `albums`: AlbumID, NamaAlbum, Deskripsi, UserID, TanggalDibuat.
  - `fotos`: FotoID, JudulFoto, DeskripsiFoto, LokasiFile, AlbumID, UserID, TanggalUnggah.
  - `komentar_fotos`: KomentarID, FotoID, UserID, parent\_id, IsiKomentar, TanggalKomentar.
  - `like_fotos`: LikeID, FotoID, UserID, TanggalLike.

-----

## 🚀 Quick Start (Instalasi)

1.  **Clone Repository**

    ```bash
    git clone [https://github.com/sucikarmila/galeri.git](https://github.com/sucikarmila/galeri.git)
    cd galeri
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Setup Environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Konfigurasi Database**
    Edit `.env` dan sesuaikan:

    ```env
    DB_DATABASE=galeri
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Migrasi & Storage Link**

    ```bash
    php artisan migrate
    php artisan storage:link
    ```

6.  **Jalankan Aplikasi**

    ```bash
    php artisan serve
    ```

-----

## 🛠️ Troubleshooting & Debugging

Jika menemui kendala saat instalasi, cek langkah berikut:

  - **Error Gambar Tidak Muncul**: Pastikan link storage sudah dibuat dengan `php artisan storage:link`.
  - **Error Vite / CSS**: Pastikan sudah menjalankan `npm run build` jika di server, atau `npm run dev` saat pengembangan.
  - **Permission Error**: Jalankan perintah berikut jika folder storage terkunci:
    ```bash
    chmod -R 775 storage bootstrap/cache
    ```
  - **Reset Database**: Untuk mengulang data dari awal:
    ```bash
    php artisan migrate:fresh
    ```

-----

## 🎓 Spesifikasi Hak Akses

| Fitur | Admin | User  |
| :--- | :---: | :---: |
| Registrasi & Login | ✓ | ✓ |
| Tambah Album & Foto | ✓ | - |
| Edit / Hapus Konten | ✓ | - |
| Like & Komentar | ✓ | ✓ |

-----

**_DOCUMENTATION_**

fitur-fitur 

A.LOGIN

<img width="624" height="782" alt="image" src="https://github.com/user-attachments/assets/88c80b99-8630-43d1-9fd9-7962a737f89e" />

B.REGISTER

<img width="644" height="885" alt="image" src="https://github.com/user-attachments/assets/3b261179-9afa-4bff-8eda-b6573365a100" />

C.DASHBOARD

<img width="1703" height="886" alt="image" src="https://github.com/user-attachments/assets/d6a30424-241a-47c7-be8c-9ba7aee7fbdb" />

D.GALERY

a. ADD YOUR Gallery

<img width="779" height="762" alt="image" src="https://github.com/user-attachments/assets/9364ae44-a6cd-4862-8073-a60ef39beab2" />

b.Update Your Gallery

<img width="825" height="786" alt="image" src="https://github.com/user-attachments/assets/821de028-2834-410d-8361-9a446291369d" />

c.READ

<img width="1272" height="644" alt="image" src="https://github.com/user-attachments/assets/730a5b4f-4161-4d5a-8b7c-8165f69e13f8" />


d. VIEW

<img width="1304" height="785" alt="image" src="https://github.com/user-attachments/assets/03589d24-8a2a-466e-9b82-a72f2e27f067" />

E.ALBUM

a.ADD ALBUM

<img width="831" height="581" alt="image" src="https://github.com/user-attachments/assets/ca19aee6-5dc4-4556-88f6-ee28cd769702" />


b.UPDATE YOUR ALBUM
<img width="761" height="537" alt="image" src="https://github.com/user-attachments/assets/914ed8a9-2e9f-4fb3-a94f-9a6c21792b34" />


c.READ
<img width="1210" height="587" alt="image" src="https://github.com/user-attachments/assets/26fcb4a7-74f0-4738-86ed-b08895381a18" />


