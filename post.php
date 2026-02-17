<?php
include_once("templates/header.php");
include_once("data/posts.php");
include_once("data/conteudos.php");
include_once("services/unplash.php");

$currentPost = null;

if (isset($_GET['id'])) {
    $postid = (int) $_GET['id'];
    foreach ($posts as $post) {
        if ($post['id'] === $postid) {
            $currentPost = $post;
            break;
        }
    }
}

// se achou o post, busca a imagem da categoria
$imagem = null;
if ($currentPost) {
    $imagem = buscarImagemPorCategoria($currentPost['categoria']);
}

// coletar todas as categorias únicas
$categorias = array_unique(array_column($posts, 'categoria'));
?>

<?php if ($currentPost): ?>
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/post.css?v=<?= time() ?>">

    <div class="layout">
        <main id="post-container">
            <div class="content-container">
                <h1 class="montserrat-light" id="main-title">
                    <?= htmlspecialchars($currentPost['titulo']) ?>
                </h1>
                <p class="montserrat-light" id="post-description">
                    <?= htmlspecialchars($currentPost['descricao']) ?>
                </p>

                <div class="img-container">
                    <?php if ($imagem): ?>
                        <img src="<?= $imagem ?>" alt="<?= htmlspecialchars($currentPost['titulo']) ?>">
                    <?php else: ?>
                        <img src="images/fallback.jpg" alt="Imagem padrão">
                    <?php endif; ?>
                </div>

                <div class="post-body">
                    <?= nl2br(htmlspecialchars($conteudos[$currentPost['id']] ?? '')) ?>
                </div>
            </div>
        </main>

        <!-- Aside com todas as categorias -->
        <aside id="nav-container">
            <h3 id="tags-title">Categorias</h3>
            <div id="category-list">
                <ul>
                    <?php foreach ($categorias as $cat): ?>
                        <li>
                            <a href="posts.php?cat=<?= urlencode($cat) ?>">
                                <?= htmlspecialchars($cat) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Tag list -->
            <h3 id="tags-title">Tags</h3>
            <div id="tag-list">
                <ul>
                    <?php
                    $todasTags = [];
                    foreach ($posts as $post) {
                        $todasTags = array_merge($todasTags, $post['tags']);
                    }
                    $todasTags = array_unique($todasTags);

                    foreach ($todasTags as $tag): ?>
                        <li>
                            <a href="posts.php?tag=<?= urlencode($tag) ?>">
                                <?= htmlspecialchars($tag) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>
    </div> <!-- fechamento correto do layout -->
<?php else: ?>
    <p>Post não encontrado.</p>
<?php endif; ?>

<?php include_once("templates/footer.php"); ?>