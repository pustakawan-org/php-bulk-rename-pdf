<p align="center">
  <a href="#-bahasa-indonesia">Bahasa Indonesia</a> • 
  <a href="#-english">English</a>
</p>

---

## 🇮🇩 Bahasa Indonesia

# PHP Bulk Rename PDF (Sertifikat Renamer)

Script PHP murni (native) dengan antarmuka web sederhana untuk mengubah nama file PDF secara massal di server lokal (localhost). Alat ini sangat berguna untuk menyesuaikan nama file dokumen atau sertifikat hasil *generate* otomatis (misalnya dari "Sertifikat-1.pdf" ke nama asli peserta) secara cepat menggunakan data dari Excel atau Google Sheets.

### ✨ Fitur Utama
- **Bulk Paste (Ctrl+V)**: Mendukung *paste* daftar nama menurun langsung dari kolom Excel atau Google Sheets.
- **Natural Sorting**: Mendeteksi urutan angka pada file persis seperti algoritma Windows Explorer (1, 2, 3... 10, 11), sehingga urutan file tidak akan meleset (lexicographical error).
- **Safe Rename**: Menangkap error dan memberi notifikasi jika ada file PDF yang gagal diubah karena sedang terbuka/dikunci oleh aplikasi lain (Adobe Reader, Browser, dll).
- **Otomatisasi Ekstensi**: Pengguna tidak perlu mengetik `.pdf` pada nama baru, sistem akan memprosesnya secara otomatis.

### 🚀 Persyaratan Sistem
- Web Server lokal seperti **XAMPP**, Laragon, atau WAMP.
- PHP versi 7.0 ke atas.
- Browser modern (Chrome, Firefox, Edge, Safari).

### 🛠️ Cara Instalasi & Menjalankan
1. Pastikan aplikasi XAMPP Anda sudah berjalan (Start pada modul **Apache**).
2. Buat folder baru di dalam direktori root server lokal Anda, misalnya di `C:\xampp\htdocs\rename-pdf`.
3. Letakkan file `index.php` (atau `index-en.php`) dari repositori ini ke dalam folder tersebut.
4. Buka browser dan akses alamat: `http://localhost/rename-pdf`.

### 📖 Petunjuk Penggunaan
1. Buka Windows Explorer, cari folder fisik tempat file PDF Anda berada, lalu **Copy path** (salin alamat folder) tersebut.
2. **Paste** path tersebut ke kolom **Path Folder Sumber** di aplikasi localhost ini, lalu klik tombol **Deteksi**.
3. Siapkan daftar nama baru Anda (misalnya dari Excel, Google Sheets, atau Notepad).
4. Blok dan **Copy (Ctrl+C)** seluruh daftar nama tersebut.
5. Klik pada kolom **Nama File Baru** di baris paling atas pada tabel.
6. Tekan **Paste (Ctrl+V)**. Sistem otomatis mendistribusikan nama ke baris bawahnya secara berurutan.
7. Pastikan file PDF yang akan diubah **tidak sedang dibuka** di aplikasi lain.
8. Klik tombol hijau **Ubah Sekarang** untuk memproses.

---

## 🇬🇧 English

# PHP Bulk Rename PDF (Certificate Renamer)

A pure (native) PHP script with a simple web interface to rename PDF files in bulk on a local server (localhost). This tool is highly useful for quickly matching automatically generated document or certificate filenames (e.g., from "Certificate-1.pdf" to the actual participant's name) using data from Excel or Google Sheets.

### ✨ Key Features
- **Bulk Paste (Ctrl+V)**: Supports pasting a list of names vertically directly from Excel or Google Sheets columns.
- **Natural Sorting**: Detects the numerical order of files exactly like the Windows Explorer algorithm (1, 2, 3... 10, 11), preventing out-of-order file matching (lexicographical error).
- **Safe Rename**: Captures errors and provides notifications if any PDF files fail to change because they are currently open/locked by another application (Adobe Reader, Browser, etc.).
- **Extension Automation**: Users do not need to type `.pdf` for the new name; the system will append it automatically.

### 🚀 System Requirements
- Local Web Server such as **XAMPP**, Laragon, or WAMP.
- PHP version 7.0 or higher.
- Modern web browser (Chrome, Firefox, Edge, Safari).

### 🛠️ Installation & Setup
1. Ensure your XAMPP application is running (Start the **Apache** module).
2. Create a new folder inside your local server's root directory, for example: `C:\xampp\htdocs\rename-pdf`.
3. Place the `index.php` (or `index-en.php`) file from this repository into that folder.
4. Open your browser and access: `http://localhost/rename-pdf`.

### 📖 Instructions for Use
1. Open Windows Explorer, find the folder where your PDF files are located, then **Copy the path** of that folder.
2. **Paste** the path into the **Source Folder Path** field in this app, then click the **Detect** button.
3. Prepare your list of new names (e.g., from Excel, Google Sheets, or Notepad).
4. Select and **Copy (Ctrl+C)** the entire list of names.
5. Click on the **New File Name** field in the top row of the table.
6. Press **Paste (Ctrl+V)**. The system will automatically distribute the names to the rows below in sequence.
7. Ensure the PDF files to be renamed are **not open** in other applications.
8. Click the green **Rename Now** button to process.

---

## 📝 License

Aplikasi ini bersifat *open-source* dan bebas digunakan atau dimodifikasi untuk keperluan apa pun.  
This application is open-source and free to use or modify for any purpose.
