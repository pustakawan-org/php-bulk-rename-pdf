<?php
$folder_path = isset($_POST['folder_path']) ? $_POST['folder_path'] : '';
$message = '';
$file_list = [];

// Rename Process
if (isset($_POST['action']) && $_POST['action'] === 'rename') {
    $folder_path = $_POST['folder_path'];
    $old_files = $_POST['old_file'];
    $new_files = $_POST['new_file'];
    $extensions = $_POST['extension'];
    
    $success_count = 0;
    $failed_list = []; // Store list of files that failed to rename

    foreach ($old_files as $index => $old) {
        $new = trim($new_files[$index]);
        
        // Process only if the new name is not empty and different from the old one
        if (!empty($new) && $old !== $new) {
            $old_path = rtrim($folder_path, '/\\') . DIRECTORY_SEPARATOR . $old . '.' . $extensions[$index];
            $new_path = rtrim($folder_path, '/\\') . DIRECTORY_SEPARATOR . $new . '.' . $extensions[$index];
            
            if (file_exists($old_path)) {
                // Use @ to suppress PHP warnings if the file is locked by the OS
                if (@rename($old_path, $new_path)) {
                    $success_count++;
                } else {
                    // If false, the file might be open or lacks permission
                    $failed_list[] = $old . '.' . $extensions[$index];
                }
            }
        }
    }
    
    // Build notification message
    if ($success_count > 0) {
        $message .= "<div class='bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg mb-4 shadow-sm'>
                    <strong class='font-bold text-lg'>Success!</strong><br>
                    Successfully renamed <strong>$success_count</strong> files.
                   </div>";
    }
    
    if (count($failed_list) > 0) {
        $failed_names = implode(", ", $failed_list);
        $message .= "<div class='bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-4 shadow-sm'>
                    <strong class='font-bold text-lg'>Failed to rename " . count($failed_list) . " files:</strong><br>
                    <span class='text-sm mt-1 block font-mono'>$failed_names</span>
                    <hr class='border-red-300 my-2'>
                    <p class='text-sm'><em><strong>Common cause:</strong> The file is currently open in another application (like a PDF Reader or Browser). Please close the file and try clicking 'Rename Now' again.</em></p>
                   </div>";
    }
}

