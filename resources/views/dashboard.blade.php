@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4 fw-bold text-primary">
        📊 Dashboard Global Supply Chain Monitoring
    </h2>

    <div class="row">

        <!-- Shipment -->
        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <h5>📦 Shipment</h5>
                    <h1 class="text-primary">{{ $totalShipment }}</h1>
                    <small>Total Pengiriman</small>
                </div>
            </div>
        </div>

        <!-- Negara -->
        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <h5>🌍 Negara</h5>
                    <h1 class="text-success">{{ $jumlahNegara }}</h1>
                    <small>REST Countries API</small>
                </div>
            </div>
        </div>

        <!-- Berita -->
        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <h5>📰 Berita</h5>
                    <h1 class="text-warning">{{ $jumlahBerita }}</h1>
                    <small>GNews API</small>
                </div>
            </div>
        </div>

        <!-- Risiko -->
        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <h5>⚠ Risiko Tinggi</h5>
                    <h1 class="text-danger">{{ $risikoTinggi }}</h1>
                    <small>Risk Monitoring</small>
                </div>
            </div>
        </div>

    </div>

    <!-- Grafik Kurs -->
    <div class="card shadow border-0 mt-4">
        <div class="card-header bg-primary text-white">
            📈 Grafik Kurs Mata Uang
        </div>

        <div class="card-body">
            <canvas id="kursChart" height="100"></canvas>
        </div>
    </div>

    <!-- Grafik Tambahan -->
    <div class="row mt-4">

        <div class="col-md-6 mb-4">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">
                    🌍 GDP Trend
                </div>
                <div class="card-body">
                    <canvas id="gdpChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow border-0">
                <div class="card-header bg-warning">
                    📊 Inflation Trend
                </div>
                <div class="card-body">
                    <canvas id="inflationChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <div class="card shadow border-0">
                <div class="card-header bg-danger text-white">
                    ⚠ Risk Trend
                </div>
                <div class="card-body">
                    <canvas id="riskChart" height="120"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- Status -->
    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-success text-white">
            📋 Status Dashboard
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="40%">📦 Total Shipment</th>
                    <td>{{ $totalShipment }}</td>
                </tr>

                <tr>
                    <th>🌍 Negara</th>
                    <td>{{ $jumlahNegara }}</td>
                </tr>

                <tr>
                    <th>📰 Berita</th>
                    <td>{{ $jumlahBerita }}</td>
                </tr>

                <tr>
                    <th>⚠ Risiko Tinggi</th>
                    <td>{{ $risikoTinggi }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

// =================== Kurs ===================

const ctx = document.getElementById('kursChart');

new Chart(ctx,{
    type:'line',
    data:{
        labels:['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
        datasets:[{
            label:'USD ke IDR',
            data:[
                {{ $kursHariIni - 50 }},
                {{ $kursHariIni - 30 }},
                {{ $kursHariIni - 20 }},
                {{ $kursHariIni - 10 }},
                {{ $kursHariIni }},
                {{ $kursHariIni + 20 }},
                {{ $kursHariIni }}
            ],
            borderColor:'blue',
            backgroundColor:'rgba(54,162,235,.2)',
            fill:true,
            tension:.4
        }]
    },
    options:{
        responsive:true,
        maintainAspectRatio:false
    }
});

// =================== GDP ===================

new Chart(document.getElementById('gdpChart'),{
    type:'bar',
    data:{
        labels:{!! json_encode($dashboardData['gdpLabels']) !!},
        datasets:[{
            label:'GDP (USD)',
            data:{!! json_encode($dashboardData['gdpData']) !!},
            backgroundColor:'#198754'
        }]
    },
    options:{
        responsive:true
    }
});

// =================== Inflation ===================

new Chart(document.getElementById('inflationChart'),{
    type:'bar',
    data:{
        labels:{!! json_encode($dashboardData['inflationLabels']) !!},
        datasets:[{
            label:'Inflation (%)',
            data:{!! json_encode($dashboardData['inflationData']) !!},
            borderColor:'#ffc107',
            backgroundColor:'#ffc107',
            fill:true
        }]
    },
    options:{
        responsive:true
    }
});

// =================== Risk ===================

new Chart(document.getElementById('riskChart'),{
    type:'bar',
    data:{
        labels:{!! json_encode($dashboardData['riskLabels']) !!},
        datasets:[{
            label:'Risk Score',
            data:{!! json_encode($dashboardData['riskData']) !!},
            borderColor:'#dc3545',
            backgroundColor:'#dc3545',
            fill:true
        }]
    },
    options:{
        responsive:true
    }
});

</script>

@endsection