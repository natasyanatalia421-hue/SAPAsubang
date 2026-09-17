<?php
$db = new PDO('sqlite:database/database.sqlite');
echo "=== Users di database ===\n";
$users = $db->query("SELECT email, role, created_at FROM users ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
foreach ($users as $u) {
    echo "[{$u['role']}] {$u['email']} — {$u['created_at']}\n";
}
echo "\nTotal: " . count($users) . " user\n";

// Cek apakah ada error di session driver
echo "\n=== Config DB ===\n";
echo "DB: " . (file_exists('database/database.sqlite') ? 'SQLite OK (' . filesize('database/database.sqlite') . ' bytes)' : 'TIDAK ADA') . "\n";
