@extends('partials.template')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Row: Info Cards -->
<div class="row">

    <!-- Total Pasien -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Pasien</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPatients }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-injured fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kunjungan Bulan Ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Kunjungan Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $monthlyVisits }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hospital-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-12">
        <!-- Chart Kunjungan Per Bulan -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kunjungan Pasien per Bulan ({{ date('Y') }})</h6>
            </div>
            <div class="card-body">
                <canvas id="kunjunganChart" height="100"></canvas>
            </div>
        </div>

    </div>
</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('kunjunganChart').getContext('2d');
    const kunjunganChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($bulan) !!}, // ex: ['Jan', 'Feb', ...]
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: {!! json_encode($jumlahKunjungan) !!}, // ex: [5, 8, 10, ...]
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3,
                pointRadius: 4
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
@endpush
