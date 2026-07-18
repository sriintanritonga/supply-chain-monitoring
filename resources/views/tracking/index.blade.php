@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4 text-primary fw-bold">
        🚢 Global Shipment Tracking
    </h2>

    <p class="text-muted">
        Monitoring perjalanan pengiriman internasional menggunakan peta dunia.
    </p>

    <div class="row">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    🌍 Peta Tracking
                </div>

                <div class="card-body">

                    <div id="map" style="height:500px;"></div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    📦 Informasi Shipment
                </div>

                <div class="card-body">

                    @if($shipment)

                        <p>
                            <strong>Asal</strong><br>
                            {{ $shipment->negara_asal }}
                        </p>

                        <hr>

                        <p>
                            <strong>Tujuan</strong><br>
                            {{ $shipment->negara_tujuan }}
                        </p>

                        <hr>

                        <p>
                            <strong>Status</strong><br>

                            @if($shipment->status == 'Delivered')
                                <span class="badge bg-success fs-6">
                                    {{ $shipment->status }}
                                </span>

                            @elseif($shipment->status == 'On The Way')
                                <span class="badge bg-warning text-dark fs-6">
                                    {{ $shipment->status }}
                                </span>

                            @else
                                <span class="badge bg-secondary fs-6">
                                    {{ $shipment->status }}
                                </span>
                            @endif

                        </p>

                    @else

                        <div class="alert alert-warning">
                            Belum ada data shipment.
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

var map = L.map('map').setView([-2,115],4);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
    attribution:'© OpenStreetMap'
}).addTo(map);

// Koordinat sementara
var origin = [-6.2088,106.8456];
var destination = [1.3521,103.8198];

L.marker(origin)
.addTo(map)
.bindPopup("📍 Asal");

L.marker(destination)
.addTo(map)
.bindPopup("📍 Tujuan");

L.polyline(
    [origin,destination],
    {
        color:'red',
        weight:4
    }
).addTo(map);

map.fitBounds([origin,destination]);

</script>

@endsection