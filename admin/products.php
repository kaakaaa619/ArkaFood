<?php
require_once __DIR__ . '/auth.php';
require_login();

$products = $pdo->query('SELECT * FROM products ORDER BY created_at DESC')->fetchAll();

?>
<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Produk</h3>
        <div>
            <a href="product_edit.php" class="btn btn-primary">Tambah Produk</a>
            <a href="dashboard.php" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Ditampilkan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td style="width:100px;"><img src="<?= htmlspecialchars($p['image'] ?: 'assets/images/placeholder.png') ?>" style="max-width:80px; height:auto;" /></td>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td>Rp <?= number_format($p['price'],0,',','.') ?></td>
                <td><?= (isset($p['is_visible']) && !$p['is_visible']) ? 'Tidak' : 'Ya' ?></td>
                <td>
                    <a href="product_edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a href="product_delete.php?id=<?= $p['id'] ?>&token=<?= urlencode(generate_csrf_token()) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus produk?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
