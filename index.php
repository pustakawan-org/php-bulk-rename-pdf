<?php
$folder_path = isset($_POST['folder_path']) ? $_POST['folder_path'] : '';
$pesan = '';
$list_file = [];

// Proses Ubah Nama
if (isset($_POST['action']) && $_POST['action'] === 'rename') {
    $folder_path = $_POST['folder_path'];
    $file_lama = $_POST['file_lama'];
    $file_baru = $_POST['file_baru'];
    $ekstensi = $_POST['ekstensi'];
    
    $berhasil = 0;
    $gagal = []; // Menyimpan daftar file yang gagal diubah

    foreach ($file_lama as $index => $lama) {
        $baru = trim($file_baru[$index]);
        
        // Hanya proses jika kolom nama baru tidak kosong dan nama berbeda
        if (!empty($baru) && $lama !== $baru) {
            $path_lama = rtrim($folder_path, '/\\') . DIRECTORY_SEPARATOR . $lama . '.' . $ekstensi[$index];
            $path_baru = rtrim($folder_path, '/\\') . DIRECTORY_SEPARATOR . $baru . '.' . $ekstensi[$index];
            
            if (file_exists($path_lama)) {
                // Gunakan @ untuk suppress warning bawaan PHP jika file dilock oleh OS
                if (@rename($path_lama, $path_baru)) {
                    $berhasil++;
                } else {
                    // Jika false, berarti file sedang terbuka atau tidak ada izin akses
                    $gagal[] = $lama . '.' . $ekstensi[$index];
                }
            }
        }
    }
    
    // Susun pesan notifikasi
    if ($berhasil > 0) {
        $pesan .= "<div class='bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg mb-4 shadow-sm'>
                    <strong class='font-bold text-lg'>Berhasil!</strong><br>
                    Telah mengubah <strong>$berhasil</strong> nama file.
                   </div>";
    }
    
    if (count($gagal) > 0) {
        $daftar_gagal = implode(", ", $gagal);
        $pesan .= "<div class='bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-4 shadow-sm'>
                    <strong class='font-bold text-lg'>Gagal mengubah " . count($gagal) . " file:</strong><br>
                    <span class='text-sm mt-1 block font-mono'>$daftar_gagal</span>
                    <hr class='border-red-300 my-2'>
                    <p class='text-sm'><em><strong>Penyebab umum:</strong> File tersebut sedang dibuka di aplikasi lain (seperti PDF Reader atau Browser). Silakan tutup file tersebut dan coba klik 'Ubah Sekarang' lagi.</em></p>
                   </div>";
    }
}

