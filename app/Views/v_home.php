<div id="map" style="width:100%; height:600px; border-bottom: 3px solid #343a40;"></div>

<!-- FontAwesome untuk Icon jika diperlukan -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
    /* Styling agar tampilan popup custom & rapi seperti web profesional */
    .custom-popup .leaflet-popup-content-wrapper {
        background: #ffffff;
        color: #333;
        border-radius: 8px;
        padding: 5px;
        box-shadow: 0 3px 14px rgba(0,0,0,0.4);
    }
    .custom-popup .leaflet-popup-content {
        margin: 8px 12px;
        line-height: 1.4;
    }
</style>

<script>
    // 1. Pilihan Variasi Basemap Layer
    var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {});
    var peta2 = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {});
    var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {});
    var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {});
    var petaSatelit = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {});

    // Inisialisasi Map Utama
    const map = L.map('map', {
        center: [<?= $web['coordinat_kota'] ?>],
        zoom: <?= $web['zoom_view'] ?>, 
        layers: [peta1] // Default menggunakan openstreetmap standar
    });

    const baseMaps = {
        "Standar OSM": peta1,
        "HOT Map": peta2,
        "Light Mode": peta3,
        "Dark Mode": peta4,
        "Satelit": petaSatelit
    };
    L.control.layers(baseMaps).addTo(map);

    // ==========================================================
    // 2. KUSTOMISASI MARKER ICON (Biar Mirip Gambar 1 Temanmu)
    // ==========================================================
    // Membuat marker pin kustom menggunakan URL icon gratis (warna merah & biru tua)
    var iconSwasta = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var iconNegeri = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // ==========================================================
    // 3. RENDER POLIGON WILAYAH (GEOJSON)
    // ==========================================================
    <?php foreach ($wilayah as $key => $value) { ?>
        L.geoJSON(<?= $value['geojson'] ?>, {
            fillColor: '<?= $value['warna'] ?>',
            fillOpacity: 0.4,
            color: '<?= $value['warna'] ?>',
            weight: 1.5
        })
        .bindPopup("<b>Kecamatan: <?= $value['nama_wilayah'] ?></b>")
        .addTo(map);
    <?php } ?>

    // ==========================================================
    // 4. RENDER MARKER TITIK APOTEK LIVE DARI DATABASE
    // ==========================================================
    // Membuat grup marker kosong untuk menampung semua titik otomatis
    var markerGroup = L.featureGroup();

    <?php foreach ($apotek as $key => $val) { ?>
        <?php if (!empty($val['latitude']) && !empty($val['longitude'])) { ?>
            
            // Tentukan pilihan icon warna secara dinamis berdasarkan status apotek
            var penandaIcon = iconSwasta; 
            <?php if ($val['status'] == 'Negeri') { ?>
                penandaIcon = iconNegeri;
            <?php } ?>

            // Tambahkan marker ke dalam peta & grup pembungkus
            var marker = L.marker([<?= $val['latitude'] ?>, <?= $val['longitude'] ?>], { icon: penandaIcon })
            .bindPopup(`
                <div style="min-width: 220px;" class="custom-popup">
                    <h5 style="margin: 0 0 5px 0; color: #007bff; font-weight:bold;"><?= $val['nama_apotek'] ?></h5>
                    <span style="background-color: <?= ($val['status'] == 'Swasta') ? '#17a2b8' : '#dc3545' ?>; color: white; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; display: inline-block; margin-bottom: 8px;">
                        Status: <?= $val['status'] ?>
                    </span>
                    <?php if (!empty($val['foto'])) { ?>
                        <div style="text-align:center; margin-bottom:8px;">
                            <img src="<?= base_url('foto/' . $val['foto']) ?>" width="100%" style="border-radius: 6px; max-height:120px; object-fit:cover;" alt="Foto Apotek">
                        </div>
                    <?php } ?>
                    <p style="margin: 5px 0 0 0; font-size: 12px; color: #555;"><i class="fas fa-map-marker-alt"></i> <?= $val['alamat'] ?></p>
                </div>
            `);
            
            markerGroup.addLayer(marker);
        <?php } ?>
    <?php } ?>

    // Masukkan semua kumpulan marker ke dalam peta utama
    markerGroup.addTo(map);

    // TRIK JITU: Otomatis memfokuskan layar peta langsung mengarah ke area di mana titik-titik apotek terkumpul!
    if (markerGroup.getLayers().length > 0) {
        map.fitBounds(markerGroup.getBounds().pad(0.2));
    }
</script>