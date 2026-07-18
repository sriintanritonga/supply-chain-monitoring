@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            🚢 Port Location Dashboard
        </h2>
    </div>

    <!-- Filter Pencarian -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('ports.index') }}">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Nama / Kode Pelabuhan</label>
                        <input
                            type="text"
                            name="port"
                            class="form-control"
                            placeholder="Cari Shanghai, IDTPP, dll..."
                            value="{{ request('port') }}">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Negara</label>
                        <input
                            type="text"
                            name="country"
                            class="form-control"
                            placeholder="Cari China, Indonesia, dll..."
                            value="{{ request('country') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            🔍 Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Peta Pelabuhan -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">🗺 Peta Lokasi Pelabuhan</h5>
                </div>
                <div class="card-body p-0">
                    <div id="portsMap" style="height: 500px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;"></div>
                </div>
            </div>
        </div>

        <!-- Daftar Pelabuhan -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">📋 Daftar Pelabuhan</h5>
                </div>
                <div class="card-body" style="max-height: 440px; overflow-y: auto;">
                    <div class="list-group list-group-flush">
                        @forelse($ports as $port)
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 fw-bold text-dark">{{ $port['name'] }}</h6>
                                <small class="badge bg-secondary">{{ $port['code'] }}</small>
                            </div>
                            <p class="mb-1 text-muted small">
                                📍 {{ $port['country'] }} ({{ $port['latitude'] }}, {{ $port['longitude'] }})
                            </p>
                            <small class="text-success fw-bold">Kapasitas: {{ $port['capacity'] }}</small>
                        </div>
                        @empty
                        <div class="text-center py-4 text-muted">
                            Pelabuhan tidak ditemukan.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Inisialisasi peta Leaflet
    var map = L.map('portsMap').setView([20, 10], 2);

    // Layer jalan OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Data pelabuhan dari Laravel
    var portsData = {!! json_encode($ports) !!};

    // Tambahkan marker untuk setiap pelabuhan
    portsData.forEach(function(port) {
        var marker = L.marker([port.latitude, port.longitude]).addTo(map);
        marker.bindPopup(
            `<b>${port.name} (${port.code})</b><br>` +
            `Negara: ${port.country}<br>` +
            `Kapasitas: ${port.capacity}<br>` +
            `<small>Koordinat: ${port.latitude}, ${port.longitude}</small>`
        );
    });
</script>
@endpush