// Proses Scan Folder
if (!empty($folder_path) && is_dir($folder_path)) {
    $semua_file = scandir($folder_path);
    
    // Mengurutkan file secara natural agar sama dengan Windows Explorer (1, 2, 3... 10, 11)
    natcasesort($semua_file); 
    
    foreach ($semua_file as $file) {
        if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
            $list_file[] = $file;
        }
    }
    
    // Reset index array
    $list_file = array_values($list_file);
    
} elseif (!empty($folder_path) && !isset($_POST['action'])) {
    $pesan = "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded-lg mb-4 shadow-sm'><strong>Peringatan:</strong> Folder tidak ditemukan. Pastikan path yang dimasukkan benar dan absolut (contoh: C:\xampp\htdocs\sertifikat).</div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Rename PDF</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans p-4 md:p-8">

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri: Form & Tabel (Lebih Lebar) -->
        <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-600">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Alat Ubah Nama File Masal</h2>
            
            <?= $pesan ?>

            <!-- Form 1: Cari Folder -->
            <form method="POST" class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Path Folder Sumber:</label>
                <div class="flex gap-2">
                    <input type="text" name="folder_path" value="<?= htmlspecialchars($folder_path) ?>" 
                           class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                           placeholder="Contoh: C:\xampp\htdocs\sertifikat" required>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition font-semibold shadow-sm">
                        Deteksi
                    </button>
                </div>
            </form>

            <!-- Form 2: List File dan Rename -->
            <?php if (!empty($list_file)): ?>
                <form method="POST">
                    <input type="hidden" name="action" value="rename">
                    <input type="hidden" name="folder_path" value="<?= htmlspecialchars($folder_path) ?>">
                    
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 bg-blue-50 p-4 border border-blue-200 rounded-lg">
                        <p class="font-semibold text-blue-800 mb-2 sm:mb-0">Ditemukan <strong><?= count($list_file) ?></strong> file PDF.</p>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-2 rounded-md font-bold transition shadow-md w-full sm:w-auto text-center">
                            Ubah Sekarang
                        </button>
                    </div>

                    <div class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm">
                        <table class="w-full border-collapse min-w-[600px]">
                            <thead>
                                <tr class="bg-gray-800 text-white">
                                    <th class="px-4 py-3 text-left w-1/2 font-semibold">Nama File Asli</th>
                                    <th class="px-4 py-3 text-left w-1/2 font-semibold">Nama File Baru</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list_file as $index => $file): 
                                    $nama_tanpa_ext = pathinfo($file, PATHINFO_FILENAME);
                                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                                    $bg_color = $index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
                                ?>
                                    <tr class="<?= $bg_color ?> hover:bg-blue-100 transition duration-150 border-b border-gray-200">
                                        <td class="px-4 py-2 font-mono text-sm text-gray-700">
                                            <?= htmlspecialchars($nama_tanpa_ext) ?>
                                            <input type="hidden" name="file_lama[]" value="<?= htmlspecialchars($nama_tanpa_ext) ?>">
                                            <input type="hidden" name="ekstensi[]" value="<?= htmlspecialchars($ext) ?>">
                                        </td>
                                        <td class="p-0 border-l border-gray-200">
                                            <input type="text" name="file_baru[]" 
                                                   class="input-baru w-full h-full px-4 py-3 border-none focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 font-mono text-sm bg-transparent" 
                                                   placeholder="Ketik/Paste di sini..." autocomplete="off">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            <?php endif; ?>
        </div>

	<!-- Kolom Kanan: Petunjuk Penggunaan -->
        <div class="md:col-span-1">
            <div class="bg-indigo-50 border border-indigo-200 p-6 rounded-lg shadow-md sticky top-6">
                <h3 class="text-lg font-bold text-indigo-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Petunjuk Penggunaan
                </h3>
                
                <ol class="list-decimal list-inside space-y-3 text-sm text-indigo-900">
                    <li class="pl-1">Buka Windows Explorer, cari folder tempat file PDF Anda berada, lalu <strong>Copy path</strong> (salin alamat folder) tersebut.</li>
                    <li class="pl-1"><strong>Paste</strong> path tersebut ke kolom <strong>Path Folder Sumber</strong> di aplikasi localhost ini, lalu klik tombol <strong>Deteksi</strong>.</li>
                    <li class="pl-1">Siapkan daftar nama baru Anda (misalnya dari Excel, Google Sheets, atau Notepad).</li>
                    <li class="pl-1">Blok dan <strong>Copy (Ctrl+C)</strong> seluruh daftar nama tersebut.</li>
                    <li class="pl-1">Klik pada kolom <strong>Nama File Baru</strong> di baris paling atas pada tabel.</li>
                    <li class="pl-1">Tekan <strong>Paste (Ctrl+V)</strong>. Sistem otomatis mendistribusikan nama ke baris bawahnya secara berurutan.</li>
                    <li class="pl-1 text-red-700 font-medium">Pastikan file PDF yang akan diubah <strong>tidak sedang dibuka</strong> di aplikasi lain (seperti Adobe Reader atau Browser).</li>
                    <li class="pl-1">Klik tombol <strong>Ubah Sekarang</strong> berwarna hijau untuk memproses.</li>
                </ol>

                <div class="mt-6 p-4 bg-white rounded-md border border-indigo-100 shadow-sm">
                    <p class="text-xs text-gray-500 italic">
                        <strong>Catatan Ekstensi:</strong><br>
                        Anda tidak perlu mengetik ".pdf" pada nama baru. Sistem akan menambahkannya secara otomatis.
                    </p>
                </div>
            </div>
        </div>

    </div>

    <!-- Script untuk fitur Bulk Paste (Ctrl+V) menurun -->
    <script>
        document.addEventListener('paste', function(e) {
            if (e.target.classList.contains('input-baru')) {
                e.preventDefault();
                
                let pasteData = (e.clipboardData || window.clipboardData).getData('text');
                let baris_nama = pasteData.split(/\r?\n/).map(line => line.trim()).filter(line => line !== '');
                
                let semua_input = Array.from(document.querySelectorAll('.input-baru'));
                let indeks_awal = semua_input.indexOf(e.target);
                
                for (let i = 0; i < baris_nama.length; i++) {
                    if (semua_input[indeks_awal + i]) {
                        semua_input[indeks_awal + i].value = baris_nama[i];
                        // Memberi efek visual singkat bahwa baris ini terisi otomatis
                        semua_input[indeks_awal + i].classList.add('bg-green-50');
                        setTimeout(() => {
                            semua_input[indeks_awal + i].classList.remove('bg-green-50');
                        }, 500);
                    }
                }
            }
        });
    </script>
</body>
</html>