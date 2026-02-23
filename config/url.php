<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// BASE_URL do site
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . "?") . "/";

// API do Unsplash
define('UNSPLASH_BASE_URL', 'https://api.unsplash.com/');
define('UNSPLASH_ACCESS_KEY', $_ENV['UNSPLASH_ACCESS_KEY']);

// Cache
define('CACHE_PATH', __DIR__ . '/../images/cache.json');