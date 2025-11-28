<?php include 'includes/header.php'; ?>
<?php require_once __DIR__ . '/includes/db.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in">
                    <h1 class="display-4 mb-4">Cemilan Ningrat Harga Merakyat.</h1>
                    <p class="lead mb-4">Menghadirkan produk makanan berkualitas tinggi untuk memenuhi kebutuhan kuliner.</p>
                    <a href="produk.php" class="btn btn-hero btn-lg">Lihat Produk</a>
                </div>
                <div class="col-lg-6 fade-in hero-image-container">
                    <img src="assets/images/logo2.png" alt="Arka Food Products" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section (from DB settings) -->
    <?php
    // fetch brief about (history) from settings
    $stmt = $pdo->prepare('SELECT value FROM settings WHERE `key` = :k LIMIT 1');
    $stmt->execute([':k'=>'history']);
    $historyRow = $stmt->fetch();
    $aboutExcerpt = $historyRow ? $historyRow['value'] : 'Arka Food adalah produsen makanan premium yang berkomitmen untuk menghadirkan produk berkualitas tinggi dengan standar keamanan pangan yang ketat.';
    ?>
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in about-image-container">
                    <img src="<?= $base ?>/assets/images/about.png" alt="Manufacturing facility" class="img-fluid">
                </div>
                <div class="col-lg-6 fade-in">
                    <h2 class="mb-4" style="color: var(--primary-color-2);">Tentang Arka Food</h2>
                    <p><?= nl2br(htmlspecialchars(substr($aboutExcerpt,0,350))) ?><?= strlen($aboutExcerpt) > 350 ? '...' : '' ?></p>
                    <a href="<?= $base ?>/about.php" class="btn btn-outline-primary">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Highlights -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary-color-2);">Produk Unggulan</h2>
            <div class="row">
                <?php
                $stmt = $pdo->query('SELECT id, name, slug, description, price, image FROM products WHERE is_visible IS NULL OR is_visible = 1 ORDER BY created_at DESC LIMIT 3');
                $featured = $stmt->fetchAll();
                foreach($featured as $p):
                    $img = $p['image'] ?: 'assets/images/placeholder.png';
                    if (strpos($img, 'uploads/') !== 0) $img = $base . '/' . $img;
                ?>
                <div class="col-md-4 fade-in">
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($img) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--primary-color);"><?= htmlspecialchars($p['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($p['description'],0,120)) ?><?= strlen($p['description'])>120? '...':'' ?></p>
                            <p class="text-primary fw-bold">Rp <?= number_format($p['price'],0,',','.') ?></p>
                            <a class="btn btn-primary mt-2" href="<?= $base ?>/product.php?slug=<?= urlencode($p['slug']) ?>">Lihat Produk</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Latest News -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary-color-2);">Berita Terbaru</h2>
            <div class="row">
                <?php
                $stmt = $pdo->query('SELECT id, title, slug, excerpt, image, published_at FROM news ORDER BY published_at DESC LIMIT 3');
                $news = $stmt->fetchAll();
                foreach($news as $n):
                    $nimg = $n['image'] ?: 'assets/images/news1.png';
                    if (strpos($nimg, 'uploads/') !== 0) $nimg = $base . '/' . $nimg;
                ?>
                <div class="col-md-4 fade-in">
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($nimg) ?>" class="card-img-top" alt="<?= htmlspecialchars($n['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--primary-color);"><?= htmlspecialchars($n['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($n['excerpt'] ?? '',0,120)) ?><?= strlen($n['excerpt'] ?? '')>120? '...':'' ?></p>
                            <a href="<?= $base ?>/news-detail.php?id=<?= $n['id'] ?>" class="btn btn-outline-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
