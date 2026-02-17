<?php
header('ngrok-skip-browser-warning: true');
include_once("config/url.php");
include_once("data/posts.php");
include_once("data/categorias.php");
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog O Fofoquero</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= $BASE_URL ?>images/favicon.png">
    <script>
        /* Aplica tema salvo antes de renderizar — evita flash */
        (function () {
            const saved = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', saved);
        })();
    </script>
</head>

<body>

    <!-- Overlay: escurece o fundo no menu mobile -->
    <div class="menu-overlay" id="menu-overlay"></div>

    <!-- Menu lateral mobile -->
    <ul id="navbar">
        <li><a href="<?= $BASE_URL ?>" class="nav-link">Home</a></li>
        <li><a href="#" class="nav-link">Categorias</a></li>
        <li><a href="#" class="nav-link">Sobre</a></li>
        <li><a href="<?= $BASE_URL ?>contato.php" class="nav-link">Contato</a></li>
        <li class="mobile-search-wrap">
            <form action="<?= $BASE_URL ?>posts.php" method="get" class="mobile-search-form">
                <input type="search" name="q" placeholder="Buscar posts…">
                <button type="submit">→</button>
            </form>
        </li>
    </ul>

    <header>
        <!-- LOGO -->
        <a href="<?= $BASE_URL ?>" id="logo">
            <img src="<?= $BASE_URL ?>images/logo.png" alt="Blog O Fofoquero" draggable="false"
                oncontextmenu="return false;">
        </a>

        <!-- NAV DESKTOP -->
        <nav id="nav-desktop">
            <ul>
                <li><a href="<?= $BASE_URL ?>" class="nav-link">Home</a></li>
                <li><a href="#" class="nav-link">Categorias</a></li>
                <li><a href="#" class="nav-link">Sobre</a></li>
                <li><a href="<?= $BASE_URL ?>contato.php" class="nav-link">Contato</a></li>
            </ul>
        </nav>

        <!-- DIREITA: busca + tema + hamburguer -->
        <div class="header-right">
            <form action="<?= $BASE_URL ?>posts.php" method="get" class="header-search">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg>
                <input type="search" name="q" placeholder="Buscar posts…">
            </form>

            <!-- botão -->
            <button id="theme-toggle" aria-label="Alternar tema">
                <span class="theme-icon"><i class="fa-solid fa-moon"></i></span>
                <span class="theme-label">Escuro</span>
            </button>

            <button class="menu-toggle" id="menu-toggle" aria-label="Abrir menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>