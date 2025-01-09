<?php
$baseDir = 'uploads/';
$subDirs = ['foto', 'tanda_tangan'];

// Buat direktori utama jika belum ada
if (!is_dir($baseDir)) {
    mkdir($baseDir, 0777, true);
}

// Buat subdirektori jika belum ada
foreach ($subDirs as $subDir) {
    $fullPath = $baseDir . $subDir . '/';
    if (!is_dir($fullPath)) {
        mkdir($fullPath, 0777, true); // Buat subdirektori dengan izin 0777
    }
}

echo "Direktori 'uploads', 'foto', dan 'tanda_tangan' berhasil dibuat.";
?>