// Folder Scan Process
if (!empty($folder_path) && is_dir($folder_path)) {
    $all_files = scandir($folder_path);
    
    // Sort files naturally like Windows Explorer (1, 2, 3... 10, 11)
    natcasesort($all_files); 
    
    foreach ($all_files as $file) {
        if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
            $file_list[] = $file;
        }
    }
    
    // Reset array index
    $file_list = array_values($file_list);
    
} elseif (!empty($folder_path) && !isset($_POST['action'])) {
    $message = "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded-lg mb-4 shadow-sm'><strong>Warning:</strong> Folder not found. Make sure the entered path is correct and absolute (e.g., C:\xampp\htdocs\certificates).</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Rename PDF</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans p-4 md:p-8">

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-600">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Bulk File Renamer Tool</h2>
            
            <?= $message ?>

            <form method="POST" class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Source Folder Path:</label>
                <div class="flex gap-2">
                    <input type="text" name="folder_path" value="<?= htmlspecialchars($folder_path) ?>" 
                           class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                           placeholder="Example: C:\xampp\htdocs\certificates" required>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition font-semibold shadow-sm">
                        Detect
                    </button>
                </div>
            </form>

            <?php if (!empty($file_list)): ?>
                <form method="POST">
                    <input type="hidden" name="action" value="rename">
                    <input type="hidden" name="folder_path" value="<?= htmlspecialchars($folder_path) ?>">
                    
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 bg-blue-50 p-4 border border-blue-200 rounded-lg">
                        <p class="font-semibold text-blue-800 mb-2 sm:mb-0">Found <strong><?= count($file_list) ?></strong> PDF files.</p>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-2 rounded-md font-bold transition shadow-md w-full sm:w-auto text-center">
                            Rename Now
                        </button>
                    </div>

                    <div class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm">
                        <table class="w-full border-collapse min-w-[600px]">
                            <thead>
                                <tr class="bg-gray-800 text-white">
                                    <th class="px-4 py-3 text-left w-1/2 font-semibold">Original File Name</th>
                                    <th class="px-4 py-3 text-left w-1/2 font-semibold">New File Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($file_list as $index => $file): 
                                    $name_without_ext = pathinfo($file, PATHINFO_FILENAME);
                                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                                    $bg_color = $index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
                                ?>
                                    <tr class="<?= $bg_color ?> hover:bg-blue-100 transition duration-150 border-b border-gray-200">
                                        <td class="px-4 py-2 font-mono text-sm text-gray-700">
                                            <?= htmlspecialchars($name_without_ext) ?>
                                            <input type="hidden" name="old_file[]" value="<?= htmlspecialchars($name_without_ext) ?>">
                                            <input type="hidden" name="extension[]" value="<?= htmlspecialchars($ext) ?>">
                                        </td>
                                        <td class="p-0 border-l border-gray-200">
                                            <input type="text" name="new_file[]" 
                                                   class="new-input w-full h-full px-4 py-3 border-none focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 font-mono text-sm bg-transparent" 
                                                   placeholder="Type/Paste here..." autocomplete="off">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            <?php endif; ?>
        </div>

        <div class="md:col-span-1">
            <div class="bg-indigo-50 border border-indigo-200 p-6 rounded-lg shadow-md sticky top-6">
                <h3 class="text-lg font-bold text-indigo-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Instructions for Use
                </h3>
                
                <ol class="list-decimal list-inside space-y-3 text-sm text-indigo-900">
                    <li class="pl-1">Open Windows Explorer, find the folder where your PDF files are located, then <strong>Copy the path</strong> of that folder.</li>
                    <li class="pl-1"><strong>Paste</strong> the path into the <strong>Source Folder Path</strong> field in this app, then click the <strong>Detect</strong> button.</li>
                    <li class="pl-1">Prepare your list of new names (e.g., from Excel, Google Sheets, or Notepad).</li>
                    <li class="pl-1">Select and <strong>Copy (Ctrl+C)</strong> the entire list of names.</li>
                    <li class="pl-1">Click on the <strong>New File Name</strong> field in the top row of the table.</li>
                    <li class="pl-1">Press <strong>Paste (Ctrl+V)</strong>. The system will automatically distribute the names to the rows below in sequence.</li>
                    <li class="pl-1 text-red-700 font-medium">Ensure the PDF files to be renamed are <strong>not open</strong> in other applications (like Adobe Reader or Browser).</li>
                    <li class="pl-1">Click the green <strong>Rename Now</strong> button to process.</li>
                </ol>

                <div class="mt-6 p-4 bg-white rounded-md border border-indigo-100 shadow-sm">
                    <p class="text-xs text-gray-500 italic">
                        <strong>Extension Note:</strong><br>
                        You do not need to type ".pdf" for the new name. The system will add it automatically.
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('paste', function(e) {
            if (e.target.classList.contains('new-input')) {
                e.preventDefault();
                
                let pasteData = (e.clipboardData || window.clipboardData).getData('text');
                let name_rows = pasteData.split(/\r?\n/).map(line => line.trim()).filter(line => line !== '');
                
                let all_inputs = Array.from(document.querySelectorAll('.new-input'));
                let start_index = all_inputs.indexOf(e.target);
                
                for (let i = 0; i < name_rows.length; i++) {
                    if (all_inputs[start_index + i]) {
                        all_inputs[start_index + i].value = name_rows[i];
                        // Add brief visual effect indicating auto-fill
                        all_inputs[start_index + i].classList.add('bg-green-50');
                        setTimeout(() => {
                            all_inputs[start_index + i].classList.remove('bg-green-50');
                        }, 500);
                    }
                }
            }
        });
    </script>
</body>
</html>