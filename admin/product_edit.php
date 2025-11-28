<?php
require_once __DIR__ . '/auth.php';
require_login();

$id = $_GET['id'] ?? null;
$product = null;
if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $description = $_POST['description'] ?? null;
    $price = floatval($_POST['price'] ?? 0);
    $is_visible = isset($_POST['is_visible']) ? 1 : 0;

    if (empty($name) || empty($slug)) {
        $error = 'Nama dan slug harus diisi.';
    } else {
        // handle upload
        $imagePath = $product['image'] ?? '';
        if (!empty($_FILES['image']['name'])) {
            $uploaddir = __DIR__ . '/../uploads/products/';
            if (!is_dir($uploaddir)) mkdir($uploaddir, 0755, true);
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('p_', true) . '.' . $ext;
            $dest = $uploaddir . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                $imagePath = 'uploads/products/' . $filename;
            }
        }

        if (!empty($id)) {
            $stmt = $pdo->prepare('UPDATE products SET name=:name, slug=:slug, description=:desc, price=:price, image=:img, is_visible=:vis WHERE id=:id');
            $stmt->execute([':name'=>$name,':slug'=>$slug,':desc'=>$description,':price'=>$price,':img'=>$imagePath,':vis'=>$is_visible,':id'=>$id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO products (name, slug, description, price, image, is_visible) VALUES (:name,:slug,:desc,:price,:img,:vis)');
            $stmt->execute([':name'=>$name,':slug'=>$slug,':desc'=>$description,':price'=>$price,':img'=>$imagePath,':vis'=>$is_visible]);
        }
        header('Location: products.php');
        exit;
    }
}

?>
<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><?= $product ? 'Edit Produk' : 'Tambah Produk' ?></h3>
        <div>
            <a href="products.php" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>

    <?php if($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Slug (url)</label>
            <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($product['slug'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($product['price'] ?? 0) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <?php if(!empty($product['image'])): ?>
                <div class="mb-2"><img src="<?= htmlspecialchars($product['image']) ?>" style="max-width:150px"></div>
            <?php endif; ?>
            <input type="file" name="image" accept="image/*" class="form-control">
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="is_visible" class="form-check-input" id="is_visible" <?= (!isset($product['is_visible']) || $product['is_visible']) ? 'checked' : '' ?> >
            <label class="form-check-label" for="is_visible">Tampilkan di website</label>
        </div>
        <button class="btn btn-primary" type="submit">Simpan</button>
    </form>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
