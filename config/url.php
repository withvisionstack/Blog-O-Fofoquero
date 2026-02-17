<?php

// BASE_URL do site (CSS, JS, imagens, links internos)
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . "?") . "/";

// API do Unsplash
define('UNSPLASH_BASE_URL', 'https://api.unsplash.com/');
define('UNSPLASH_ACCESS_KEY', 'DI4hgskAFGspnVvvRwSO0SwpAFBdq8HbWfoQDpJIzs8');
// Caminho para cache local (opcional)
define('CACHE_PATH', __DIR__ . '/../images/cache.json');