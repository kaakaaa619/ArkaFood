<?php
require_once __DIR__ . '/auth.php';
require_login();

$news = $pdo->query('SELECT * FROM news ORDER BY published_at DESC')->fetchAll();

?>
<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Berita</h3>
        <div>
            <a href="news_edit.php" class="btn btn-primary">Tambah Berita</a>
            <a href="dashboard.php" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($news as $n): ?>
            <tr>
                <td><?= $n['id'] ?></td>
                <td><?= htmlspecialchars($n['title']) ?></td>
                <td><?= $n['published_at'] ?></td>
                <td>
                    <a href="news_edit.php?id=<?= $n['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a href="news_delete.php?id=<?= $n['id'] ?>&token=<?= urlencode(generate_csrf_token()) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus berita?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
