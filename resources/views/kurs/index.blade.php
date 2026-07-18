@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold text-primary mb-1">
        💰 Global Currency Exchange Monitoring
    </h2>

    <p class="text-muted mb-4">
        Monitoring nilai tukar mata uang internasional untuk mendukung analisis risiko Global Supply Chain.
    </p>

    <!-- Ringkasan -->

    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h5>💵 Base Currency</h5>

                    <h2 class="text-primary">
                        {{ $base }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h5>🌍 Mata Uang Dipantau</h5>

                    <h2 class="text-success">
                        {{ count($currencies) }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h5>🕒 Update Terakhir</h5>

                    <small>

                        {{ $lastUpdate }}

                    </small>

                </div>

            </div>

        </div>

    </div>

    <!-- Tabel -->

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">

                📊 Monitoring Kurs Mata Uang

            </h4>

        </div>

        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Negara</th>

                        <th>Kode</th>

                        <th>1 USD</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($currencies as $currency)

                    <tr>

                        <td>

                            {{ $currency['flag'] }}

                            {{ $currency['country'] }}

                        </td>

                        <td>

                            <strong>{{ $currency['code'] }}</strong>

                        </td>

                        <td>

                            {{ number_format($currency['rate'],2) }}

                        </td>

                        <td>

                            @if($currency['rate'] > 100)

                                <span class="badge bg-warning text-dark">
                                    Fluktuatif
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Stabil
                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <!-- Analisis -->

    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">

                📈 Analisis Risiko Kurs

            </h5>

        </div>

        <div class="card-body">

            <ul>

                <li>Nilai tukar dipantau menggunakan mata uang dasar USD.</li>

                <li>Perubahan kurs dapat memengaruhi biaya impor dan ekspor.</li>

                <li>Data ini mendukung monitoring risiko Global Supply Chain.</li>

            </ul>

        </div>

    </div>

</div>

@endsection