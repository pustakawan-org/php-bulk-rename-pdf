<p align="center">
  <a href="#-bahasa-indonesia">🇮🇩 Bahasa Indonesia</a> • 
  <a href="#-english">🇬🇧 English</a>
</p>

---

## 🇮🇩 Bahasa Indonesia

# PHP Bulk File Renamer (Sertifikat & Universal)

Script PHP murni (native) dengan antarmuka web yang rapi (Tailwind CSS) untuk mengubah nama file secara massal di server lokal (localhost). Alat ini sangat berguna untuk menyesuaikan nama file dokumen atau sertifikat hasil *generate* otomatis secara cepat menggunakan teknik *copy-paste* langsung dari Excel atau Google Sheets.

### 📂 Struktur File (Pilih yang mana?)
Repository ini menyediakan 4 versi file tergantung pada kebutuhan dan preferensi bahasa Anda. Anda hanya perlu menjalankan **salah satu** dari file berikut di browser Anda:

| Nama File | Deskripsi | Cocok Untuk |
| :--- | :--- | :--- |
| `index.php` | **Khusus PDF** (Bahasa Indonesia). | Mengubah nama file sertifikat PDF. Lebih kaku dan aman agar tidak salah merename file lain. |
| `index-en.php` | **Khusus PDF** (English). | Sama dengan atas, namun antarmuka berbahasa Inggris. |
| `index-universal.php` | **Universal** (Bahasa Indonesia). | Mendukung **semua jenis file** (PDF, JPG, PNG, DOCX, dll). Dilengkapi menu *dropdown* untuk memfilter jenis ekstensi file. |
| `index-universal-en.php`| **Universal** (English). | Sama dengan versi universal, namun antarmuka berbahasa Inggris. |

### ✨ Fitur Utama
- **Bulk Paste (Ctrl+V)**: Mendukung *paste* daftar nama menurun langsung dari kolom Excel atau Google Sheets.
- **Natural Sorting**: Mendeteksi urutan angka pada file persis seperti algoritma Windows Explorer (1, 2, 3... 10, 11), sehingga urutan *rename* tidak akan meleset.
- **Safe Rename**: Menangkap error dan memberi notifikasi jika ada file yang gagal diubah karena sedang terbuka/dikunci oleh aplikasi lain (Adobe Reader, Browser, dll).
- **Otomatisasi Ekstensi**: Pengguna tidak perlu mengetik ekstensi (seperti `.pdf` atau `.jpg`) pada nama baru, sistem akan mempertahankan format asli file secara otomatis.

### 🚀 Persyaratan Sistem
- Web Server lokal seperti **XAMPP**, Laragon, atau WAMP.
- PHP versi 7.0 ke atas.
- Browser modern (Chrome, Firefox, Edge, Safari).

### 🛠️ Cara Instalasi & Menjalankan
1. Pastikan aplikasi XAMPP Anda sudah berjalan (Start pada modul **Apache**).
2. Buat folder baru di dalam direktori root server lokal Anda, misalnya di `C:\xampp\htdocs\renamer`.
3. Letakkan keempat file PHP dari repositori ini ke dalam folder tersebut.
4. Buka browser dan akses alamat file yang Anda butuhkan (contoh: `http://localhost/renamer/index-universal.php`).

### 📖 Petunjuk Penggunaan
1. Buka Windows Explorer, cari folder fisik tempat file yang ingin diubah berada, lalu **Copy path** (salin alamat folder) tersebut.
2. **Paste** path tersebut ke form aplikasi (jika Anda menggunakan versi Universal, pilih jenis file yang ingin ditampilkan).
3. Klik tombol **Deteksi**.
4. Siapkan daftar nama baru Anda (dari Excel, Google Sheets, atau Notepad).
5. Blok dan **Copy (Ctrl+C)** seluruh daftar nama tersebut.
6. Klik pada kolom **Nama File Baru** di baris paling atas pada tabel, lalu tekan **Paste (Ctrl+V)**.
7. Pastikan file yang akan diubah **tidak sedang dibuka** di aplikasi lain.
8. Klik tombol hijau **Ubah Sekarang** untuk memproses.

---

## 🇬🇧 English

# PHP Bulk File Renamer (Certificate & Universal)

A pure (native) PHP script with a clean web interface (Tailwind CSS) to rename files in bulk on a local server (localhost). This tool is highly useful for quickly matching automatically generated document or certificate filenames by copy-pasting data directly from Excel or Google Sheets.

### 📂 File Structure (Which one to choose?)
This repository provides 4 file versions depending on your needs and language preferences. You only need to run **one** of the following files in your browser:

| File Name | Description | Best For |
| :--- | :--- | :--- |
| `index.php` | **PDF Only** (Indonesian). | Renaming PDF certificates. Stricter and safer to prevent accidental renaming of other files. |
| `index-en.php` | **PDF Only** (English). | Same as above, but with an English interface. |
| `index-universal.php` | **Universal** (Indonesian). | Supports **all file types** (PDF, JPG, PNG, DOCX, etc.). Includes a dropdown menu to filter file extensions. |
| `index-universal-en.php`| **Universal** (English). | Same as the universal version, but with an English interface. |

### ✨ Key Features
- **Bulk Paste (Ctrl+V)**: Supports pasting a list of names vertically directly from Excel or Google Sheets columns.
- **Natural Sorting**: Detects the numerical order of files exactly like the Windows Explorer algorithm (1, 2, 3... 10, 11), preventing out-of-order file matching.
- **Safe Rename**: Captures errors and provides notifications if any files fail to change because they are currently open/locked by another application.
- **Extension Automation**: Users do not need to type the extension (like `.pdf` or `.jpg`) for the new name; the system will automatically retain the original format of each file.

### 🚀 System Requirements
- Local Web Server such as **XAMPP**, Laragon, or WAMP.
- PHP version 7.0 or higher.
- Modern web browser (Chrome, Firefox, Edge, Safari).

### 🛠️ Installation & Setup
1. Ensure your XAMPP application is running (Start the **Apache** module).
2. Create a new folder inside your local server's root directory, for example: `C:\xampp\htdocs\renamer`.
3. Place the four PHP files from this repository into that folder.
4. Open your browser and access the specific file you need (e.g., `http://localhost/renamer/index-universal-en.php`).

### 📖 Instructions for Use
1. Open Windows Explorer, find the folder where your files are located, then **Copy the path** of that folder.
2. **Paste** the path into the application form (if using the Universal version, select the file type you want to display).
3. Click the **Detect** button.
4. Prepare your list of new names (from Excel, Google Sheets, or Notepad).
5. Select and **Copy (Ctrl+C)** the entire list of names.
6. Click on the **New File Name** field in the top row of the table, then press **Paste (Ctrl+V)**.
7. Ensure the files to be renamed are **not open** in other applications.
8. Click the green **Rename Now** button to process.

---

## 📝 License

Aplikasi ini bersifat *open-source* dan bebas digunakan atau dimodifikasi untuk keperluan apa pun.  
This application is open-source and free to use or modify for any purpose.
