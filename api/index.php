<?php

// Forward Vercel serverless requests to public/index.php
// Setup writable /tmp storage and cache paths for serverless execution

$tmpStorage = '/tmp/storage';
$tmpBootstrap = '/tmp/bootstrap';

$tmpDirs = [
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/logs',
    $tmpBootstrap . '/cache',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Copy bootstrap cache files if available to speed up booting and avoid read-only issues
$origBootstrap = __DIR__ . '/../bootstrap/cache';
if (is_dir($origBootstrap)) {
    foreach (glob($origBootstrap . '/*.php') as $file) {
        $dest = $tmpBootstrap . '/cache/' . basename($file);
        if (!file_exists($dest)) {
            @copy($file, $dest);
        }
    }
}

// Remove any stale bootstrap cache files that reference dev-only packages (e.g. Laravel\Pail, Laravel\Sail)
foreach ([$tmpBootstrap . '/cache/packages.php', $tmpBootstrap . '/cache/services.php'] as $cacheFile) {
    if (file_exists($cacheFile)) {
        $content = @file_get_contents($cacheFile);
        if ($content && (str_contains($content, 'PailServiceProvider') || str_contains($content, 'SailServiceProvider'))) {
            @unlink($cacheFile);
        }
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

// Fallback APP_KEY if not yet configured in Vercel environment variables
if (!getenv('APP_KEY') && empty($_ENV['APP_KEY'])) {
    $defaultKey = 'base64:j45cTk7AIykOuDFVGY2M1/gYDy5Z6vQtETZNh0Qe9as=';
    putenv('APP_KEY=' . $defaultKey);
    $_ENV['APP_KEY'] = $defaultKey;
    $_SERVER['APP_KEY'] = $defaultKey;
}

// Setup environment variables for Laravel on Vercel serverless
putenv('APP_STORAGE=' . $tmpStorage);
$_ENV['APP_STORAGE'] = $tmpStorage;
$_SERVER['APP_STORAGE'] = $tmpStorage;

putenv('APP_BOOTSTRAP_PATH=' . $tmpBootstrap);
$_ENV['APP_BOOTSTRAP_PATH'] = $tmpBootstrap;
$_SERVER['APP_BOOTSTRAP_PATH'] = $tmpBootstrap;

putenv('VIEW_COMPILED_PATH=' . $tmpStorage . '/framework/views');
$_ENV['VIEW_COMPILED_PATH'] = $tmpStorage . '/framework/views';
$_SERVER['VIEW_COMPILED_PATH'] = $tmpStorage . '/framework/views';

putenv('APP_CONFIG_CACHE=' . $tmpBootstrap . '/cache/config.php');
$_ENV['APP_CONFIG_CACHE'] = $tmpBootstrap . '/cache/config.php';
$_SERVER['APP_CONFIG_CACHE'] = $tmpBootstrap . '/cache/config.php';

putenv('APP_PACKAGES_CACHE=' . $tmpBootstrap . '/cache/packages.php');
$_ENV['APP_PACKAGES_CACHE'] = $tmpBootstrap . '/cache/packages.php';
$_SERVER['APP_PACKAGES_CACHE'] = $tmpBootstrap . '/cache/packages.php';

putenv('APP_SERVICES_CACHE=' . $tmpBootstrap . '/cache/services.php');
$_ENV['APP_SERVICES_CACHE'] = $tmpBootstrap . '/cache/services.php';
$_SERVER['APP_SERVICES_CACHE'] = $tmpBootstrap . '/cache/services.php';

putenv('APP_ROUTES_CACHE=' . $tmpBootstrap . '/cache/routes.php');
$_ENV['APP_ROUTES_CACHE'] = $tmpBootstrap . '/cache/routes.php';
$_SERVER['APP_ROUTES_CACHE'] = $tmpBootstrap . '/cache/routes.php';

putenv('APP_EVENTS_CACHE=' . $tmpBootstrap . '/cache/events.php');
$_ENV['APP_EVENTS_CACHE'] = $tmpBootstrap . '/cache/events.php';
$_SERVER['APP_EVENTS_CACHE'] = $tmpBootstrap . '/cache/events.php';

if (!getenv('CACHE_STORE')) {
    putenv('CACHE_STORE=array');
    $_ENV['CACHE_STORE'] = 'array';
    $_SERVER['CACHE_STORE'] = 'array';
}

if (!getenv('SESSION_DRIVER')) {
    putenv('SESSION_DRIVER=cookie');
    $_ENV['SESSION_DRIVER'] = 'cookie';
    $_SERVER['SESSION_DRIVER'] = 'cookie';
}

if (!getenv('LOG_CHANNEL')) {
    putenv('LOG_CHANNEL=stderr');
    $_ENV['LOG_CHANNEL'] = 'stderr';
    $_SERVER['LOG_CHANNEL'] = 'stderr';
}

require __DIR__ . '/../public/index.php';
