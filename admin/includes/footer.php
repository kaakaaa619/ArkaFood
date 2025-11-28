<?php
$base = $base ?? '/arkafood';
?>

</div> <!-- /.admin-container -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// small helper: confirm deletion links with data-confirm
document.addEventListener('click', function(e){
  const t = e.target.closest('[data-confirm]');
  if(t){
    if(!confirm(t.getAttribute('data-confirm'))){ e.preventDefault(); }
  }
});
</script>


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-2 mb-2 fade-in">
                    <div class="d-flex align-items-start">
                        <img src="<?= $base ?>/assets/images/logo2.png" alt="Arka Food Logo" class="img-fluid footer-logo me-3">
                    </div>
                </div>
                <div class="col-md-10 mb-2 fade-in">
                  <div class="d-flex align-items-start justify-content-left">
                    <p class="mb-0">WEBSITE BY <a href="https://www.instagram.com/rinaldisatia/" style="text-decoration: none;">RINALDI SATIA</a> &copy; 2025 ARKA FOOD.</p>
                    <div>Logged in as: <?php if(!empty($_SESSION['admin_id'])) echo 'Admin #' . intval($_SESSION['admin_id']); ?></div>
                   <p style="font-style: italic;"> All rights reserved.</p>
                  </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?= $base ?>/assets/js/main.js"></script>

    <!-- Floating WhatsApp button -->
    <a href="https://wa.me/6282116726900" class="floating-wa-button" target="_blank" rel="noopener">
        <i class="fab fa-whatsapp"></i>
        <span>Hubungi via WhatsApp</span>
    </a>
</body>
</html>
</main>

