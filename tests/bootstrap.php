<?php
// Minimal PHPUnit bootstrap for CodeIgniter tests
// Load environment variables from .env if present
if (file_exists(__DIR__ . '/../load_env.php')) {
    require_once __DIR__ . '/../load_env.php';
}
// Basic autoload (composer)
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

// Provide a simple CI environment stub if necessary
putenv('CI_ENV=testing');
