<?php
// Minimal admin header. Assumes admin pages require auth.php before including this.
$base = $base ?? '/arkafood';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Arka Food</title>
    <link rel="icon" href="<?= $base ?>/assets/images/icon/iconmark.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg admin-nav">
  <div class="container-fluid">
    <!-- <a class="navbar-brand text-white" href="dashboard.php">Arka Admin</a> -->
    <a class="navbar-brand" href="<?= $base ?>/index.php">
                <img src="<?= $base ?>/assets/images/logo3.png" alt="Arka Food Logo" height="60"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav" aria-controls="adminNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="products.php">Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="news.php">Berita</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">Tentang</a></li>
      </ul>
      <div class="d-flex">
        <?php if(!empty($_SESSION['admin_id'])): ?>
            <a href="logout.php" class="btn btn-sm btn-outline-light">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-sm btn-outline-light">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<div class="admin-container container-fluid">
