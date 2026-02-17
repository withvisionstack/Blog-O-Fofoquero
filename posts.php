<?php
include_once("templates/header.php");
include_once("data/posts.php");
include_once("services/unplash.php"); // já tem cache implementado

$categoriaSelecionada = $_GET['cat'] ?? null;
$tagSelecionada = $_GET['tag'] ?? null;

// filtra posts
$postsFiltrados = $posts;

if ($categoriaSelecionada) {
    $postsFiltrados = array_filter($posts, function ($post) use ($categoriaSelecionada) {
        return $post['categoria'] === $categoriaSelecionada;
    });
}

if ($tagSelecionada) {
    $postsFiltrados = array_filter($posts, function ($post) use ($tagSelecionada) {
        return in_array($tagSelecionada, $post['tags']);
    });
}

// paginação simples
$porPagina = 3; // quantos posts por página
$paginaAtual = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$totalPosts = count($postsFiltrados);
$totalPaginas = ceil($totalPosts / $porPagina);

// calcula offset
$inicio = ($paginaAtual - 1) * $porPagina;
$postsPagina = array_slice($postsFiltrados, $inicio, $porPagina);
?>

<link rel="stylesheet" href="<?= $BASE_URL ?>css/posts.css?v=<?= time() ?>">
<main id="posts-container">
    <h2>
        <?php if ($categoriaSelecionada): ?>
            Posts na categoria "
            <?= htmlspecialchars($categoriaSelecionada) ?>"
        <?php elseif ($tagSelecionada): ?>
            Posts com a tag "
            <?= htmlspecialchars($tagSelecionada) ?>"
        <?php else: ?>
            Todos os Posts
        <?php endif; ?>
    </h2>

    <?php if (empty($postsPagina)): ?>
        <p>Nenhum post encontrado.</p>
    <?php else: ?>
        <div class="posts-grid">
            <?php foreach ($postsPagina as $post): ?>
                <?php $imagem = buscarImagemPorCategoria($post['categoria']); ?>
                <article class="post-card">
                    <div class="img-container">
                        <?php if ($imagem): ?>
                            <img src="<?= $imagem ?>" alt="<?= htmlspecialchars($post['titulo']) ?>">
                        <?php else: ?>
                            <img src="images/fallback.jpg" alt="Imagem padrão">
                        <?php endif; ?>
                    </div>
                    <div class="post-info">
                        <h3>
                            <?= htmlspecialchars($post['titulo']) ?>
                        </h3>
                        <p>
                            <?= htmlspecialchars($post['descricao']) ?>
                        </p>
                        <a class="btn" href="post.php?id=<?= $post['id'] ?>">Ler mais</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Navegação de páginas -->
    <?php if ($totalPaginas > 1): ?>
        <div class="pagination">
            <?php if ($paginaAtual > 1): ?>
                <a
                    href="posts.php?<?= $categoriaSelecionada ? 'cat=' . urlencode($categoriaSelecionada) : 'tag=' . urlencode($tagSelecionada) ?>&page=<?= $paginaAtual - 1 ?>">Anterior</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <a href="posts.php?<?= $categoriaSelecionada ? 'cat=' . urlencode($categoriaSelecionada) : 'tag=' . urlencode($tagSelecionada) ?>&page=<?= $i ?>"
                    class="<?= $i === $paginaAtual ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($paginaAtual < $totalPaginas): ?>
                <a
                    href="posts.php?<?= $categoriaSelecionada ? 'cat=' . urlencode($categoriaSelecionada) : 'tag=' . urlencode($tagSelecionada) ?>&page=<?= $paginaAtual + 1 ?>">Próximo</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>

<?php include_once("templates/footer.php"); ?>