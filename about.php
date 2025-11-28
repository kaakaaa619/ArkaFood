<?php include 'includes/header.php'; ?>
<?php require_once __DIR__ . '/includes/db.php'; ?>

    <!-- History Section (from settings) -->
    <?php
    $sth = $pdo->prepare('SELECT value FROM settings WHERE `key` = :k LIMIT 1');
    $sth->execute([':k'=>'history']);
    $hist = $sth->fetchColumn();
    $sth->execute([':k'=>'vision']);
    $vision = $sth->fetchColumn();
    $sth->execute([':k'=>'mission']);
    $mission = $sth->fetchColumn();

    $directors = $pdo->query('SELECT name, title, image FROM directors ORDER BY id ASC')->fetchAll();
    ?>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary-color-2);">Sejarah Arka Food</h2>
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in about-image-container d-flex justify-content-center">
                    <img src="<?= $base ?>/assets/images/about.png" alt="Sejarah Arka Food" class="img-fluid rounded">
                </div>
                <div class="col-lg-6 fade-in">
                    <p class="lead"><?= nl2br(htmlspecialchars($hist ?: 'Didirikan pada tahun 2021, Arka Food telah berkomitmen untuk menghadirkan produk makanan berkualitas premium kepada masyarakat Indonesia.')) ?></p>
                </div>
            </div>
        </div>
    </section>
    <!-- Vision Mission Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 fade-in">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title mb-4" style="color: var(--primary-color-2);">Visi</h3>
                            <p class="card-text"><?= nl2br(htmlspecialchars($vision ?: 'Menjadi perusahaan makanan premium terkemuka yang mengutamakan kualitas dan inovasi dalam setiap produknya.')) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 fade-in">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title mb-4" style="color: var(--primary-color-2);">Misi</h3>
                            <ul class="card-text">
                                <?php if($mission):
                                    foreach(explode("\n", $mission) as $m){ if(trim($m)) echo '<li>' . htmlspecialchars($m) . '</li>'; }
                                else: ?>
                                <li>Menghadirkan produk makanan berkualitas tinggi</li>
                                <li>Menerapkan standar keamanan pangan yang ketat</li>
                                <li>Melakukan inovasi berkelanjutan</li>
                                <li>Memberikan pelayanan terbaik kepada pelanggan</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary-color-2);">Direksi Arka Food</h2>
            <div class="row justify-content-center">
                <?php foreach($directors as $d):
                    $dimg = $d['image'] ?: 'assets/images/eka.png'; if(strpos($dimg,'uploads/')!==0) $dimg = $base . '/' . $dimg; ?>
                <div class="col-md-3 mb-4 fade-in">
                    <div class="card text-center">
                        <img src="<?= htmlspecialchars($dimg) ?>" class="card-img-top" alt="<?= htmlspecialchars($d['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($d['name']) ?></h5>
                            <p class="card-text-p"><?= htmlspecialchars($d['title']) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
