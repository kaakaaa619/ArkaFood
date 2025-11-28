<?php include 'includes/header.php'; ?>
<?php require_once __DIR__ . '/includes/db.php'; ?>

    <style>
        /* small overrides for product detail */
        .product-gallery { position: relative; overflow: hidden; }
        .gallery-track { display:flex; transition: transform 0.35s ease; }
        .gallery-item { min-width:100%; box-sizing:border-box; padding:12px; }
        .gallery-item img { width:100%; height:420px; object-fit:contain; background:#fff; border-radius:8px; }
        .gallery-controls { position:absolute; top:50%; left:0; right:0; transform:translateY(-50%); display:flex; justify-content:space-between; pointer-events:none; }
        .gallery-btn { pointer-events:auto; background:rgba(17,63,103,0.8); color:#fff; border:none; width:44px; height:44px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; }
        .gallery-dots { text-align:center; margin-top:12px; }
        .gallery-dot { width:10px; height:10px; display:inline-block; border-radius:50%; margin:0 6px; background:#ddd; cursor:pointer; }
        .gallery-dot.active { background:var(--primary-color); }
        @media (max-width:576px){ .gallery-item img{ height:240px } }
    </style>

    <?php
    $slug = $_GET['slug'] ?? null;
    $id = $_GET['id'] ?? null;
    if ($slug) {
        $stmt = $pdo->prepare('SELECT * FROM products WHERE slug = :s LIMIT 1');
        $stmt->execute([':s'=>$slug]);
        $product = $stmt->fetch();
    } elseif ($id) {
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id LIMIT 1');
        $stmt->execute([':id'=>$id]);
        $product = $stmt->fetch();
    } else {
        $product = null;
    }
    ?>

    <main class="py-5">
        <div class="container">
            <?php if(!$product): ?>
                <div class="alert alert-warning">Produk tidak ditemukan.</div>
            <?php else:
                $img = $product['image'] ?: 'assets/images/produk/placeholder.png';
                if (strpos($img,'uploads/') !== 0) $img = $base . '/' . $img;
            ?>
            <div class="row">
                <div class="col-lg-6">
                    <h2 id="p-title"><?= htmlspecialchars($product['name']) ?></h2>
                    <p id="p-desc" class="lead text-muted"><?= htmlspecialchars(substr($product['description'],0,200)) ?></p>
                    <p class="fw-bold text-primary" id="p-price">Rp <?= number_format($product['price'],0,',','.') ?></p>
                    <div class="mb-3">
                        <a id="order-link" class="btn btn-primary me-2" href="order.php?product=<?= urlencode($product['name']) ?>">Pesan via WhatsApp</a>
                        <a id="back-to-products" class="btn btn-outline-secondary" href="produk.php">Kembali ke Produk</a>
                    </div>
                    <h5>Detail</h5>
                    <p id="p-full-desc"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                </div>
                <div class="col-lg-6">
                    <div class="product-gallery">
                        <div class="gallery-track" id="galleryTrack">
                            <div class="gallery-item"><img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($product['name']) ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
