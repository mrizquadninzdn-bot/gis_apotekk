<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<div class="content pt-3">
    <div class="container-fluid">
        
        <!-- ========================================== -->
        <!-- INFO BOX APOTEK (BAGIAN ATAS)              -->
        <!-- ========================================== -->
        <div class="row">
            <!-- Total Apotek -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box bg-light border-left border-primary btn-filter-js" data-jenjang="ALL" style="border-left-width: 5px !important; cursor: pointer;">
                    <div class="info-box-content">
                        <span class="info-box-text text-muted text-sm">Total Apotek</span>
                        <span class="info-box-number text-primary text-xl"><?= !empty($apotek) ? count($apotek) : 0 ?></span>
                    </div>
                    <span class="info-box-icon"><i class="fas fa-clinic-medical text-primary"></i></span>
                </div>
            </div>
            
            <!-- Apotek Regular -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box bg-light border-left border-success btn-filter-js" data-jenjang="REGULAR" style="border-left-width: 5px !important; cursor: pointer;">
                    <div class="info-box-content">
                        <span class="info-box-text text-muted text-sm">Apotek Regular</span>
                        <span class="info-box-number text-success text-xl">
                            <?= !empty($apotek) ? count(array_filter($apotek, function($a) { 
                                return (($a['id_jenjang'] ?? '') == 1); 
                            })) : 0 ?>
                        </span>
                    </div>
                    <span class="info-box-icon"><i class="fas fa-door-open text-success"></i></span>
                </div>
            </div>

            <!-- Kimia Farma -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box bg-light border-left border-danger btn-filter-js" data-jenjang="KIMIA FARMA" style="border-left-width: 5px !important; cursor: pointer;">
                    <div class="info-box-content">
                        <span class="info-box-text text-muted text-sm">Kimia Farma</span>
                        <span class="info-box-number text-danger text-xl">
                            <?= !empty($apotek) ? count(array_filter($apotek, function($a) { 
                                return (($a['id_jenjang'] ?? '') == 2); 
                            })) : 0 ?>
                        </span>
                    </div>
                    <span class="info-box-icon"><i class="fas fa-prescription-bottle-alt text-danger"></i></span>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TABEL DATA APOTEK                          -->
        <!-- ========================================== -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header bg-primary py-2 text-white">
                        <h3 class="card-title text-sm m-0">
                            <i class="fas fa-table mr-1"></i>
                            Laporan GIS Fasilitas Kesehatan Apotek | Live Data 
                            <span id="status-filter-aktif" class="badge badge-warning ml-2" style="display:none;"></span>
                        </h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-hover text-nowrap m-0">
                            <thead>
                                <tr class="text-secondary text-sm">
                                    <th width="50px" class="pl-3">No.</th>
                                    <th>Nama Apotek</th>
                                    <th>Status Operasional</th>
                                    <th>Alamat</th>
                                    <th>Koordinat</th>
                                    <th width="100px">Foto</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm" id="body-tabel-sekolah">
                                <?php if (!empty($apotek)): ?>
                                    <?php $no = 1; foreach ($apotek as $row): 
                                        $kategoriSistem = ($row['id_jenjang'] == 2) ? 'KIMIA FARMA' : 'REGULAR';
                                    ?>
                                        <tr class="item-sekolah-row" data-kategori="<?= $kategoriSistem; ?>">
                                            <td class="pl-3 text-muted kolom-nomer"><?= $no++; ?>.</td>
                                            <td class="font-weight-bold text-dark"><?= $row['nama_apotek']; ?></td>
                                            <td>
                                                <?php 
                                                    $badgeColor = ($kategoriSistem == 'KIMIA FARMA') ? 'badge-danger' : 'badge-success';
                                                ?>
                                                <span class="badge <?= $badgeColor ?> px-2 py-1"><?= ($kategoriSistem == 'KIMIA FARMA') ? 'Kimia Farma' : 'Regular'; ?></span>
                                            </td>
                                            <td class="text-muted text-wrap" style="max-width: 250px;"><?= $row['alamat'] ?? 'Alamat belum diisi'; ?></td>
                                            <td class="text-primary text-xs font-mono">
                                                <?php if(!empty($row['latitude']) && !empty($row['longitude'])): ?>
                                                    <i class="fas fa-map-marker-alt text-danger mr-1"></i> <?= $row['latitude'] ?>, <?= $row['longitude'] ?>
                                                <?php else: ?>
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Koordinat belum diisi</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($row['foto'])): ?>
                                                    <a href="<?= base_url('foto/' . $row['foto']); ?>" target="_blank">
                                                        <img src="<?= base_url('foto/' . $row['foto']); ?>" class="img-thumbnail" style="max-height: 40px; min-width: 50px; object-fit: cover;" alt="Foto Apotek">
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted text-xs">-</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center p-4 text-muted">Belum ada data apotek yang tersimpan di database.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- CHART & MAP                                -->
        <!-- ========================================== -->
        <div class="row mt-3">
            <div class="col-md-6 d-flex align-items-stretch">
                <div class="card card-primary card-outline w-100">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Grafik Status Operasional Apotek
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="chart" style="height: 100%;">
                            <canvas id="chartSekolah" style="min-height: 380px; height: 380px; max-height: 380px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex align-items-stretch">
                <div class="card card-primary card-outline w-100">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-map-marked-alt mr-1"></i>
                            Peta Sebaran Lokasi Apotek
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div id="mapDashboard" style="height: 422px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dataApotekRaw = <?= !empty($apotek) ? json_encode($apotek) : '[]'; ?>;
        
        // Hitung Kategori Berdasarkan id_jenjang
        const hitungKategori = { 'REGULAR': 0, 'KIMIA FARMA': 0 };
        dataApotekRaw.forEach(item => {
            const kat = (parseInt(item.id_jenjang) === 2) ? 'KIMIA FARMA' : 'REGULAR';
            if (hitungKategori[kat] !== undefined) {
                hitungKategori[kat]++;
            }
        });

        const labelJenjang = Object.keys(hitungKategori);
        const dataGrafik = Object.values(hitungKategori);
        let listMarkers = [];

        // ==========================================
        // RENDER CHART.JS
        // ==========================================
        let myChart;
        try {
            const ctx = document.getElementById('chartSekolah').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelJenjang,
                    datasets: [{
                        label: 'Jumlah Apotek',
                        data: dataGrafik,
                        backgroundColor: ['rgba(40, 167, 69, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                        borderColor: ['rgba(40, 167, 69, 1)', 'rgba(255, 99, 132, 1)'],
                        borderWidth: 1.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1, precision: 0 } } }
                }
            });
        } catch (e) {
            console.error(e);
        }

        // ==========================================
        // RENDER LEAFLET MAP
        // ==========================================
        let map;
        try {
            let centerLat = -7.258047;
            let centerLng = 109.007685;

            map = L.map('mapDashboard').setView([centerLat, centerLng], 14);

            L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                attribution: 'Google Maps Hybrid'
            }).addTo(map);

        } catch (e) {
            console.error(e);
        }

        // ==========================================
        // DEFINISI CUSTOM MARKER (CARA AMAN & BERHASIL)
        // ==========================================
        // Kita definisikan URL-nya langsung utuh lewat PHP base_url ke folder 'marker' asli lo
        const markerReguler = L.icon({
            iconUrl: '<?= base_url("marker/RegulerR.png"); ?>', 
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

        // Fungsi Pembuat Pin Marker Map
        function updateMapMarkers(filterKey) {
            if (!map) return;
            
            listMarkers.forEach(m => map.removeLayer(m));
            listMarkers = [];

            dataApotekRaw.forEach(function(item) {
                const itemJenjang = (parseInt(item.id_jenjang) === 2) ? 'KIMIA FARMA' : 'REGULAR';

                if (filterKey === 'ALL' || itemJenjang === filterKey) {
                    const lat = parseFloat(item.latitude);
                    const lng = parseFloat(item.longitude);
                    
                    if (!isNaN(lat) && !isNaN(lng)) {
                        
                        // Percabangan langsung memilih object icon yang sudah matang di atas
                        let iconTerpilih = (parseInt(item.id_jenjang) === 2) ? markerKimiaFarma : markerReguler;

                        const marker = L.marker([lat, lng], { icon: iconTerpilih }).addTo(map)
                            .bindPopup('<b>' + item.nama_apotek + '</b><br>Kategori: ' + (itemJenjang === 'KIMIA FARMA' ? 'Kimia Farma' : 'Regular') + '<br><small>' + item.alamat + '</small>');
                        listMarkers.push(marker);
                    }
                }
            });
        }

        // Jalankan pas pertama kali load halaman
        updateMapMarkers('ALL');

        // ==========================================
        // LOGIKA FILTER KLIK INTERAKTIF
        // ==========================================
        const tombolFilter = document.querySelectorAll('.btn-filter-js');
        const barisTabel = document.querySelectorAll('.item-sekolah-row');
        const badgeStatus = document.getElementById('status-filter-aktif');

        tombolFilter.forEach(function(tombol) {
            tombol.addEventListener('click', function() {
                const jenjangTarget = this.getAttribute('data-jenjang').toUpperCase().trim();

                if (badgeStatus) {
                    if (jenjangTarget === 'ALL') {
                        badgeStatus.style.display = 'none';
                    } else {
                        badgeStatus.innerText = 'Filter: ' + (jenjangTarget === 'REGULAR' ? 'Regular' : 'Kimia Farma');
                        badgeStatus.style.display = 'inline-block';
                    }
                }

                let nomorBaru = 1;
                barisTabel.forEach(function(row) {
                    const kategoriRow = row.getAttribute('data-kategori');
                    if (jenjangTarget === 'ALL' || kategoriRow === jenjangTarget) {
                        row.style.display = '';
                        const kolomNo = row.querySelector('.kolom-nomer');
                        if(kolomNo) kolomNo.innerText = nomorBaru++ + '.';
                    } else {
                        row.style.display = 'none';
                    }
                });

                updateMapMarkers(jenjangTarget);

                if (myChart) {
                    if (jenjangTarget === 'ALL') {
                        myChart.data.datasets[0].backgroundColor = ['rgba(40, 167, 69, 0.6)', 'rgba(255, 99, 132, 0.6)'];
                    } else {
                        myChart.data.datasets[0].backgroundColor = labelJenjang.map(lbl => 
                            lbl.toUpperCase() === jenjangTarget ? 'rgba(54, 162, 235, 0.9)' : 'rgba(220, 220, 220, 0.2)'
                        );
                    }
                    myChart.update();
                }
            });
        });
    });
</script>