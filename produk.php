<?php include 'includes/header.php'; ?>
<?php require_once __DIR__ . '/includes/db.php'; ?>

    <!-- Products Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary-color-2);">Katalog Produk</h2>
            <!-- Product Grid -->
            <div class="row">
                <?php
                $stmt = $pdo->query('SELECT id, name, slug, description, price, image FROM products WHERE is_visible IS NULL OR is_visible = 1 ORDER BY created_at DESC');
                $rows = $stmt->fetchAll();
                foreach($rows as $row):
                    $img = $row['image'] ?: 'assets/images/produk/placeholder.png';
                    if (strpos($img, 'uploads/') !== 0) $img = $base . '/' . $img;
                ?>
                <div class="col-md-4 mb-4 fade-in">
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($img) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($row['description'],0,120)) ?><?= strlen($row['description'])>120? '...':'' ?></p>
                            <p class="text-primary fw-bold">Rp <?= number_format($row['price'],0,',','.') ?></p>
                            <div class="d-flex gap-2">
                                <a class="btn btn-primary" href="order.php?product=<?= urlencode($row['name']) ?>">Pesan Sekarang</a>
                                <a class="btn btn-outline-secondary" href="product.php?slug=<?= urlencode($row['slug']) ?>">Detail Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
