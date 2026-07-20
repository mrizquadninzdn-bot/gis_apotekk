<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GIS Apotek | <?= $judul ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE')?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE')?>/dist/css/adminlte.min.css">

  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="<?= base_url() ?>" class="navbar-brand">
        <img src="<?= base_url('AdminLTE')?>/dist/img/LogoGisApotek.jpeg" class="me-2" height="50px" style="width: auto; object-fit: contain;">
      </a>
      <h5><b>GIS APOTEK </b></h5>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?= base_url() ?>" class="nav-link"><i class="fas fa-home"></i> Home</a>
          </li>

          <!-- DROPDOWN: TENTANG KAMI -->
          <li class="nav-item dropdown">
            <a id="dropdownTentang" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
              <i class="fas fa-info-circle"></i> Tentang Kami
            </a>
            <ul aria-labelledby="dropdownTentang" class="dropdown-menu border-0 shadow" style="min-width: 300px;">
              <!-- Item 1: Info Aplikasi -->
              <li class="p-3">
                <h6 class="text-primary font-weight-bold mb-1"><i class="fas fa-map-marker-alt"></i> GIS Apotek Brebes Tegal</h6>
                <p class="text-muted small mb-0" style="white-space: normal; line-height: 1.4;">
                  Berisi informasi lokasi Apotek di Wilayah Brebes Selatan.
                </p>
              </li>
              <li class="dropdown-divider m-0"></li>
              
              <!-- Item 2: Tim Kami -->
              <li class="p-3">
                <h6 class="text-success font-weight-bold mb-1"><i class="fas fa-users"></i> Tim Kami</h6>
                <p class="text-muted small mb-0" style="white-space: normal; line-height: 1.4;">
                  Terdiri dari 3 Mahasiswa Informatika.
                </p>
              </li>
              <li class="dropdown-divider m-0"></li>
              
              <!-- Item 3: Feedback -->
              <li>
                <a href="#" class="dropdown-item p-3 text-warning font-weight-bold" data-toggle="modal" data-target="#modalFeedback">
                  <i class="fas fa-comments"></i> Feedback
                </a>
              </li>
            </ul>
          </li>
          
          <!-- DROPDOWN 1: WILAYAH DINAMIS -->
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
              <i class="fas fa-map-marked-alt"></i> Semua Wilayah
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li>
                <a href="#" class="dropdown-item filter-wilayah-reset">
                  <strong>Tampilkan Semua Wilayah</strong>
                </a>
              </li>
              <li class="dropdown-divider"></li>
              
              <!-- Looping otomatis dari tabel wilayah -->
              <?php foreach ($wilayah as $key => $w) { ?>
                <li>
                  <a href="#" class="dropdown-item filter-wilayah" data-nama="<?= $w['nama_wilayah'] ?>">
                    <i class="fas fa-map-marker-alt text-primary"></i> <?= $w['nama_wilayah'] ?>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>

          <!-- DROPDOWN 2: STATUS APOTEK -->
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
              <i class="fas fa-hospital"></i> Semua Status
            </a>
            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
              <li>
                <a href="#" class="dropdown-item filter-status-reset">
                  <strong>Tampilkan Semua Status</strong>
                </a>
              </li>
              <li class="dropdown-divider"></li>
              <li>
                <a href="#" class="dropdown-item filter-status" data-status="Swasta">
                  <i class="fas fa-circle text-info"></i> Apotek Swasta
                </a>
              </li>
              <li>
                <a href="#" class="dropdown-item filter-status" data-status="Negeri">
                  <i class="fas fa-circle text-danger"></i> Apotek Negeri
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('Auth/Logout') ?>">
             <i class="fas fa-sign-in-alt"></i> Login
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <?php
            if ($page){
              echo view($page);
             }
           ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Apotek GIS System
    </div>
    <strong>Copyright &copy; 2026 <a href="#">GIS Apotek</a>.</strong> All rights reserved.
  </footer>
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url('AdminLTE')?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('AdminLTE')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('AdminLTE')?>/dist/js/adminlte.min.js"></script>

<!-- JAVASCRIPT FILTER PETA INTERAKTIF + RE-DEFINISI CUSTOM MARKER GLOBAL -->
<script>
  // ==========================================
  // DEFINISI GLOBAL CUSTOM MARKER (DI SINI TEMPATNYA)
  // ==========================================
  const markerReguler = L.icon({
      iconUrl: '<?= base_url("marker/Regulerr.png"); ?>', 
      iconSize: [40, 50], 
      iconAnchor: [20, 50], 
      popupAnchor: [0, -45] 
  });

  const markerKimiaFarma = L.icon({
      iconUrl: '<?= base_url("marker/Kimia_Farma.png"); ?>', 
      iconSize: [40, 50], 
      iconAnchor: [20, 50], 
      popupAnchor: [0, -45] 
  });

  $(document).ready(function() {
    
    // ==========================================
    // 1. FILTER DROPDOWN WILAYAH
    // ==========================================
    $('.filter-wilayah').on('click', function(e) {
      e.preventDefault();
      var namaKecamatan = $(this).data('nama');
      
      if (typeof map !== 'undefined') {
        map.closePopup();

        map.eachLayer(function(layer) {
          if (layer.setStyle && layer.getPopup && layer.getPopup()) {
            var isiPopup = layer.getPopup().getContent();
            
            if (isiPopup.includes(namaKecamatan)) {
              layer.setStyle({
                fillOpacity: 0.5, 
                opacity: 1,       
                weight: 2
              });
              
              layer.openPopup();
              if (layer.getBounds) {
                map.fitBounds(layer.getBounds().pad(0.1));
              }
            } else {
              layer.setStyle({
                fillOpacity: 0, 
                opacity: 0,
                weight: 0
              });
            }
          }
        });
      }
    });

    // Reset Filter Wilayah
    $('.filter-wilayah-reset').on('click', function(e) {
      e.preventDefault();
      
      if (typeof map !== 'undefined') {
        map.eachLayer(function(layer) {
          if (layer.setStyle && layer.getPopup) {
            layer.setStyle({
              fillOpacity: 0.4, 
              opacity: 1,
              weight: 1
            });
          }
        });

        if (typeof markerGroup !== 'undefined' && markerGroup.getLayers().length > 0) {
          map.fitBounds(markerGroup.getBounds().pad(0.2));
        } else if (typeof koordinatKota !== 'undefined' && typeof zoomView !== 'undefined') {
          map.setView(koordinatKota, zoomView);
        }
      }
    });

    // ==========================================
    // 2. FILTER DROPDOWN STATUS
    // ==========================================
    $('.filter-status').on('click', function(e) {
      e.preventDefault();
      var statusDipilih = $(this).data('status');

      if (typeof map !== 'undefined') {
        map.closePopup();

        map.eachLayer(function(layer) {
          if (layer instanceof L.Marker) {
            if (layer.getPopup && layer.getPopup()) {
              var isiPopup = layer.getPopup().getContent();
              
              if (isiPopup.includes("Status: " + statusDipilih)) {
                layer.setOpacity(1); 
              } else {
                layer.setOpacity(0.1); 
              }
            }
          }
        });
      }
    });

    $('.filter-status-reset').on('click', function(e) {
      e.preventDefault();
      if (typeof map !== 'undefined') {
        map.eachLayer(function(layer) {
          if (layer instanceof L.Marker) {
            layer.setOpacity(1); 
          }
        });
      }
    });

  });
</script>

<!-- MODAL BOX FORM FEEDBACK -->
<div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel" aria-hidden="true" style="z-index: 9999;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title font-weight-bold" id="feedbackModalLabel">
          <i class="fas fa-comments"></i> Kirim Feedback Anda
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('home/kirim_feedback') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
          </div>
          <div class="form-group">
            <label>Kontak / No. HP</label>
            <input type="text" name="kontak" class="form-control" placeholder="Contoh: 081234567xxx" required>
          </div>
          <div class="form-group">
            <label>Pesan / Saran</label>
            <textarea name="pesan" class="form-control" rows="4" placeholder="Tuliskan kritik atau saran Anda mengenai sistem ini..." required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning font-weight-bold">Kirim Feedback</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- SCRIPT JAVASCRIPT NOTIFIKASI FLASHDATA -->
<?php if (session()->getFlashdata('sukses')) : ?>
  <script>
    alert("<?= session()->getFlashdata('sukses'); ?>");
  </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
  <script>
    alert("Gagal mengirim feedback:\n<?= strip_tags(session()->getFlashdata('error')); ?>");
  </script>
<?php endif; ?>

</body>
</html>