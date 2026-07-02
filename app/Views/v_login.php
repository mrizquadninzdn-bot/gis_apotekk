<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk — GIS Apotek</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root{
    --navy-950:#0b1420;
    --navy-900:#0f1c2c;
    --navy-800:#16283b;
    --navy-700:#203a54;
    --teal-400:#2dd4bf;
    --teal-300:#5eead4;
    --coral-500:#ff6b5e;
    --mist-100:#e7edf3;
    --mist-300:#a9bbcc;
    --mist-500:#6d829a;
  }
 
  *{box-sizing:border-box; margin:0; padding:0;}
 
  html,body{height:100%;}
 
  body{
    font-family:'Inter', sans-serif;
    background:var(--navy-950);
    color:var(--mist-100);
    min-height:100vh;
    display:flex;
    overflow:hidden;
  }
 
  /* ---------- Panel kiri: peta kontur ---------- */
  .map-panel{
    position:relative;
    flex:1.15;
    background:
      radial-gradient(circle at 30% 20%, rgba(45,212,191,0.10), transparent 55%),
      var(--navy-900);
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    padding:56px 64px;
    overflow:hidden;
  }
 
  .contour-svg{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    opacity:0.55;
  }
 
  .map-panel::after{
    content:"";
    position:absolute;
    inset:0;
    background:linear-gradient(180deg, transparent 0%, var(--navy-950) 96%);
    pointer-events:none;
  }
 
  .brand{
    position:relative;
    z-index:2;
    display:flex;
    align-items:center;
    gap:12px;
  }
 
  .brand-mark{
    width:38px; height:38px;
    border-radius:9px;
    background:var(--teal-400);
    display:flex; align-items:center; justify-content:center;
    box-shadow:0 0 0 5px rgba(45,212,191,0.12);
  }
 
  .brand-name{
    font-family:'Space Grotesk', sans-serif;
    font-weight:600;
    font-size:17px;
    letter-spacing:0.01em;
  }
  .brand-name span{ color:var(--teal-300); }
 
  .map-hero{
    position:relative;
    z-index:2;
    max-width:420px;
  }
 
  .map-eyebrow{
    font-family:'JetBrains Mono', monospace;
    font-size:12px;
    letter-spacing:0.14em;
    text-transform:uppercase;
    color:var(--teal-300);
    display:flex;
    align-items:center;
    gap:8px;
    margin-bottom:18px;
  }
  .map-eyebrow::before{
    content:"";
    width:7px; height:7px;
    border-radius:50%;
    background:var(--teal-400);
    box-shadow:0 0 0 4px rgba(45,212,191,0.18);
  }
 
  .map-hero h1{
    font-family:'Space Grotesk', sans-serif;
    font-weight:700;
    font-size:38px;
    line-height:1.18;
    letter-spacing:-0.01em;
    margin-bottom:16px;
  }
 
  .map-hero p{
    color:var(--mist-300);
    font-size:15px;
    line-height:1.65;
  }
 
  /* kartu koordinat pin — elemen signature */
  .pin-readout{
    position:relative;
    z-index:2;
    display:flex;
    align-items:center;
    gap:14px;
    padding:16px 18px;
    border-radius:12px;
    background:rgba(15,28,44,0.7);
    border:1px solid var(--navy-700);
    backdrop-filter:blur(6px);
    width:fit-content;
  }
 
  .pin-icon{
    width:34px; height:34px;
    border-radius:50%;
    background:rgba(255,107,94,0.12);
    display:flex; align-items:center; justify-content:center;
    flex-shrink:0;
  }
 
  .pin-readout .meta{ font-family:'JetBrains Mono', monospace; }
  .pin-readout .meta .label{
    font-size:10.5px; letter-spacing:0.08em; text-transform:uppercase;
    color:var(--mist-500); margin-bottom:3px;
  }
  .pin-readout .meta .coords{
    font-size:13.5px; color:var(--mist-100);
  }
 
  /* ---------- Panel kanan: form ---------- */
  .form-panel{
    flex:0.85;
    min-width:420px;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px;
    background:var(--navy-950);
  }
 
  .form-card{
    width:100%;
    max-width:380px;
  }
 
  .form-card h2{
    font-family:'Space Grotesk', sans-serif;
    font-weight:600;
    font-size:26px;
    margin-bottom:8px;
  }
 
  .form-card .sub{
    color:var(--mist-500);
    font-size:14px;
    margin-bottom:32px;
  }
 
  .alert{
    display:flex;
    gap:10px;
    align-items:flex-start;
    background:rgba(255,107,94,0.08);
    border:1px solid rgba(255,107,94,0.35);
    color:#ffb3ab;
    padding:12px 14px;
    border-radius:10px;
    font-size:13.5px;
    line-height:1.5;
    margin-bottom:22px;
  }
 
  .field{ margin-bottom:20px; }
 
  .field label{
    display:block;
    font-size:13px;
    font-weight:500;
    color:var(--mist-300);
    margin-bottom:8px;
  }
 
  .input-wrap{
    position:relative;
    display:flex;
    align-items:center;
  }
 
  .input-wrap svg{
    position:absolute;
    left:14px;
    width:17px; height:17px;
    color:var(--mist-500);
    pointer-events:none;
  }
 
  .input-wrap input{
    width:100%;
    background:var(--navy-900);
    border:1px solid var(--navy-700);
    border-radius:10px;
    padding:12px 14px 12px 42px;
    font-size:14.5px;
    color:var(--mist-100);
    font-family:'Inter', sans-serif;
    transition:border-color .15s ease, box-shadow .15s ease;
  }
 
  .input-wrap input::placeholder{ color:var(--mist-500); }
 
  .input-wrap input:focus{
    outline:none;
    border-color:var(--teal-400);
    box-shadow:0 0 0 3px rgba(45,212,191,0.15);
  }
 
  .toggle-pass{
    position:absolute;
    right:12px;
    background:none;
    border:none;
    cursor:pointer;
    color:var(--mist-500);
    padding:4px;
    display:flex;
  }
  .toggle-pass:hover{ color:var(--teal-300); }
  .toggle-pass svg{ width:17px; height:17px; }
 
  .row-between{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:13px;
    margin-bottom:26px;
  }
 
  .checkbox-remember{
    display:flex;
    align-items:center;
    gap:8px;
    color:var(--mist-300);
    cursor:pointer;
    user-select:none;
  }
  .checkbox-remember input{ accent-color:var(--teal-400); width:14px; height:14px; }
 
  .row-between a{
    color:var(--teal-300);
    text-decoration:none;
  }
  .row-between a:hover{ text-decoration:underline; }
 
  .btn-submit{
    width:100%;
    padding:13px;
    border:none;
    border-radius:10px;
    background:var(--teal-400);
    color:var(--navy-950);
    font-family:'Space Grotesk', sans-serif;
    font-weight:600;
    font-size:15px;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    transition:background .15s ease, transform .1s ease;
  }
  .btn-submit:hover{ background:var(--teal-300); }
  .btn-submit:active{ transform:scale(0.99); }
  .btn-submit svg{ width:16px; height:16px; }
 
  .form-footer{
    text-align:center;
    margin-top:28px;
    font-size:13px;
    color:var(--mist-500);
  }
 
  :focus-visible{
    outline:2px solid var(--teal-400);
    outline-offset:2px;
  }
 
  @media (prefers-reduced-motion: reduce){
    *{ transition:none !important; }
  }
 
  @media (max-width: 900px){
    .map-panel{ display:none; }
    .form-panel{ flex:1; min-width:0; }
  }
