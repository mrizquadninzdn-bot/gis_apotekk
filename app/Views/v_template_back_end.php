
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GIS Apotek | <?= $judul ?></title>

  <!-- Google Fonts: senada dengan halaman Login -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE')?>/plugins/fontawesome-free/css/all.min.css">

<!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE')?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE')?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE')?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE')?>/dist/css/adminlte.min.css">
  <!-- Tema Terpadu WebGIS Apotek (Navy/Teal, senada halaman Login) -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE')?>/dist/css/theme-webgis.css">

    <!-- leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>



<!-- jQuery -->
<script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('AdminLTE') ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- DataTables  & Plugins -->
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url('AdminLTE')?>/dist/js/adminlte.min.js"></script>
<style>
  /* 1. Setel lebar utama sidebar */
  .main-sidebar, 
  .main-sidebar::before {
    width: 290px !important;
  }
  .content-wrapper, 
  .main-footer, 
  .main-header {
    margin-left: 290px !important;
  }

  /* 2. Beri jarak atas-bawah (padding) agar menu tidak dempet */
  .nav-sidebar .nav-item .nav-link {
    padding-top: 15px !important;    /* Default bawaan AdminLTE sangat tipis */
    padding-bottom: 12px !important; /* Diubah ke 12px agar lebih tinggi dan luas */
    margin-bottom: 6px !important;   /* Menambah jarak antar baris menu */
  }

  /* 3. Beri jarak sedikit antara Icon dan Teks Menu agar proporsional */
  .nav-sidebar .nav-link p {
    margin-left: 8px !important;
  }
</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url() ?>" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('/#kontak') ?>" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      

      
      
      
      <li class="nav-item">
        <a href="<?= base_url('Auth/Logout') ?>" class="nav-link" style="color:var(--coral-500)!important; font-weight:600;">
            <i class="fas fa-sign-out-alt"></i> Log Out
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Admin') ?>" class="brand-link" style="display:flex; align-items:center; gap:10px;">
      <span style="width:34px; height:34px; border-radius:9px; background:var(--teal-400); display:flex; align-items:center; justify-content:center; flex-shrink:0; box-shadow:0 0 0 4px rgba(45,212,191,0.12);">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 2 L12 22 M2 12 L22 12" stroke="#0b1420" stroke-width="3" stroke-linecap="round"/></svg>
      </span>
      <span class="brand-text" style="font-weight:600;">WebGIS <span style="color:var(--teal-300);">Apotek</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
  <div class="image">
    <!-- Ukuran foto dinaikkan ke 45px dan diberi object-fit agar tidak gepeng -->
    <img src="<?= base_url('foto/' . session()->get('foto')) ?>" 
         class="img-circle elevation-2" 
         style="width: 45px; height: 45px; object-fit: cover; object-position: center;" 
         alt="User Image">
  </div>
  <div class="info pl-3">
    <!-- Ukuran font diperbesar ke 16px dan dibuat sedikit tebal -->
    <a href="#" class="d-block font-weight-bold" style="font-size: 16px; line-height: 1.2;">
      <?= session()->get('nama_user') ?>
    </a>
  </div>
</div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="<?= base_url('Admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('Wilayah') ?>" class="nav-link">
              <i class="nav-icon fas fa-map-marked-alt"></i>
              <p>
                Wilayah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Jenjang') ?>" class="nav-link">
              <i class="nav-icon fas fa-swimming-pool"></i>
              <p>
                Jenjang
              </p>
            </a>
          </li>
          <li class="nav-item">
              <a href="<?= base_url('Apotek') ?>" class="nav-link">
                  <i class="nav-icon fas fa-hospital"></i>
                  <p>Apotek</p>
              </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('index.php/Admin/Setting') ?>" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Setting
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?= base_url('User') ?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $judul ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $judul ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT UTAMA (Ini yang wajib membungkus view dashboard agar melebar) -->
    <section class="content">
        <div class="container-fluid">
            
            <!-- Halaman v_dashboard.php akan dirender di sini -->
            <?php if ($page) {
                echo view($page);
            } ?>

        </div>
    </section>

</div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      WebGIS Apotek Admin Panel
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url() ?>">WebGIS Apotek</a>.</strong> Seluruh hak cipta dilindungi.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

</body>
</html>
