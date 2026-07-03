<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- PEMBUNGKUS LAYOUT ADMINLTE AGAR MELEBAR PROPORSIONAL -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <!-- KOLOM KIRI: GRAFIK APOTEK -->
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar"></i> Grafik Status Apotek
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Wadah Chart.js -->
                        <div style="position: relative; height: 350px; width: 100%;">
                            <canvas id="canvasApotek"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: PETA SEBARAN -->
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-map-marked-alt"></i> Peta Sebaran Lokasi Apotek
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- ID wadah Leaflet Map -->
                        <div id="map" style="height: 350px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ========================================================== -->
<!-- SCRIPT 1: GRAFIK APOTEK (CHART.JS)                         -->
<!-- ========================================================== -->
<script>
    const dataLabels = <?= $json_labels; ?>; 
    const dataJumlah = <?= $json_datasets; ?>; 

    const ctx = document.getElementById('canvasApotek').getContext('2d');
    new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: dataLabels,
            datasets: [{
                label: 'Jumlah Apotek',
                data: dataJumlah,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)', // Biru muda
                    'rgba(255, 99, 132, 0.7)', // Pink/Merah muda
                    'rgba(75, 192, 192, 0.7)', // Hijau Toska
                    'rgba(255, 206, 86, 0.7)'  // Kuning
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1,
                barPercentage: 0.5 
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { 
                        stepSize: 1 
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top', 
                }
            }
        }
    });
</script>

<!-- ========================================================== -->
<!-- SCRIPT 2: PETA SEBARAN (LEAFLET.JS)                        -->
<!-- ========================================================== -->
<script>
    // 1. Alternatif OpenStreetMap Standar
    var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    // 2. Alternatif SATELIT dari Esri
    var peta2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    });

    // 3. Alternatif Peta Jalanan Ringan (CartoDB Positron)
    var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
    });

    // 4. Alternatif Mode Gelap/Malam (CartoDB Dark Matter)
    var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
    });

    // Inisialisasi Peta Utama
    const map = L.map('map', {
        center: [<?= $web['coordinat_kota'] ?>],
        zoom: <?= $web['zoom_view'] ?>,
        layers: [peta3]
    });

    const baseMaps = {
        'OpenStreetMap': peta1,
        'Satelite': peta2,
        'Streets': peta3,
        'Night': peta4
    };

    var layerControl = L.control.layers(baseMaps).addTo(map);

    // Render Poligon Wilayah dari Database GeoJSON
    <?php foreach ($wilayah as $key => $value) { ?>
        L.geoJSON(<?= $value['geojson'] ?>, {
            fillColor: '<?= $value['warna'] ?>',
            fillOpacity: 0.7,
            color: '<?= $value['warna'] ?>',
            weight: 1
        })
        .bindPopup("<b><?= $value['nama_wilayah'] ?></b>")
        .addTo(map);
    <?php } ?>

    // Render Marker Pin Titik Lokasi Apotek secara Live
    <?php foreach ($apotek as $key => $val) { ?>
        L.marker([<?= $val['latitude'] ?>, <?= $val['longitude'] ?>])
        .bindPopup("<b><?= $val['nama_apotek'] ?></b><br><?= $val['alamat'] ?>")
        .addTo(map);
    <?php } ?>
</script>