</style>
</head>
<body>
 
  <div class="map-panel">
    <svg class="contour-svg" viewBox="0 0 600 800" preserveAspectRatio="xMidYMid slice">
      <g fill="none" stroke="#2dd4bf" stroke-width="1">
        <path opacity="0.10" d="M-50 120 C 100 60, 250 180, 400 100 S 700 40, 850 140"/>
        <path opacity="0.14" d="M-50 200 C 120 140, 260 260, 420 190 S 700 130, 850 230"/>
        <path opacity="0.18" d="M-50 280 C 140 220, 280 340, 430 270 S 700 210, 850 310"/>
        <path opacity="0.14" d="M-50 420 C 100 480, 260 380, 400 450 S 680 520, 850 440"/>
        <path opacity="0.10" d="M-50 500 C 110 560, 270 460, 410 530 S 690 600, 850 520"/>
        <path opacity="0.08" d="M-50 640 C 130 590, 300 690, 450 620 S 700 560, 850 660"/>
      </g>
      <g stroke="#5eead4" stroke-width="1" opacity="0.08">
        <line x1="0" y1="100" x2="600" y2="100"/>
        <line x1="0" y1="300" x2="600" y2="300"/>
        <line x1="0" y1="500" x2="600" y2="500"/>
        <line x1="0" y1="700" x2="600" y2="700"/>
        <line x1="150" y1="0" x2="150" y2="800"/>
        <line x1="300" y1="0" x2="300" y2="800"/>
        <line x1="450" y1="0" x2="450" y2="800"/>
      </g>
      <g fill="#ff6b5e">
        <circle cx="230" cy="260" r="3.5" opacity="0.85"/>
        <circle cx="360" cy="410" r="3.5" opacity="0.85"/>
        <circle cx="180" cy="470" r="3.5" opacity="0.6"/>
        <circle cx="410" cy="180" r="3.5" opacity="0.6"/>
      </g>
    </svg>
 
    <div class="brand">
      <div class="brand-mark">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
          <path d="M12 2 L12 22 M2 12 L22 12" stroke="#0b1420" stroke-width="3" stroke-linecap="round"/>
        </svg>
      </div>
      <div class="brand-name">WebGIS <span>Apotek</span></div>
    </div>
 
    <div class="map-hero">
      <div class="map-eyebrow">Sistem Informasi Geografis</div>
      <h1>Petakan setiap apotek, layani setiap warga.</h1>
      <p>Kelola data sebaran apotek, cari lokasi terdekat, dan pantau ketersediaan layanan farmasi dalam satu peta interaktif.</p>
    </div>
 
    <div class="pin-readout">
      <div class="pin-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M12 21s7-6.2 7-12A7 7 0 1 0 5 9c0 5.8 7 12 7 12Z" stroke="#ff6b5e" stroke-width="1.6"/>
          <circle cx="12" cy="9" r="2.4" stroke="#ff6b5e" stroke-width="1.6"/>
        </svg>
      </div>
      <div class="meta">
        <div class="label">Lokasi terpantau</div>
        <div class="coords">-7.4247° S, 109.2372° E</div>
      </div>
    </div>
  </div>
 
  <div class="form-panel">
    <div class="form-card">
      <h2>Masuk ke akun Anda</h2>
      <p class="sub">Silakan masuk untuk mengakses dashbord WebGIS Apotek.</p>

      <?php 
      $errors = session()->getFlashdata('errors'); 
      if (!empty($errors)) : 
      ?>
      <div class="alert">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="flex-shrink:0; margin-top:1px;">
          <circle cx="12" cy="12" r="9" stroke="#ff6b5e" stroke-width="1.6"/>
          <path d="M12 8v5M12 16h.01" stroke="#ff6b5e" stroke-width="1.6" stroke-linecap="round"/>
        </svg>
        <span>
          <ul style="margin: 0; padding-left: 10px; list-style-type: none;">
          <?php foreach ($errors as $error) : ?>
              <li><?= esc($error) ?></li>
          <?php endforeach ?>
          </ul>
        </span>
      </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="flex-shrink:0; margin-top:1px;">
          <circle cx="12" cy="12" r="9" stroke="#ff6b5e" stroke-width="1.6"/>
          <path d="M12 8v5M12 16h.01" stroke="#ff6b5e" stroke-width="1.6" stroke-linecap="round"/>
        </svg>
        <span><?= session()->getFlashdata('pesan') ?></span>
      </div>
      <?php endif; ?>

      <!-- NOTIFIKASI SUKSES LOGOUT (WARNA HIJAU + ICON CENTANG) -->
      <?php if (session()->getFlashdata('logout')): ?>
      <div class="alert" style="background: rgba(46, 213, 115, 0.08); border: 1px solid rgba(46, 213, 115, 0.35); color: #2ed573; padding: 12px 14px; border-radius: 10px; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
        <!-- Icon Centang Sukses (Green SVG) -->
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="flex-shrink:0;">
          <circle cx="12" cy="12" r="9" stroke="#2ed573" stroke-width="1.6"/>
          <path d="M8 12l3 3 5-5" stroke="#2ed573" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span><?= session()->getFlashdata('logout') ?></span>
      </div>
      <?php endif; ?>
 
      <form action="<?= base_url('Auth/CekLogin') ?>" method="POST" autocomplete="off">
        <div class="field">
          <label for="email">E-Mail</label>
          <div class="input-wrap">
            <svg viewBox="0 0 24 24" fill="none"><path d="M4 20c0-4 3.6-6 8-6s8 2 8 6M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.6"/></svg>
            <input type="email" id="email" name="email" placeholder="masukkan email" required>
          </div>
          <p class="text-danger" style="font-size: 12px; margin-top: 5px; color: var(--coral-500);">
            <?= isset($errors['password']) ? $errors['password'] : '' ?>
          </p>
        </div>
 
        <div class="field">
          <label for="password">Password</label>
          <div class="input-wrap">
            <svg viewBox="0 0 24 24" fill="none"><rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 10V7a4 4 0 1 1 8 0v3" stroke="currentColor" stroke-width="1.6"/></svg>
            <input type="password" id="password" name="password" placeholder="masukkan password" required>
            <button type="button" class="toggle-pass" onclick="togglePassword()" aria-label="Tampilkan kata sandi">
              <svg id="eye-icon" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/></svg>
            </button>
          </div>
        <p class="text-danger" style="font-size: 12px; margin-top: 5px; color: var(--coral-500);">
            <?= isset($errors['password']) ? $errors['password'] : '' ?>
        </p>

        </div>
 
        <div class="row-between">
          <label class="checkbox-remember">
            <input type="checkbox" name="remember">
            Ingat saya
          </label>
          <a href="#">Lupa kata sandi?</a>
        </div>
 
        <button type="submit" class="btn-submit">
          Masuk
          <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <!-- TOMBOL KEMBALI KE HOME -->
        <div style="text-align: center; margin-top: 16px;">
          <a href="<?= base_url('/') ?>" style="color: var(--mist-500); text-decoration: none; font-size: 13.5px; display: inline-flex; align-items: center; gap: 6px; transition: color .15s ease;" onmouseover="this.style.color='var(--teal-300)'" onmouseout="this.style.color='var(--mist-500)'">
            <svg viewBox="0 0 24 24" fill="none" style="width: 15px; height: 15px;"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Kembali ke Halaman Utama
          </a>
        </div>
      </form>
 
      <p class="form-footer">&copy; <?= date('Y') ?> WebGIS Apotek — Seluruh hak cipta dilindungi.</p>
    </div>
  </div>
 
<script>
  function togglePassword(){
    const input = document.getElementById('password');
    const icon = document.getElementById('eye-icon');
    if(input.type === 'password'){
      input.type = 'text';
      icon.innerHTML = '<path d="M3 3l18 18M10.6 10.6a3 3 0 0 0 4.2 4.2M9.9 4.24A10.9 10.9 0 0 1 12 4c7 0 11 7 11 7a17.6 17.6 0 0 1-3.2 4.06M6.6 6.6C3.5 8.6 1 12 1 12s4 7 11 7c1.5 0 2.9-.3 4.1-.8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>';
    } else {
      input.type = 'password';
      icon.innerHTML = '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>';
    }
  }
</script>
 
</body>
</html>