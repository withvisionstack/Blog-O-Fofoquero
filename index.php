<?php
include_once("templates/header.php");
include_once("data/posts.php");
include_once("services/unplash.php");

// armazenar imagens por categoria
$imagensCategorias = [];

foreach ($posts as $post) {
    $categoria = $post['categoria'];

    if (!isset($imagensCategorias[$categoria])) {
        $imagensCategorias[$categoria] = buscarImagemPorCategoria($categoria);
    }
}

$postDestaque = $posts[0] ?? null;
$postSecundarios = array_slice($posts, 1);

// Coletar categorias únicas para os pills
$categorias = array_unique(array_column($posts, 'categoria'));
?>

<main>
    <div id="posts-container">

        <!-- ── HERO (Post Destaque) ── -->
        <?php if ($postDestaque): ?>
            <section class="hero">
                <?php if (isset($imagensCategorias[$postDestaque['categoria']])): ?>
                    <div class="hero-img-wrap">
                        <img src="<?= $imagensCategorias[$postDestaque['categoria']] ?>"
                            alt="<?= htmlspecialchars($postDestaque['titulo']) ?>">
                    </div>
                <?php endif; ?>

                <div class="hero-overlay"></div>

                <span class="hero-tag">
                    <?= htmlspecialchars($postDestaque['categoria']) ?>
                </span>

                <div class="hero-content">
                    <div class="hero-meta">
                        <span>📅
                            <?= date('d M Y') ?>
                        </span>
                        <span class="hero-dot"></span>
                        <span>⏱ 5 min de leitura</span>
                    </div>
                    <h1 class="hero-title">
                        <?= htmlspecialchars($postDestaque['titulo']) ?>
                    </h1>
                    <p class="hero-subtitle">
                        <?= htmlspecialchars($postDestaque['descricao']) ?>
                    </p>
                    <a href="post.php?id=<?= $postDestaque['id'] ?>" class="hero-btn">
                        Ler artigo completo <span>→</span>
                    </a>
                </div>
            </section>
        <?php endif; ?>

        <!-- ── PILLS DE CATEGORIA ── -->
        <?php if (!empty($categorias)): ?>
            <div class="cats-wrap">
                <div class="cats-pills">
                    <a href="#" class="cat-pill active" data-cat="todos">Tudo</a>
                    <?php foreach ($categorias as $cat): ?>
                        <a href="#" class="cat-pill" data-cat="<?= htmlspecialchars($cat) ?>">
                            <?= htmlspecialchars($cat) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- ── GRADE DE CARDS ── -->
        <?php if (!empty($postSecundarios)): ?>
            <div class="section-header">
                <h2 class="section-title">Posts <span>Recentes</span></h2>
                <a href="posts.php" class="section-link">Ver todos →</a>
            </div>

            <div class="posts-grid">
                <?php foreach ($postSecundarios as $post): ?>
                    <article class="post-box" data-cat="<?= htmlspecialchars($post['categoria']) ?>">
                        <div class="post-img-wrap">
                            <?php if (isset($imagensCategorias[$post['categoria']])): ?>
                                <img src="<?= $imagensCategorias[$post['categoria']] ?>"
                                    alt="<?= htmlspecialchars($post['titulo']) ?>">
                            <?php endif; ?>
                            <span class="post-cat-badge">
                                <?= htmlspecialchars($post['categoria']) ?>
                            </span>
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span>
                                    <?= date('d M Y') ?>
                                </span>
                                <span class="meta-dot"></span>
                                <span>4 min</span>
                            </div>
                            <h2>
                                <?= htmlspecialchars($post['titulo']) ?>
                            </h2>
                            <p>
                                <?= htmlspecialchars($post['descricao']) ?>
                            </p>
                            <div class="post-footer">
                                <a href="post.php?id=<?= $post['id'] ?>" class="post-read-btn">
                                    Ler artigo <span>→</span>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<script src="<?= $BASE_URL ?>js/filter.js" defer></script>

<?php include_once("templates/footer.php"); ?>