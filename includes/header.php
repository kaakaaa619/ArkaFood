<?php
// Base URL for assets (adjust if project is served from a different folder)
$base = '/arkafood';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arka Food - Produk Makanan Premium</title>
    <link rel="icon" href="<?= $base ?>/assets/images/icon/iconmark.svg" type="image/svg+xml">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= $base ?>/assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= $base ?>/index.php">
                <img src="<?= $base ?>/assets/images/logo3.png" alt="Arka Food Logo" height="60">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#rinaldiNavbarNav" aria-controls="rinaldiNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="rinaldiNavbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/about.php">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/news.php">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/contact.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
