<?php

// Forward Vercel requests to public/index.php
// Setup writable /tmp storage paths for serverless execution

$tmpStorage = '/tmp/storage';
$tmpDirs = [
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/logs',
    '/tmp/bootstrap/cache',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Copy SQLite database to /tmp if it exists in repository
$databaseFile = __DIR__ . '/../database/database.sqlite';
$tmpDatabase = '/tmp/database.sqlite';
if (file_exists($databaseFile) && !file_exists($tmpDatabase)) {
    @copy($databaseFile, $tmpDatabase);
}

if (file_exists($tmpDatabase)) {
    putenv('DB_DATABASE=' . $tmpDatabase);
    $_ENV['DB_DATABASE'] = $tmpDatabase;
    $_SERVER['DB_DATABASE'] = $tmpDatabase;
}

// Ensure APP_STORAGE points to /tmp/storage
putenv('APP_STORAGE=' . $tmpStorage);
$_ENV['APP_STORAGE'] = $tmpStorage;
$_SERVER['APP_STORAGE'] = $tmpStorage;

// Set view compiled path
putenv('VIEW_COMPILED_PATH=' . $tmpStorage . '/framework/views');
$_ENV['VIEW_COMPILED_PATH'] = $tmpStorage . '/framework/views';
$_SERVER['VIEW_COMPILED_PATH'] = $tmpStorage . '/framework/views';

require __DIR__ . '/../public/index.php';
