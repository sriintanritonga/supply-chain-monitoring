@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
@endsection

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold text-primary mb-4">
        🌦 Global Weather Monitoring
    </h2>

    <div class="card shadow-lg border-0 mb-4">

        <div class="card-body">

            <form method="GET" action="{{ url('/cuaca') }}">

                <div class="input-group input-group-lg">

                    <input
                        type="text"
                        name="city"
                        class="form-control"
                        placeholder="Cari Kota (Jakarta, Tokyo, London...)"
                        value="{{ request('city') }}">

                    <button class="btn btn-primary">
                        🔍 Cari
                    </button>

                </div>

            </form>

        </div>

    </div>

@if($weather)

<div class="card shadow-lg border-0 mb-4">

    <div class="card-header bg-primary text-white">

        <h4 class="mb-0">

            📍 {{ $city }}, {{ $country }}

        </h4>

        <small>

            Update :
            {{ $weather['current']['time'] }}

        </small>

    </div>

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-3">

                <div class="card text-center shadow border-0">

                    <div class="card-body">

                        <h1>🌡</h1>

                        <h2 class="text-danger">

                            {{ $weather['current']['temperature_2m'] }}°C

                        </h2>

                        <p class="fw-bold">
                            Temperatur
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card text-center shadow border-0">

                    <div class="card-body">

                        <h1>💨</h1>

                        <h2 class="text-primary">

                            {{ $weather['current']['wind_speed_10m'] }}

                        </h2>

                        <p class="fw-bold">
                            km/jam
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card text-center shadow border-0">

                    <div class="card-body">

                        <h1>🌧</h1>

                        <h2 class="text-info">

                            {{ $weather['current']['rain'] ?? 0 }}

                        </h2>

                        <p class="fw-bold">
                            mm Hujan
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card text-center shadow border-0">

                    <div class="card-body">

                        <h1>⚠</h1>

                        @php
                            $wind = $weather['current']['wind_speed_10m'];
                        @endphp

                        @if($wind > 50)

                            <span class="badge bg-danger fs-4">
                                Tinggi
                            </span>

                        @elseif($wind > 25)

                            <span class="badge bg-warning text-dark fs-4">
                                Sedang
                            </span>

                        @else

                            <span class="badge bg-success fs-4">
                                Rendah
                            </span>

                        @endif

                        <p class="mt-2 fw-bold">
                            Risiko Cuaca
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-lg border-0">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">

            🗺 Peta Lokasi

        </h4>

    </div>

    <div class="card-body">

        <div id="map" style="height:550px;border-radius:12px;"></div>

    </div>

</div>

@else

    @if(request()->filled('city'))
        <div class="alert alert-warning text-center rounded-4 shadow-sm mt-4 py-4">
            <h5 class="fw-bold mb-1">⚠️ Kota atau data cuaca untuk "{{ request('city') }}" tidak ditemukan.</h5>
            <p class="mb-0 text-muted">Silakan periksa kembali ejaan nama kota atau coba cari kota besar terdekat.</p>
        </div>
    @endif

@endif

</div>

@endsection

@push('scripts')

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

@if($latitude && $longitude && isset($weather['current']))

<script>

var map = L.map('map').setView([
{{ $latitude }},
{{ $longitude }}
],7);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
    attribution:'© OpenStreetMap'
}).addTo(map);

L.marker([
{{ $latitude }},
{{ $longitude }}
]).addTo(map)
.bindPopup(`
<b>{{ $city }}</b><br>
{{ $country }}<br><br>
🌡 {{ $weather['current']['temperature_2m'] ?? '-' }} °C<br>
💨 {{ $weather['current']['wind_speed_10m'] ?? '-' }} km/jam
`)
.openPopup();

</script>

@endif

@endpush