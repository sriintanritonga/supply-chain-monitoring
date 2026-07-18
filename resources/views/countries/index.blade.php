@extends('layouts.app')

@section('styles')
<style>
    .country-card {
        border-radius: 16px !important;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        background: #ffffff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05) !important;
    }
    .country-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(13, 110, 253, 0.15) !important;
    }
    .card-header-gradient {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
        border-bottom: none;
        padding: 18px 20px;
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
    }
    .info-label {
        font-size: 0.85rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
        font-weight: 600;
    }
    .info-value {
        font-size: 1.05rem;
        font-weight: 700;
        color: #212529;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f1f3f5;
    }
    .info-row:last-of-type {
        border-bottom: none;
    }
    .search-card {
        border-radius: 16px !important;
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04) !important;
    }
    .search-input {
        border-radius: 12px 0 0 12px !important;
        border: 1px solid #dee2e6;
        padding: 14px 20px;
        font-size: 1rem;
    }
    .search-input:focus {
        box-shadow: none;
        border-color: #0d6efd;
    }
    .search-btn {
        border-radius: 0 12px 12px 0 !important;
        padding: 14px 28px;
        font-weight: 600;
    }
    .favorite-btn {
        transition: all 0.2s ease;
        border-radius: 12px !important;
    }
    .favorite-btn:hover {
        background-color: #ffc107 !important;
        color: #212529 !important;
        border-color: #ffc107 !important;
    }
</style>
@endsection

@section('content')

<div class="container-fluid py-2">

    <h2 class="mb-4 fw-bold text-dark d-flex align-items-center">
        <span class="me-2">🌍</span> Data Negara Global
    </h2>

    <!-- Form Pencarian Negara -->
    <div class="card search-card border-0 mb-4">
        <div class="card-body p-4">
            <form action="{{ url('/countries') }}" method="GET">
                <div class="input-group">
                    <input
                        type="text"
                        name="country"
                        class="form-control search-input"
                        placeholder="Cari nama negara..."
                        value="{{ request('country') }}">
                    <button class="btn btn-primary search-btn">
                        🔍 Cari Negara
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">

    @forelse($countries as $country)

    <div class="col-md-4 mb-4">

        <div class="card country-card border-0 h-100">

            <div class="card-header-gradient text-white d-flex align-items-center justify-content-between">
                <h5 class="mb-0 text-truncate fw-bold" style="max-width: 75%;">
                    {{ $country['name'] }}
                </h5>
                @if(!empty($country['flag']))
                    <img src="{{ $country['flag'] }}" alt="Flag" style="height: 25px; width: 40px; object-fit: cover; border-radius: 4px;" class="border border-white shadow-sm">
                @endif
            </div>

            <div class="card-body p-4">
                <div class="info-row">
                    <div>
                        <div class="info-label">👥 Populasi</div>
                        <div class="info-value">{{ number_format($country['population']) }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div>
                        <div class="info-label">🗺 Region</div>
                        <div class="info-value">{{ $country['region'] }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div>
                        <div class="info-label">💱 Mata Uang</div>
                        <div class="info-value">{{ $country['currency'] }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div>
                        <div class="info-label">🗣 Bahasa</div>
                        <div class="info-value">{{ $country['language'] }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div>
                        <div class="info-label">💰 GDP (Nominal)</div>
                        <div class="info-value text-success">USD {{ number_format($country['gdp'], 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div>
                        <div class="info-label">📈 Inflasi</div>
                        <div class="info-value">{{ number_format($country['inflation'], 2) }} %</div>
                    </div>
                </div>

                <div class="info-row">
                    <div>
                        <div class="info-label">🌡 Temperatur</div>
                        <div class="info-value text-danger">{{ $country['temperature'] }} °C</div>
                    </div>
                </div>

                <div class="info-row">
                    <div>
                        <div class="info-label">🌧 Curah Hujan</div>
                        <div class="info-value text-primary">{{ $country['rain'] }} mm</div>
                    </div>
                </div>

                <div class="info-row">
                    <div>
                        <div class="info-label">💨 Kecepatan Angin</div>
                        <div class="info-value text-info">{{ $country['wind_speed'] }} km/jam</div>
                    </div>
                </div>

                <div class="info-row">
                    <div>
                        <div class="info-label">📊 Risk Score</div>
                        <div class="info-value text-danger">{{ $country['risk_score'] }}% ({{ $country['risk_status'] }})</div>
                    </div>
                </div>

                <div class="info-row pb-0">
                    <div class="w-100">
                        <div class="info-label mb-2">⚠ Status Risiko</div>
                        @if($country['risk']=='Tinggi')
                            <span class="badge bg-danger fs-6 w-100 py-2 rounded-3 shadow-sm">
                                🔴 {{ $country['risk'] }}
                            </span>
                        @elseif($country['risk']=='Sedang')
                            <span class="badge bg-warning text-dark fs-6 w-100 py-2 rounded-3 shadow-sm">
                                🟡 {{ $country['risk'] }}
                            </span>
                        @else
                            <span class="badge bg-success fs-6 w-100 py-2 rounded-3 shadow-sm">
                                🟢 {{ $country['risk'] }}
                            </span>
                        @endif
                    </div>
                </div>

                <form action="{{ route('favorite.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="country_code" value="{{ $country['country_code'] }}">
                    <input type="hidden" name="country_name" value="{{ $country['name'] }}">
                    <input type="hidden" name="region" value="{{ $country['region'] }}">
                    <input type="hidden" name="flag" value="{{ $country['flag'] }}">
                    <button type="submit" class="btn btn-outline-warning w-100 fw-bold favorite-btn py-2">
                        ⭐ Tambah Favorit
                    </button>
                </form>
            </div>

        </div>

    </div>

    @empty

    <div class="col-12">
        <div class="alert alert-warning text-center py-4 rounded-4 shadow-sm">
            <h5 class="mb-0">Data negara tidak ditemukan.</h5>
        </div>
    </div>

    @endforelse

    </div>

</div>

@endsection