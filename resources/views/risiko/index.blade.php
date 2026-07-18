@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4 text-danger fw-bold">
        ⚠ Global Supply Chain Risk Monitoring
    </h2>

    <p class="text-muted">
        Monitoring risiko berdasarkan data API Cuaca, Kurs, Berita, dan Tracking.
    </p>

    <div class="row">

        <!-- Cuaca -->
        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">

                    <h5>🌦 Cuaca</h5>

                    <h3>{{ $angin }} km/jam</h3>

                    <small>Open-Meteo API</small>

                    <hr>

                    <span class="badge @if($cuacaStatus=='Tinggi') bg-danger @elseif($cuacaStatus=='Sedang') bg-warning text-dark @else bg-success @endif">
                        {{ $cuacaStatus }}
                    </span>

                </div>
            </div>
        </div>

        <!-- Kurs -->
        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">

                    <h5>💰 Kurs</h5>

                    <h3>{{ number_format($idr,2) }}</h3>

                    <small>Exchange Rate API</small>

                    <hr>

                    <span class="badge @if($kursStatus=='Tinggi') bg-danger @elseif($kursStatus=='Sedang') bg-warning text-dark @else bg-success @endif">
                        {{ $kursStatus }}
                    </span>

                </div>
            </div>
        </div>

        <!-- Berita -->
        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">

                    <h5>📰 Berita</h5>

                    <h3>{{ $jumlahBerita }}</h3>

                    <small>News API</small>

                    <hr>

                    <span class="badge @if($beritaStatus=='Tinggi') bg-danger @elseif($beritaStatus=='Sedang') bg-warning text-dark @else bg-success @endif">
                        {{ $beritaStatus }}
                    </span>

                </div>
            </div>
        </div>

        <!-- Tracking -->
        <div class="col-md-3 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">

                    <h5>🚢 Tracking</h5>

                    <h3>On The Way</h3>

                    <small>Shipment</small>

                    <hr>

                    <span class="badge @if($trackingStatus=='Tinggi') bg-danger @elseif($trackingStatus=='Sedang') bg-warning text-dark @else bg-success @endif">
                        {{ $trackingStatus }}
                    </span>

                </div>
            </div>
        </div>

    </div>

    <div class="card shadow mt-4">

        <div class="card-header bg-danger text-white">

            📊 Overall Risk Assessment

        </div>

        <div class="card-body text-center">

            @if($overall=="Tinggi")

                <h2 class="text-danger">
                    🔴 {{ $overall }}
                </h2>

            @elseif($overall=="Sedang")

                <h2 class="text-warning">
                    🟡 {{ $overall }}
                </h2>

            @else

                <h2 class="text-success">
                    🟢 {{ $overall }}
                </h2>

            @endif

            <hr>

            <p>
                Hasil analisis diperoleh dari integrasi Open-Meteo API,
                Exchange Rate API, News API, dan data Tracking Shipment.
            </p>

        </div>

    </div>

</div>

@endsection