<?php
$lines = file('storage/logs/laravel.log');
$errors = array_filter($lines, fn($l) => str_contains($l, 'local.ERROR'));
$last = array_slice($errors, -3);
foreach($last as $l) echo substr($l, 0, 300) . "\n---\n";
