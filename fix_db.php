<?php
$db = new PDO('sqlite:database/database.sqlite');

// Cek kolom yang ada di tabel users
$cols = $db->query("PRAGMA table_info(users)")->fetchAll(PDO::FETCH_ASSOC);
$colNames = array_column($cols, 'name');
echo "Kolom users: " . implode(', ', $colNames) . "\n\n";

// Tambah is_active jika belum ada
if (!in_array('is_active', $colNames)) {
    $db->exec("ALTER TABLE users ADD COLUMN is_active INTEGER NOT NULL DEFAULT 1");
    echo "✅ Kolom is_active ditambahkan\n";
} else {
    echo "ℹ️  Kolom is_active sudah ada\n";
}

// Set semua user aktif
$updated = $db->exec("UPDATE users SET is_active = 1");
echo "✅ $updated user diset aktif\n";

// Hapus migration yang gagal dari tabel migrations agar tidak konflik
$db->exec("DELETE FROM migrations WHERE migration LIKE '%add_is_active%'");
echo "✅ Record migration lama dihapus\n";

// Verifikasi
$users = $db->query("SELECT id, name, role, is_active FROM users")->fetchAll(PDO::FETCH_ASSOC);
echo "\nUsers sekarang:\n";
foreach ($users as $u) {
    echo "  [{$u['role']}] {$u['name']} — is_active: {$u['is_active']}\n";
}
