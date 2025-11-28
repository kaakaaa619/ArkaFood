<?php
require_once __DIR__ . '/auth.php';
require_login();

// Gather overview stats
$counts = [];
$counts['products'] = $pdo->query('SELECT COUNT(*) as c FROM products')->fetch()['c'] ?? 0;
$counts['news'] = $pdo->query('SELECT COUNT(*) as c FROM news')->fetch()['c'] ?? 0;

$recentProducts = $pdo->query('SELECT id, name, price, image, created_at FROM products ORDER BY created_at DESC LIMIT 5')->fetchAll();
$recentNews = $pdo->query('SELECT id, title, published_at FROM news ORDER BY published_at DESC LIMIT 5')->fetchAll();

?>
<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container py-4">
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Produk</h5>
                <p class="lead mb-0"><?= intval($counts['products']) ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Berita</h5>
                <p class="lead mb-0"><?= intval($counts['news']) ?></p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Produk Terbaru</h5>
            <ul class="list-group">
                <?php foreach($recentProducts as $p): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= htmlspecialchars($p['name']) ?></strong>
                            <div class="small text-muted">Rp <?= number_format($p['price'],0,',','.') ?> — <?= $p['created_at'] ?></div>
                        </div>
                        <a href="product_edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-md-6">
            <h5>Berita Terbaru</h5>
            <ul class="list-group">
                <?php foreach($recentNews as $n): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= htmlspecialchars($n['title']) ?></strong>
                            <div class="small text-muted"><?= $n['published_at'] ?></div>
                        </div>
                        <a href="news_edit.php?id=<?= $n['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>


