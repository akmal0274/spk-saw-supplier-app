<div class="col-md-12">
    <h2 class="mt-4 text-gray-900 align-middle text-center">Selamat Datang di Sistem Pendukung Keputusan Menggunakan Metode SAW Pemilihan Supplier Kain Terbaik</h2>
    <hr class="sidebar-divider my-2">
    <div class="row">
        <!-- Total User -->
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <i class="fas fa-users fa-2x float-left"></i>
                    <div class="float-right text-right">
                        <h5>Total User</h5>
                        <h3><?= count($data['user']) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Supplier -->
        <div class="col-md-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <i class="fas fa-list fa-2x float-left"></i>
                    <div class="float-right text-right">
                        <h5>Total Supplier</h5>
                        <h3><?= count($data['supplier']) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kriteria -->
        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <i class="fas fa-th-large fa-2x float-left"></i>
                    <div class="float-right text-right">
                        <h5>Total Kriteria</h5>
                        <h3><?= count($data['kriteria']) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Sub Kriteria -->
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <i class="fas fa-chart-line fa-2x float-left"></i>
                    <div class="float-right text-right">
                        <h5>Total Subkriteria</h5>
                        <h3><?= count($data['subkriteria']) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="card mt-4 shadow">
        <div class="card-header bg-secondary text-white">
            Grafik Hasil Perhitungan
        </div>
        <div class="card-body">
            <canvas id="chartHasil"></canvas>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chartHasil').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($ranking, 'nama_supplier')) ?>,
            datasets: [{
                label: 'Perhitungan',
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                data: <?= json_encode(array_column($ranking, 'nilai_akhir')) ?>
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 1 // bisa disesuaikan
                }
            }
        }
    });
</script>
