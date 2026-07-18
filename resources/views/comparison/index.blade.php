@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4 fw-bold text-primary">
        🌍 Country Comparison
    </h2>

    <div class="card shadow">
        <div class="card-body">

            <form method="GET" action="{{ route('comparison') }}">

                <div class="row">

                    <div class="col-md-5">

                        <label class="fw-bold">Negara 1</label>

                        <select name="country1" class="form-select">

                            <option value="">-- Pilih Negara --</option>

                            @foreach($countries as $country)

                                @if(is_array($country) && isset($country['cca3']) && isset($country['name']['common']))

                                    <option
                                        value="{{ $country['cca3'] }}"
                                        {{ request('country1') == $country['cca3'] ? 'selected' : '' }}>

                                        {{ $country['name']['common'] }}

                                    </option>

                                @endif

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2 text-center">

                        <h2 class="mt-4 text-danger">
                            VS
                        </h2>

                    </div>

                    <div class="col-md-5">

                        <label class="fw-bold">Negara 2</label>

                        <select name="country2" class="form-select">

                            <option value="">-- Pilih Negara --</option>

                            @foreach($countries as $country)

                                @if(is_array($country) && isset($country['cca3']) && isset($country['name']['common']))

                                    <option
                                        value="{{ $country['cca3'] }}"
                                        {{ request('country2') == $country['cca3'] ? 'selected' : '' }}>

                                        {{ $country['name']['common'] }}

                                    </option>

                                @endif

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="text-center mt-4">

                    <button type="submit" class="btn btn-primary">
                        🔍 Bandingkan
                    </button>

                </div>

            </form>

        </div>
    </div>

    @if(!empty($country1) && !empty($country2))

    <div class="row mt-5 justify-content-center">
        <div class="col-md-5 text-center">
            @if(isset($country1['flags']['png']))
                <img src="{{ $country1['flags']['png'] }}" width="150" class="img-thumbnail shadow-sm">
            @endif
            <h3 class="mt-3 fw-bold">{{ $country1['name']['common'] }}</h3>
        </div>
        <div class="col-md-2 text-center d-flex align-items-center justify-content-center">
            <h2 class="text-danger fw-bold">VS</h2>
        </div>
        <div class="col-md-5 text-center">
            @if(isset($country2['flags']['png']))
                <img src="{{ $country2['flags']['png'] }}" width="150" class="img-thumbnail shadow-sm">
            @endif
            <h3 class="mt-3 fw-bold">{{ $country2['name']['common'] }}</h3>
        </div>
    </div>

    <div class="card shadow border-0 mt-4 mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 fw-bold">📊 Tabel Perbandingan Negara</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Parameter</th>
                            <th style="width: 40%">{{ $country1['name']['common'] }}</th>
                            <th style="width: 40%">{{ $country2['name']['common'] }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold text-start">🏛 Ibukota</td>
                            <td>{{ $country1['capital'][0] ?? '-' }}</td>
                            <td>{{ $country2['capital'][0] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">👥 Populasi</td>
                            <td>{{ number_format($country1['population'] ?? 0) }}</td>
                            <td>{{ number_format($country2['population'] ?? 0) }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">🗺 Region</td>
                            <td>{{ $country1['region'] ?? '-' }}</td>
                            <td>{{ $country2['region'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">💱 Mata Uang</td>
                            <td>{{ $country1['currency_str'] ?? '-' }}</td>
                            <td>{{ $country2['currency_str'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">🗣 Bahasa</td>
                            <td>{{ $country1['language_str'] ?? '-' }}</td>
                            <td>{{ $country2['language_str'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">💰 GDP (Nominal)</td>
                            <td class="text-success fw-bold">USD {{ number_format($country1['gdp'] ?? 0, 0, ',', '.') }}</td>
                            <td class="text-success fw-bold">USD {{ number_format($country2['gdp'] ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">📈 Inflasi</td>
                            <td>{{ number_format($country1['inflation'] ?? 0, 2) }} %</td>
                            <td>{{ number_format($country2['inflation'] ?? 0, 2) }} %</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">🌡 Temperatur</td>
                            <td>{{ $country1['temperature'] ?? '-' }} °C</td>
                            <td>{{ $country2['temperature'] ?? '-' }} °C</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">🌧 Curah Hujan</td>
                            <td>{{ $country1['rain'] ?? '-' }} mm</td>
                            <td>{{ $country2['rain'] ?? '-' }} mm</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">💨 Kecepatan Angin</td>
                            <td>{{ $country1['wind_speed'] ?? '-' }} km/jam</td>
                            <td>{{ $country2['wind_speed'] ?? '-' }} km/jam</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">📊 Risk Score (0-100)</td>
                            <td class="fw-bold text-danger">{{ $country1['risk_score'] ?? 0 }}% ({{ $country1['risk_status'] ?? '-' }})</td>
                            <td class="fw-bold text-danger">{{ $country2['risk_score'] ?? 0 }}% ({{ $country2['risk_status'] ?? '-' }})</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">⚠ Status Risiko</td>
                            <td>
                                @if(($country1['risk'] ?? '') == 'Tinggi')
                                    <span class="badge bg-danger fs-6">🔴 {{ $country1['risk'] }}</span>
                                @elseif(($country1['risk'] ?? '') == 'Sedang')
                                    <span class="badge bg-warning text-dark fs-6">🟡 {{ $country1['risk'] }}</span>
                                @else
                                    <span class="badge bg-success fs-6">🟢 {{ $country1['risk'] ?? 'Aman' }}</span>
                                @endif
                            </td>
                            <td>
                                @if(($country2['risk'] ?? '') == 'Tinggi')
                                    <span class="badge bg-danger fs-6">🔴 {{ $country2['risk'] }}</span>
                                @elseif(($country2['risk'] ?? '') == 'Sedang')
                                    <span class="badge bg-warning text-dark fs-6">🟡 {{ $country2['risk'] }}</span>
                                @else
                                    <span class="badge bg-success fs-6">🟢 {{ $country2['risk'] ?? 'Aman' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endif

</div>

@endsection